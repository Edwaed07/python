<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sparePartNum = $_POST['sparePartNum'];
    $Qty = $_POST['quantity'];

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

    // Get price of the spare part
    $getPriceSql = "SELECT price, sparePartCategory FROM item WHERE sparePartNum = ?";
    $stmt = $conn->prepare($getPriceSql);
    $stmt->bind_param("i", $sparePartNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row['price'];
        $category = $row['sparePartCategory'];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Spare part not found']);
        exit;
    }

    // Get delivery address
    $getAddressSql = "SELECT deliveryAddress FROM dealer WHERE dealerID = ?";
    $stmt = $conn->prepare($getAddressSql);
    $stmt->bind_param("s", $dealerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $deliveryAddress = $row['deliveryAddress'];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dealer not found']);
        exit;
    }

    // Generate new order ID
    $orderID = 1;
    $checksql = "SELECT MAX(orderID) AS maxOrderID FROM orders";
    $result = $conn->query($checksql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $orderID = $row['maxOrderID'] + 1;
    }

    // Check if there is an existing order with 'created' status for this dealer
    $sql = "SELECT orderID FROM orders WHERE dealerID = ? AND orderStatus = 'created'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dealerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        // Insert new order
        $insertSql = "INSERT INTO orders (orderID, dealerID, salesManagerID , orderDateTime, deliveryAddress,deliveryDate, orderStatus, shipCost) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $orderStatus = 'Created';
        $shipCost = 0;
        $date = date('Y-m-d H:i:s');
        $salesManagerID = "none";
        $currentDate = new DateTime();
        $currentDate->modify('+1 month');
        $deliveryDate = $currentDate->format('Y-m-d');
        $stmt->bind_param("issssssi", $orderID, $dealerID, $salesManagerID, $date, $deliveryAddress,$deliveryDate, $orderStatus, $shipCost);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order inserted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Order insert failed']);
            exit;
        }
    } else {
        $row = $result->fetch_assoc();
        $orderID = $row['orderID'];
    }

    // Check if the spare part already exists in the order
    $checkItemSql = "SELECT orderQty FROM ordersitem WHERE orderID = ? AND sparePartNum = ?";
    $stmt = $conn->prepare($checkItemSql);
    $stmt->bind_param("ii", $orderID, $sparePartNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing order item
        $row = $result->fetch_assoc();
        $oldQty = $row['orderQty'];
        $newQty = $oldQty + $Qty;

        $updateSql = "UPDATE ordersitem SET orderQty = ?, sparePartOrderPrice = ? WHERE orderID = ? AND sparePartNum = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("idii", $newQty, $price, $orderID, $sparePartNum);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order item updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Order item update failed']);
        }

    } else {
        // Insert new order item
        $insertItemSql = "INSERT INTO ordersitem (orderID, sparePartNum, orderQty, sparePartOrderPrice, sparePartCategory) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertItemSql);
        $stmt->bind_param("iiidi", $orderID, $sparePartNum, $Qty, $price, $category);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order item inserted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Order item insert failed']);
        }
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}




?>


