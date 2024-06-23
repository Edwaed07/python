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

    
        $checksql = "SELECT orderID FROM orders ";
        $result = $conn->query($checksql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if( false){
                    echo "Fail to delete order record";
                    $result->close();
                    $conn->close();
                    return;
                }


            }

        }else {
            echo "Error: " . $result->error;
        }
        
    
       // SQL query to delete the orders
       $sql = "DELETE FROM orders WHERE orderID = ?";
       
       // Prepare statement
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('s', $orderID);
       if ($stmt->execute()) {
          echo "Delete successed";
         
        }else{

          echo"Error deleting order record: " . $stmt->error;

        }

       // Close connection
       $stmt->close();
       $conn->close();
       
   }

?>