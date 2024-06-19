<!DOCTYPE html>
<html>

    <link rel="stylesheet" type="text/css" href="../css/item.css">

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
    echo "

    <script>
        function redirectToNewPage() {
            parent.location.href = '../Add Item Form.html';
        }

        function deleteItem(sparePartNum) { 
           if (confirm('Are you sure you want to delete this item?')) {
               var xhr = new XMLHttpRequest();
               xhr.open('POST', 'deleteItem.php', true);
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

        function editItem(sparePartNum) { 
            window.location.href = 'editItem.php?sparePartNum=' + sparePartNum;
        }
   
    </script>
    
    
    <table  class='order-table'> 
    <tr>
    <th>Item ID</th>
    <th>Category</th>
    <th>Name</th>
    <th>Weight</th>
    <th>Price</th>
    <th>Quantity</th>
    <th></th>
    <th>
          
          <button onclick='redirectToNewPage()' >Add Item</button>
          
    </th>
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
          <button onclick='deleteItem(".$row["sparePartNum"].")'>Delete</button>
        </td>
        <td>
          <button onclick='editItem(".$row["sparePartNum"].")'>Edit item</button>
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