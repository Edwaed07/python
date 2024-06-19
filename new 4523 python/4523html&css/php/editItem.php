<?php
   if (isset($_GET['sparePartNum'])) {

        // Get the item ID from the POST request
        $sparePartNum = $_GET['sparePartNum'];

        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "projectdb";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
            
       // Check connection
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

       $sql = "SELECT * FROM item WHERE sparePartNum = ".$sparePartNum;
       $result = $conn->query($sql);

       $column = $result->fetch_assoc();

       $partNum = $column["sparePartNum"];
       $description = $column["sparePartDescription"];
       $quantity = $column["stockItemQty"];
       $price = $column["pri    ce"];
       
    }     

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newDescription = $_POST['description'];
        $newQuantity = $_POST['quantity'];
        $newPrice = $_POST['price'];
    
        // Handle file upload
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['img']['name']);
            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                $newImagePath = $uploadFile;
    
                // Update database with new values
                $updateSql = "UPDATE item SET sparePartImage='$newImagePath', sparePartDescription='$newDescription', stockItemQty=$newQuantity, price=$newPrice 
                                WHERE sparePartNum=$sparePartNum";
                if ($conn->query($updateSql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "No file uploaded or file upload error.";
        }
    }

?>


<!DOCTYPE html>
<script>

function backToItem() {
            parent.location.href = '../Item.html';
        }
</script>

<link rel="stylesheet" href="../css/Edit Item form.css" type="text/css">
<div class="container">


  
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <h1><?php echo "Edit item: ".$partNum; ?><h2>
  
    <label >New Spare Part Image :</label>
    <input type="file" id="img" name="img" >
    <br></br>

    <label >New Spare Part Description:</label>
    <textarea rows="5" cols="50" name="description"><?php echo $description; ?></textarea>
    <br></br>

    <label >New Stock Item Quantity:</label>
    <input type="text" value="<?php echo $quantity; ?>"  name="quantity">
    <br></br>

    <label >New Price:</label>
    <input type="text" value="<?php echo $price; ?>"  name="price">
    <br></br>

    <br>
    <br>

<div class="button-container">
  <input type="button" value="Cancel" onclick="backToItem()">
  <input type="submit" value="Submit" >
</div>


</html>
