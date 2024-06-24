<?php
// 開啟錯誤報告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 檢查是否有POST請求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 數據庫連接信息
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "projectdb";

    // 創建連接
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 檢查連接
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 從表單獲取數據並進行基本的驗證
    $dealerID = mysqli_real_escape_string($conn, $_POST['dealerID']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // 實際情況應該使用password_hash進行加密
    $dealerName = mysqli_real_escape_string($conn, $_POST['dealerName']);
    $contactName = mysqli_real_escape_string($conn, $_POST['contactName']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $faxNumber = mysqli_real_escape_string($conn, $_POST['faxNumber']);
    $deliveryAddress = mysqli_real_escape_string($conn, $_POST['address']);

    // 準備SQL語句並綁定參數
    $stmt = $conn->prepare("INSERT INTO Dealer (dealerID, password, dealerName, contactName, contactNumber, faxNumber, deliveryAddress) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiis", $dealerID, $password, $dealerName, $contactName, $contactNumber, $faxNumber, $deliveryAddress);

    // 執行語句
    if ($stmt->execute()) {
        echo "Sign up successful";
        // 暫停2秒後重定向到登錄頁面
        sleep(2);
        header('Location: ../LoginDealer.html');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // 關閉語句和連接
    $stmt->close();
    $conn->close();
}
?>
