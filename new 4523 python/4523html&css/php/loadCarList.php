<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projectdb";
$dealerID = $_COOKIE['DealerID'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$getOrderIDsql = "SELECT * FROM orders WHERE dealerID = ? AND orderStatus = ?";
$rs = $conn->prepare($getOrderIDsql);
$orderStatus = 'Created';
$rs->bind_param("ss", $dealerID, $orderStatus);
$rs->execute();
$result = $rs->get_result(); // Get the result set from the executed statement

if ($result->num_rows > 0) {
    $col = $result->fetch_assoc();
    $orderID = $col['orderID'];
    
    $sql = "SELECT * FROM ordersitem WHERE orderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result(); // Get the result set from the executed statement
    $totalPrice = 0;

    if ($result->num_rows > 0) {
        echo "
        <table>
        <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th></th>
        </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $totalPrice += $row["orderQty"] * $row["sparePartOrderPrice"];
            echo "<tr>
            <td>".$row["sparePartNum"]."</td>
            <td>".$row["orderQty"]."</td>
            <td>".$row["sparePartOrderPrice"]."</td>
            <td>
            <button onclick='deleteOrdersItem(".$row["sparePartNum"].")'>Delete</button>
            </td>
            </tr>";
        }
        
        echo "
        <td>Total Price:</td>
        <td></td>
        <td>".$totalPrice."</td>
        <td></td>
        
        </table>
        <br>
        <button onclick='SendOrder(".$orderID.")'>Order</button>";
        }

}else{
    echo"<h3>There is no item added into Car List<h3>";
}



?>
<!DOCTYPE html>

<link rel="stylesheet" href="../css/carlist.css" type="text/css">

<script>
    function deleteOrdersItem(sparePartNum) { 
            if (confirm('Are you sure you want to delete this item?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'deleteCarListItem.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload(); // Reload the page to reflect the changes
                    }
                };

                xhr.send('sparePartNum=' + sparePartNum);
            }
            }
    function SendOrder(orderID) { 
        if (confirm('Are you sure you want send this order?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'SendOrder.php', true);
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
</script>

</html>