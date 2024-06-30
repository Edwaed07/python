<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projectdb";
$orderId = $_GET['orderId'];
$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'sparePartCategory';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ordersitem where orderID = $orderId ORDER BY $sortBy $order";
$result = $conn->query($sql);

$orderprice = 0;


if ($result->num_rows > 0) {
    if ($sortBy == 'sparePartCategory') {
        echo "
    <select name='order' id='order'>
    <option value='sparePartCategory' selected>Category</option>
    <option value='orderQty' >quantity</option>
    <option value='sparePartOrderPrice'>Price</option>
    </select>";
    } else if ($sortBy == 'orderQty') {
        echo "
        <select name='order' id='order'>
        <option value='sparePartCategory'>Category</option>
        <option value='orderQty' selected>quantity</option>
        <option value='sparePartOrderPrice'>Price</option>
        </select>";
    } else if ($sortBy == 'sparePartOrderPrice') {
        echo "
        <select name='order' id='order'>
        <option value='sparePartCategory'>Category</option>
        <option value='orderQty' >quantity</option>
        <option value='sparePartOrderPrice' selected>Price</option>
        </select>";
    }

    echo "
    <button onclick=sortTable('ASC')>ASC</button>
    <button onclick=sortTable('DESC')>DESC</button>
    <table  class='order-table'> 
    <tr>
    <th>Spare Part Image</th>
    <th>Spare Part Name</th>
    <th>Category</th>
    <th>Order Quantity</th>
    <th>Order Price</th>
    </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {

        $selectItemSql = "SELECT * FROM item WHERE sparePartNum = " . $row["sparePartNum"];
        $itemResult = $conn->query($selectItemSql);

        if ($itemResult->num_rows > 0) {
            $itemRow = $itemResult->fetch_assoc();
            $img = $itemRow['sparePartImage'];
            $path = "../sample images/";
            $name = $itemRow['sparePartName'];
        }

        echo "<tr>
        <td><img src='" . $path . $img . "' style='width:50px; height:50px'></td>
        <td>" . $name . "</td>
        <td>" . $row["sparePartCategory"] . "</td>
        <td>" . $row["orderQty"] . "</td>
        <td>" . $row["sparePartOrderPrice"] . "</td>
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

<script>
    function sortTable(order) {
        const select = document.getElementById('order');
        const sortBy = select.value;
        const orderId = new URLSearchParams(window.location.search).get('orderId');
        window.location.href = `?orderId=${orderId}&sortBy=${sortBy}&order=${order}`;
    }
</script>


</html>