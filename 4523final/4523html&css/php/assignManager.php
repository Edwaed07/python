<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projectdb";
$orderId = $_POST['OrderID'];
$SalesManagerID = $_COOKIE['ManagerID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$updateSql = "UPDATE orders SET salesManagerID='$SalesManagerID' WHERE orderID=$orderId";
if ($conn->query($updateSql) === TRUE) {
    echo "Order assigned successfully";
} else {
    echo "Error updating order: " . $conn->error;
}

$conn->close();
?>