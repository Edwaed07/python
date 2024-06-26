<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if there is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "projectdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from forms and perform basic validation
    $salesManagerID = mysqli_real_escape_string($conn, $_POST['salesManagerID']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // 實際情況應該使用password_hash進行加密
    $managerName = mysqli_real_escape_string($conn, $_POST['managerName']);
    $contactName = mysqli_real_escape_string($conn, $_POST['contactName']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);

    // Prepare SQL statements and bind parameters
    $stmt = $conn->prepare("INSERT INTO salesmanager (salesManagerID, password, managerName, contactName, contactNumber) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $salesManagerID, $password, $managerName, $contactName, $contactNumber);

    if ($stmt->execute()) {
        echo "Sign up successful";
        // Redirect to login page after 2 seconds pause
        sleep(2);
        header('Location: ../LoginSales.html');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>