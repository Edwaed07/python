<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "projectdb";
$orderId = $_GET['OrderID'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM orders where orderID =" . $orderId;
$result = $conn->query($sql);
$column = $result->fetch_assoc();
$OrderID = $column["orderID"];
$DealerID = $column["dealerID"];
$SalesManagerID = $column["salesManagerID"];
$OrderDateAndTime = $column["orderDateTime"];
$DeliveryAddress = $column["deliveryAddress"];
$DeliveryDate = $column["deliveryDate"];
$ShippingCost = $column["shipCost"];
$OrderStatus = $column["orderStatus"];

// Prepare the SQL statement with a placeholder for the parameter
$sql = "SELECT * FROM salesmanager where salesManagerID = ?";
$stmt = $conn->prepare($sql);

// Bind the parameter to the placeholder
$stmt->bind_param("s", $SalesManagerID);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$column = $result->fetch_assoc();

$SalesManagerContactName = $column["contactName"];
$SalesManagerNumber = $column["contactNumber"];

?>
<!DOCTYPE html>
<html>

<head>
    <link href="../css/Update Order Form.css" rel="stylesheet" type="text/css">
    <script>

        function resizeIframe(iframe) {
            iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 0 + 'px';
        }

        function backToOrderRecord() {
            parent.location.href = '../Sales Order records.html';
        }

    </script>
    <title></title>
</head>

<body>
    <div class="container">
        <h1>Order Detail</h1>
        <div style="display: flex; justify-content: space-between;">
            <!-- Left Table -->
            <div style="width: 50%;">
                <form>
                    <label>Order ID :</label> <input name="OrderID" readonly type="text"
                        value="<?php echo $OrderID ?>"><br><br>
                    <label>Dealer ID :</label> <input name="DealerID" readonly type="text"
                        value="<?php echo $DealerID ?>"><br><br>
                    <label>Sales Manager ID :</label> <input name="SalesManagerID" readonly type="text"
                        value="<?php echo $SalesManagerID ?>"><br><br>
                    <label>Manager’s Contact Name :</label> <input name="SalesManagerContactName" readonly type="text"
                        value="<?php echo $SalesManagerContactName ?>"><br><br>
                    <label>Manager’s Contact Number :</label> <input name="SalesManagerNumber" readonly type="text"
                        value="<?php echo $SalesManagerNumber ?>"><br><br>
                    <label>Order date and time:</label> <input name="OrderDateAndTime" readonly type="text"
                        value="<?php echo $OrderDateAndTime ?>"><br><br>
                    <label>Delivery address</label>
                    <textarea cols="54" name="DeliveryAddress" readonly
                        rows="5"><?php echo $DeliveryAddress; ?></textarea><br><br>
                </form>
            </div>

            <!-- Right Table -->
            <div style="width: 50%;">
                <form>
                    <label>Delivery date</label> <input name="DeliveryDate" readonly type="text"
                        value="<?php echo $DeliveryDate ?>"><br><br>
                    <iframe frameborder="0" height="100%" onload="resizeIframe(this)"
                        src="loadOrderItem.php?orderId=<?php echo $OrderID; ?>" width="100%"></iframe>
                    <label>Shipping cost</label> <input name="ShippingCost" readonly type="text"
                        value="<?php echo $ShippingCost ?>"><br><br>
                    <label>Order status</label> <input name="Order status" readonly type="text"
                        value="<?php echo $OrderStatus ?>"><br><br>

                </form>
            </div>
        </div>
        <div class="button-container">
            <input onclick="backToOrderRecord()" type="button" value="Back">
        </div>
</body>

</html>