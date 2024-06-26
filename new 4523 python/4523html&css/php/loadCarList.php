<link rel="stylesheet" type="text/css" href="../css/item.css">

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
    $totalWeight = 0;
    $totalQty = 0;

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th></th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            $selectItemSql = "SELECT * FROM item WHERE sparePartNum = " . $row["sparePartNum"];
            $itemResult = $conn->query($selectItemSql);
            
    
            if ($itemResult->num_rows > 0) {
                $itemRow = $itemResult->fetch_assoc();
                $img = $itemRow['sparePartImage'];
			          $path = "../sample images/";
                $totalWeight += $itemRow['weight'] * $row["orderQty"];
            }


            $totalPrice += $row["orderQty"] * $row["sparePartOrderPrice"];
            $totalQty += $row["orderQty"];
            echo "<tr>
                    <td><img src='". $path . $img ."' style='width:50px; height:50px'></td>
                    <td>".$row["sparePartNum"]."</td>
                    <td>".$row["orderQty"]."</td>
                    <td>".$itemRow["weight"]."</td>
                    <td>".$row["sparePartOrderPrice"]."</td>
                    <td>
                        <button onclick='deleteOrdersItem(".$row["sparePartNum"].")'>Delete</button>
                        
                    </td>
                  </tr>";
        }
        
            echo "<tr>
                    <td>Total :</td>
                    <td></td>
                    <td>".$totalQty."</td>
                    <td>".$totalWeight."</td>
                    <td>".$totalPrice."</td>
                    <td></td>
                </tr>

                
              </table>
              <br> <br> ";

              echo "<div style=\"display: flex; justify-content: space-between; align-items: flex-start;\">
              <div id=\"shippingOpt\" style=\"flex-grow: 1;\">
                <h3>Shipping Options</h3>
                  <div id=\"shipping-container\" style=\"display: flex;\">
                      <div id=\"weightMode\" style=\"margin-right: 20px;\">
                          <table>
                              <tr><th colspan=\"6\">Weight Mode</th></tr>
                              <tr><td><b>Initial cost of First 1 kg</b></td><td><td>HKD 300<td><td><td></td></tr>
                              <tr><td><b>Per next 1 kg (The second kg)</b></td><td><td>HKD 50<td><td><td></td></tr>
                              <tr><td><b>Maximum weight</b></td><td><td>70 kg per order<td><td><td></td></tr>
                          </table>
                      </div>
                      <div id=\"quantityMode\">
                          <table>
                              <tr><th colspan=\"6\">Quantity Mode</th></tr>
                              <tr><td><b>Initial cost of First unit</b></td><td><td>HKD 300<td><td><td></td></tr>
                              <tr><td><b>Per next unit(The second unit)</b></td><td><td>HKD 60<td><td><td></td></tr>
                              <tr><td><b>Maximum item quantity</b></td><td><td>30 units per order<td><td><td></td></tr>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <br>
                        <div style=\"flex-grow: 1;\">
                                        <h3>Choose</h3>
                  <label for=\"qty\"><input type=\"radio\" name=\"shipping\" id=\"qty\" checked onclick=\"getDeliveryFee('quantity')\"> Quantity</label>
                  <label for=\"weight\"><input type=\"radio\" name=\"shipping\" id=\"weight\" onclick=\"getDeliveryFee('weight')\"> Weight</label>
              </div>
              <br>
          <div id=\"divTotal\">
              <p><b>Total Quantity : ".$totalQty."</b><span id=\"totalQty\"></span></p>
              <p><b>Total Weight : ".$totalWeight."</b><span id=\"totalWeight\"></span></p>
              <table id=\"total-display\">
                  <tr><th>Item total<td>$".$totalPrice."</th><td id=\"subtotal\"></td></tr>
                  <tr><th>Delivery Fee</th><td id=\"deliveryFee\"></td></tr>
                  <tr><th>Total</th><td id=\"total\"></td></tr>
              </table>
          </div>
          <br><br>
          <button onclick=\"placeOrder()\" class=\"green\">Order</button>
      </div>";
    }
} else {
    echo "<h3>There is no item added into Car List</h3>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/carlist.css" type="text/css">
</head>
<body>
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

        function getDeliveryFee(mode) {
            // 獲取用戶輸入的數量或重量
            var value = mode === 'quantity' ? document.getElementById('totalQty').textContent : document.getElementById('totalWeight').textContent;

            // 構建API請求URL
            var apiUrl = 'http://127.0.0.1:8080/ship_cost_api/' + mode + '/' + value;

            // 發送GET請求到Flask應用程序
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.result === 'accepted') {
                        // 更新運輸成本到用戶界面
                        document.getElementById('deliveryFee').textContent = 'HKD ' + data.cost;
                        // 更新總計
                        updateTotal();
                    } else {
                        // 處理錯誤情況
                        alert(data.reason);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function updateTotal() {
            // 獲取小計和運輸成本
            var subtotal = parseFloat(document.getElementById('subtotal').textContent);
            var deliveryFee = parseFloat(document.getElementById('deliveryFee').textContent.replace('HKD ', ''));
            
            // 計算總計
            var total = subtotal + deliveryFee;
            document.getElementById('total').textContent = 'HKD ' + total.toFixed(2);
        }

        // 確保在頁面加載時更新總計
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();
        });
    </script>
</body>
</html>
