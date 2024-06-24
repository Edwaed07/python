<!DOCTYPE html>
<html>

    <link rel="stylesheet" type="text/css" href="../css/item.css">

<?php

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

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);




if ($result->num_rows > 0) {
    echo "

    <script>
        function redirectToNewPage() {
            parent.location.href = '../order record.html';
        }

        function deleteorderRecord(orderID) { 
           if (confirm('Are you sure you want to delete this order rcord?')) {
               var xhr = new XMLHttpRequest();
               xhr.open('POST', 'deleterecord.php', true);
               xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

               xhr.onreadystatechange = function () {
                   if (xhr.readyState == 4 && xhr.status == 200) {
                       alert(xhr.responseText);
                       location.reload(); // Reload the page to reflect the changes
                   }
               };

               xhr.send('orderID=' + orderID);
           }
        }

        function orderDetail(OrderID) { 
        window.location.href = 'OrderDetail.php?OrderID=' + OrderID;
    }
   
    </script>
    
    
    <table  class='order-table'> 
    <tr>
    <th>Order ID</th>
    <th>Dealer ID</th>
    <th>Sales Manager</th>
    <th>Order Date</th>
    <th>Delivery Address</th>
    <th>Delivery Date</th>
    <th>Order Status</th>
    <th>Ship Cost</th>
    <th></th>
    <th></th>

    </tr>"; 

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo "<tr>
        <td>".$row["orderID"]."</td>
        <td>".$row["dealerID"]."</td>
        <td>".$row["salesManagerID"]."</td>
        <td>".$row["orderDateTime"]."</td>
        <td>".$row["deliveryAddress"]."</td>
        <td>".$row["deliveryDate"]."</td>
        <td>".$row["orderStatus"]."</td>
        <td>".$row["shipCost"]."</td>

        <td>
          <button onclick='deleteorderRecord(".$row["orderID"].")'>Delete</button>
        </td>
        <td>
          <button onclick='orderDetail(".$row["orderID"].")'>Detail</button>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>


</html>