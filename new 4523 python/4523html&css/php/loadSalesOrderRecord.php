<!DOCTYPE html>
<html>

    <link rel="stylesheet" type="text/css" href="../css/Sales Order records.css">


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
    function updateOrder(OrderID) { 
            window.location.href = 'updateSalesOrderRecord.php?OrderID=' + OrderID;
        }

    function orderDetail(OrderID) { 
        window.location.href = 'OrderDetail.php?OrderID=' + OrderID;
    }

    </script>

    <table  class='order-table'> 
    <tr>
    <th>Order ID</th>
    <th>Dealer ID</th>
    <th>Sales Manager ID</th>
    <th>Order Date</th>
    <th>Delivery Date</th>
    <th>Status</th>
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
        <td>".$row["deliveryDate"]."</td>
        <td>".$row["orderStatus"]."</td>
        <td>
          <button onclick='updateOrder(".$row["orderID"].")'>Update</button>
        </td>
        <td>
          <button onclick='orderDetail(".$row["orderID"].")'>Order detail</button>
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