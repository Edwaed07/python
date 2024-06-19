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
       $sql = "DELETE FROM your_table_name WHERE sparePartNum = ?";
       
       // Prepare statement
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('s', $sparePartNum);

       // Execute the statement
       if ($stmt->execute()) {
           echo "Item deleted successfully";
       } else {
           echo "Error deleting item: " . $conn->error;
       }

       // Close connection
       $stmt->close();
       $conn->close();
   } else {
       echo "No item ID provided";
   }
   ?>