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

    
        $checksql = "SELECT sparePartNum FROM ordersitem ";
        $result = $conn->query($checksql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if( $sparePartNum == $row["sparePartNum"]){
                    echo "The item is relate to order record, fail to delete item";
                    $result->close();
                    $conn->close();
                    return;
                }


            }

        }else {
            echo "Error: " . $result->error;
        }
        
    
       // SQL query to delete the item
       $sql = "DELETE FROM item WHERE sparePartNum = ?";
       
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