<!DOCTYPE html>
<html>

    <link rel="stylesheet" type="text/css" href="../css/Sales Order records.css">


<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projectdb";
$mamagerID = $_COOKIE['ManagerID'];

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

    function assign(OrderID) {

        if (confirm('Are you sure you want to assign this order?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'assignManager.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload(); // Reload the page to reflect the changes
                    }
                };

                xhr.send('OrderID=' + OrderID);
            }

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
        <td>".$row["orderStatus"]."</td>";
        if ($row["salesManagerID"] == "none"){
            echo"
            <td>
                <button onclick='assign(".$row["orderID"].")'>Assign</button>
            </td>
            <td>
                <button onclick='updateOrder(".$row["orderID"].")'>Update</button>
            </td>";
        }else if ($row["salesManagerID"] == $mamagerID){
            echo"
            <td>
                <button disabled style='opacity: 0.5; pointer-events: none;' onclick='assign(".$row["orderID"].")'>Assign</button>
            </td>
            <td>
                <button onclick='updateOrder(".$row["orderID"].")'>Update</button>
            </td>";
        }else{
            echo"
            <td>
                <button disabled style='opacity: 0.5; pointer-events: none;' onclick='assign(".$row["orderID"].")'>Assign</button>
            </td>
            <td>
                <button disabled style='opacity: 0.5; pointer-events: none;' onclick='updateOrder(".$row["orderID"]." disabled)'>Update</button>
            </td>";
        }
        echo"<td>
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