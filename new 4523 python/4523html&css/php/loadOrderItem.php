<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projectdb";
$orderId = $_GET['orderId'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ordersitem where orderID = $orderId";
$result = $conn->query($sql);

$orderprice = 0;


if ($result->num_rows > 0) {
    echo "

    
    <table  class='order-table'> 
    <tr>
    <th>Spare Part Image</th>
    <th>Spare Part Name</th>
    <th>Order Quantity</th>
    <th>Order Price</th>
    </tr>"; 

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>test</td>
        <td>".$row["sparePartNum"]."</td>
        <td>".$row["orderQty"]."</td>
        <td>".$row["sparePartOrderPrice"]."</td>
        ";
        $orderprice += $row["orderQty"] * $row["sparePartOrderPrice"];
    }
    echo "</table>
    <br></br>
    <label>Total price : $orderprice</label>   
    ";
} else {
    echo "0 results";
}



$conn->close();

?>



<!DOCTYPE html>
<html>

    <link rel="stylesheet" type="text/css" href="../css/item.css">


</html>