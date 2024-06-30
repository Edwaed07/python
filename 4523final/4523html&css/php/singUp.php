<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "projectdb";


    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

 
    $dealerID = mysqli_real_escape_string($conn, $_POST['dealerID']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    $dealerName = mysqli_real_escape_string($conn, $_POST['dealerName']);
    $contactName = mysqli_real_escape_string($conn, $_POST['contactName']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $faxNumber = mysqli_real_escape_string($conn, $_POST['faxNumber']);
    $deliveryAddress = mysqli_real_escape_string($conn, $_POST['address']);



    $stmt = $conn->prepare("INSERT INTO Dealer (dealerID, password, dealerName, contactName, contactNumber, faxNumber, deliveryAddress) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiis", $dealerID, $password, $dealerName, $contactName, $contactNumber, $faxNumber, $deliveryAddress);

    // 執行語句
    if ($stmt->execute()) {
        echo "<script>
        alert('Sign up successful');
        window.location.href = 'loginD.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // 關閉語句和連接
    $stmt->close();
    $conn->close();
}
?>
