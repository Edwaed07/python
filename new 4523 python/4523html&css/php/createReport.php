<?php



    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
    $sql = "SELECT COUNT(*) FROM item ";
    $rs = $conn->query($sql);
    $count = mysqli_fetch_array($rs)[0];
    $Qty = 0;
    $price = 0;

    echo"<table class='order-table'>
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

    for ($i=1; $i<=$count; $i++){
        $selectSql = "SELECT * FROM ordersitem where sparePartNum =".$i;
        $rs = $conn->query($selectSql);
        if ($rs->num_rows > 0) {
            while($row = $rs->fetch_assoc()) {
            $Qty += $row['orderQty'];
            $price += $row['sparePartOrderPrice'];
            }

            $selectItemSql = "SELECT * FROM item WHERE sparePartNum = " . $i;
            $itemResult = $conn->query($selectItemSql);
    
            if ($itemResult->num_rows > 0) {
                $itemRow = $itemResult->fetch_assoc();
                echo "
                
                        <tr>
                            <td><img src=../sample images".$itemRow['sparePartImage']." style='width:50px; height:50px'></td>
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


    echo"</tbody>";







?>




<!DOCTYPE html>
<html>

<link rel="stylesheet" href="../css/report.css" type="text/css">


<body>

<h1>Report</h1> 
  
  <table class="order-table">
    <thead>
      <tr>
        <th >Spare Part Number</th>
        <th>Spare Part Name</th>
        
        <th>Spare Part Image</th>
        
        <th>Total number </th>
        <th>Total sales amount</th>
        
        
        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>A001</td>
        <td>Car door</td>
        <td><img src="sample images/A-Sheet Metal/100001.jpg" width="50px" height="50px"> </td>
        <td>300</td>
        <td>830,000</td>
        
      </tr>
  
      <tr>
        <td>B004</td>
        <td>Seat</td>
        <td><img src="sample images/B-Major Assemblies/200004.png" width="50px" height="50px"> </td>
        <td>500</td>
        <td>$450,000</td>
      
      </tr>
  
    <tr>
      <td>C003</td>
      <td>Car light</td>
      <td><img src="sample images/C-Light Components/300003.png" width="50px" height="50px"> </td>
      <td>2400</td>
      <td>$3,600,000</td>
      
    </tr>
  
    <tr>
      <td>D005</td>
      <td>Floor mats/td>
      <td><img src="sample images/D-Accessories/400005.png" width="50px" height="50px"> </td>
      <td>50000</td>
      <td>$1,000,000</td>
      
    </tr>
  
    </tbody>


</body>
</html>