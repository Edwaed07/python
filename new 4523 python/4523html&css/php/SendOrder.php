<?php
   if (isset($_POST['orderID'])) {

        // Get the item ID from the POST request
        $orderID = $_POST['orderID'];
        $shipCost = $_POST['deliveryFee'];

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
       $sql = "UPDATE orders SET OrderStatus = ? , shipCost = ? WHERE orderID=".$orderID;
       
       // Prepare statement
       $stmt = $conn->prepare($sql);
       $orderStatus = 'WaitingForConfirm';
       $stmt->bind_param('ss', $orderStatus, $shipCost);
       if ($stmt->execute()) {
            echo "send order successed";
            
            
        }else{

          echo"Error order: " . $stmt->error;

        }
       
    $addsql = "SELECT * FROM ordersitem WHERE orderID = ?";
    $addstmt = $conn->prepare($addsql);
    $addstmt->bind_param('i', $orderID);

    if ($addstmt->execute()) {

        $result = $addstmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orderitem = $row['orderQty'];
                $sparePartNum = $row['sparePartNum'];


                $selectItemSql = "SELECT * FROM item WHERE sparePartNum = ?";
                $itemStmt = $conn->prepare($selectItemSql);

                $itemStmt->bind_param('i', $sparePartNum);
                $itemStmt->execute();
                $itemResult = $itemStmt->get_result();

                if ($itemResult->num_rows > 0) {
                    $itemRow = $itemResult->fetch_assoc();
                    $oldQty = $itemRow['stockItemQty'];
                    $newQty = $oldQty - $orderitem  ;

                    $addItemSql = "UPDATE item SET stockItemQty = ? WHERE sparePartNum = ?";
                    $updateStmt = $conn->prepare($addItemSql);

                    $updateStmt->bind_param('ii', $newQty, $sparePartNum);
                    if ($updateStmt->execute()) {
                        echo "Item updated successfully";
                    } else {
                        echo "Error updating item: " . $conn->error;
                    }
                    $updateStmt->close();
                }
                $itemStmt->close();
            }
        }
    } else {
        echo "Error retrieving order items: " . $conn->error;
    }
    $addstmt->close();

       // Close connection
       $stmt->close();
       $conn->close();
       
   }

?>