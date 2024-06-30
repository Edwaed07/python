<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
$sql = "SELECT COUNT(*) FROM item ";
$rs = $conn->query($sql);
$count = mysqli_fetch_array($rs)[0];
$Qty = 0;
$price = 0;

echo "<table class='order-table'>
            <thead>
                <tr>
                    <th>Spare Part Image</th>
                    <th >Spare Part Number</th>
                    <th>Spare Part Name</th>
                    <th>Total number </th>
                    <th>Total sales amount</th>
                
                </tr>
            </thead>
            
            <tbody>";

for ($i = 1; $i <= $count; $i++) {
    $selectSql = "SELECT * FROM ordersitem where sparePartNum =" . $i;
    $rs = $conn->query($selectSql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $Qty += $row['orderQty'];
            $price += $row['orderQty'] * $row['sparePartOrderPrice'];
        }

        $selectItemSql = "SELECT * FROM item WHERE sparePartNum = " . $i;
        $itemResult = $conn->query($selectItemSql);

        if ($itemResult->num_rows > 0) {
            $itemRow = $itemResult->fetch_assoc();
            $img = $itemRow['sparePartImage'];
            $path = "../sample images/";
            echo "
                
                        <tr>
                            <td><img src='" . $path . $img . "' style='width:50px; height:50px'></td>
                            <td>" . $itemRow["sparePartNum"] . "</td>
                            <td>" . $itemRow["sparePartName"] . "</td>
                            <td>" . $Qty . "</td>
                            <td>" . $price . "</td>
                        </tr>";
        }

        // Reset quantities and prices for the next iteration
        $Qty = 0;
        $price = 0;
    }
}
echo "</tbody>";
?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" href="../css/report.css" type="text/css">



</html>