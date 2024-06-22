<?php
   if (isset($_POST['orderID'])) {

        // Get the item ID from the POST request
        $orderID = $_POST['orderID'];

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
       $sql = "UPDATE orders SET OrderStatus = ? WHERE orderID=".$orderID;
       
       // Prepare statement
       $stmt = $conn->prepare($sql);
       $orderStatus = 'WaitingForConfirm';
       $stmt->bind_param('s', $orderStatus);
       if ($stmt->execute()) {
            echo "send order successed";
            
            exit();
        }else{

          echo"Error order: " . $stmt->error;

        }

       // Close connection
       $stmt->close();
       $conn->close();
       
   }

?>