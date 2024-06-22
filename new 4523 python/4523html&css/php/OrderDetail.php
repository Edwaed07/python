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

$sql = "SELECT * FROM orders where orderID =".$orderId;
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


    <link rel="stylesheet" type="text/css" href="../css/Update Order Form.css">

    <script>
        
    function resizeIframe(iframe) {
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight  + 20 +  'px';
    }

    function backToSalesOrderRecord() {
            parent.location.href = '../Sales Order records.html';
    }

    </script>

<body>

<div class="container">
        
        <h1>Order Detail</h1>
        <form>
            <label >Order ID :</label>
            <input type="text" name="OrderID" value="<?php echo $OrderID?>" readonly>
            <br></br>

            <label >Dealer ID :</label>
            <input type="text" name="DealerID" value="<?php echo $DealerID?>" readonly>
            <br></br>

            <label >Sales Manager ID :</label>
            <input type="text" name="SalesManagerID" value="<?php echo $SalesManagerID?>" readonly>
            <br></br>

            <label >Manager’s Contact Name :</label>
            <input type="text" name="SalesManagerContactName" value="<?php echo $SalesManagerContactName?>" readonly>
            <br></br>

            <label >Manager’s Contact Number :</label>
            <input type="text" name="SalesManagerNumber"  value="<?php echo $SalesManagerNumber?>" readonly> 
            <br></br>

            <label >Order date and time:</label>
            <input type="text" name="OrderDateAndTime" value="<?php echo $OrderDateAndTime?>" readonly>
            <br></br>

            <label >Delivery address</label>
            <textarea rows="5" cols="54" name="DeliveryAddress" readonly><?php echo $DeliveryAddress; ?></textarea>
            <br></br>

            <label >Delivery date</label>
            <input type="text" name="DeliveryDate" value="<?php echo $DeliveryDate?>" readonly>
            <br></br>

            

            <iframe src="loadOrderItem.php?orderId=<?php echo $OrderID; ?>" width="100%" height="100%" frameborder="0" onload="resizeIframe(this)"></iframe>

            <label >Shipping cost</label>   
            <input type="text" name="ShippingCost" value="<?php echo $ShippingCost?>" readonly>
            <br></br>

            <label >Order status</label>   
            <input type="text" name="Order status" value="<?php echo $OrderStatus?>" readonly>
            <br></br>

            <br>
            <br>

    <div class="button-container">
        <input type="button" value="Back" onclick="backToSalesOrderRecord()">
    </div>



</body>
</html>