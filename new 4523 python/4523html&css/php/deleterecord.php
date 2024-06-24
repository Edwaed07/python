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

       // 首先刪除 ordersitem 表中的相關行
       $sql = "DELETE FROM ordersitem WHERE orderID = ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('i', $orderID);
       if (!$stmt->execute()) {
          echo "Error deleting related order items: " . $stmt->error;
          $stmt->close();
          $conn->close();
          return; // 如果刪除失敗，停止執行
       }
       $stmt->close();

       // 然後刪除 orders 表中的行
       $sql = "DELETE FROM orders WHERE orderID = ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param('i', $orderID);
       if ($stmt->execute()) {
          echo "Delete succeeded";
        } else {
          echo "Error deleting order record: " . $stmt->error;
        }

       $stmt->close();
       $conn->close();
   }
?>
