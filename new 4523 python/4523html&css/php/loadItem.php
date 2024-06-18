<!DOCTYPE html>
<html>
<head>
    <title>Display Items</title>
    <link rel="stylesheet" type="text/css" href="../css/item.css">
</head>

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

$sql = "SELECT * FROM Item";
$result = $conn->query($sql);




if ($result->num_rows > 0) {
    echo "<table  class='order-table'> 
    <tr>
    <th>Item ID</th>
    <th>Category</th>
    <th>Name</th>
    <th>Weight</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>
          <a href='../Add Item Form.html'>
          <button >Add Item</button>
          </a>
    </th>
    <th></th>
    </tr>"; 

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["sparePartNum"]."</td>
        <td>".$row["sparePartCategory"]."</td>
        <td>".$row["sparePartName"]."</td>
        <td>".$row["weight"]."</td>
        <td>".$row["price"]."</td>
        <td>".$row["stockItemQty"]."</td>
        <td>
          <button >Delete</button>
        </td>
        <td>
          <a href='Edit Item form.html'>
          <button >Edit item</button>
          </a>
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