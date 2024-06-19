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
       $img = $column["sparePartImage"];
       $description = $column["sparePartDescription"];
       $quantity = $column["stockItemQty"];
       $price = $column["price"];
       

    }     

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

       
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "projectdb";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        $PartNum = $_POST['PartNum'];
        $newImg = $_POST['img'];
        $newDescription = $_POST['description'];
        $newQuantity = $_POST['quantity'];
        $newPrice = $_POST['price'];
    
        $message = "";
        // Update database with new values
        $updateSql = "UPDATE item SET sparePartImage='$newImg', sparePartDescription='$newDescription', stockItemQty=$newQuantity, price=$newPrice 
                        WHERE sparePartNum=$PartNum";
        if ($conn->query($updateSql) == TRUE) {
            $message = "Item updated successfully";
            
            
        } else {
            $message =  "Error updating item: " . $conn->error;
        }
           
    }

    

?>


<script>

function backToItem() {
            parent.location.href = '../Item.html';
        }
</script>

<link rel="stylesheet" href="../css/Edit Item form.css" type="text/css">

<div class="container">
    <?php if (!empty($message)): ?>
        <script>
            alert('<?php echo $message; ?>');
            backToItem();
        </script>
    <?php endif; ?>


  
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

    <h1><?php echo "Edit item:"; ?><h2>
  
    <label >Item ID:</label>
    <input type="text" value="<?php echo $partNum; ?>"  name="PartNum" readonly>
    <br></br>

    <label >New Spare Part Image :</label>
    <input type="text" value="<?php echo $img; ?>"  name="img">
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



