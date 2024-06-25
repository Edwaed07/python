<?php
   if (isset($_POST['orderID'])) {

        $orderID = $_POST['orderID'];

        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "projectdb";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
            
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }

   
       
       
    $sql = "UPDATE orders SET orderStatus = 'Cancelled' WHERE orderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $orderID);
    if ($stmt->execute()) {
        echo "Order status updated successfully<br>";
    } else {
        echo "Error updating order status: " . $stmt->error;
    }
    $stmt->close();


    // Retrieve order items
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
                    $newQty = $orderitem + $oldQty;

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


    $conn->close();
}



?>
