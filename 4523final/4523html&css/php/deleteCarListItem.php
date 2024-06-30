<?php
   if (isset($_POST['sparePartNum'])) {

        // Get the item ID from the POST request
        $sparePartNum = $_POST['sparePartNum'];

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
        
    
       // SQL query to delete the item
       $sql = "DELETE FROM ordersitem WHERE sparePartNum = ?";
       
       // Prepare statement
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('s', $sparePartNum);
       if ($stmt->execute()) {
          echo "delete successed";
         
        }else{

          echo"Error deleting item: " . $stmt->error;

        }

       // Close connection
       $stmt->close();
       $conn->close();
       
   }

?>