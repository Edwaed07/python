<?php

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "projectdb";
    $message = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
        
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $partNum = 1;
    $checksql = "SELECT sparePartNum FROM item ";
    $result = $conn->query($checksql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $partNum += 1;
        }

    }else {
        echo "Error: " . $result->error;
    }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $PartNum = $_POST['partNum'];
        $Category = $_POST['Category'];
        $Name = $_POST['name'];
        $Image = $_POST['img'];
        $Description = $_POST['description'];
        $Weight = $_POST['weight'];
        $Qty = $_POST['Qty'];
        $Price = $_POST['price'];
        

        $insertSql = "INSERT INTO item (sparePartNum, sparePartCategory, sparePartName, sparePartImage, sparePartDescription, weight, stockItemQty, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($update = $conn->prepare($insertSql)) {
            // Bind variables to the prepared statement as parameters
            $update->bind_param("issssdis", $PartNum, $Category, $Name, $Image, $Description, $Weight, $Qty, $Price);

            // Attempt to execute the prepared statement
            if ($update->execute()) {
                $message = "Item added successfully";
            } else {
                $message = "Error updating record: " . $update->error;
            }

            // Close statement
            $update->close();
        } else {
            $message = "Error preparing the SQL statement: " . $conn->error;
        }
    }


?>

<!DOCTYPE html>

<link rel="stylesheet" href="../css/Add Item form.css" type="text/css">

<script>

function backToItem() {
            parent.location.href = '../Item.html';
        }

</script>


<body >
    <div class="container">
        <?php if (!empty($message)): ?>
            <script>
                alert('<?php echo $message; ?>');
                backToItem();
            </script>
        <?php endif; ?>
        
        <h1>Insert Item</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <label >Spare Part Number :</label>
            <input type="text" name="partNum"  value="<?php echo $partNum ?> " readonly>
            <br></br>

            <label >Spare Part Name :</label>
            <input type="text" name="name" required>
            <br></br>


            <label >Spare Part Category</label>
            <div class="radio-group">
                <label><input type="radio" name="Category" value="1" required> 1</label>
                <label><input type="radio" name="Category" value="2" required> 2</label>
                <label><input type="radio" name="Category" value="3" required> 3</label>
                <label><input type="radio" name="Category" value="4" required> 4</label>
                <label><input type="radio" name="Category" value="5" required> 5</label>
            </div>
            <br></br>

            <label>Spare Part Image :</label>
            <input type="text" name="img" required>
            <br></br>

            <label>Spare Part Description:</label>
            <textarea rows="5" cols="50" name="description" required>Enter description here...</textarea> 
            <br></br>

            <label>Weight:</label>
            <input type="text" name="weight" required>
            <br></br>

            <label>Stock Item Quantity:</label>
            <input type="text" name="Qty" required>
            <br></br>

            <label>Price:</label>
            <input type="text" name="price" required>
            <br></br>


            <br>
            <br>

    <div class="button-container">
        
        <input type="button" value="Cancel" onclick="backToItem()">
        <input type="reset" value="Clear" >
        <input type="submit" value="Submit" >

    </div>



</body>
</html>