<?php


$dealerID = $_COOKIE['DealerID'];


$conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());

// 檢查POST請求是否存在
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單數據
    $contactNumber = isset($_POST['tel']) ? $_POST['tel'] : '';
    $faxNumber = isset($_POST['fax']) ? $_POST['fax'] : '';
    $deliveryAddress = isset($_POST['addr']) ? $_POST['addr'] : '';
    $password = isset($_POST['passwd']) ? $_POST['passwd'] : ''; // 確保對密碼進行了適當的加密處理
    $confirmPassword = isset($_POST['passwd2']) ? $_POST['passwd2'] : '';

    // 確認兩次密碼輸入是否一致
    if ($password !== $confirmPassword) {
        die('Passwords do not match.');
    }

    // 創建SQL更新語句
    $sql = "UPDATE Dealer SET 
                contactNumber = ?,
                faxNumber = ?,
                deliveryAddress = ?,
                password = ?
            WHERE dealerID = ?";

    // 預處理SQL語句
    $stmt = mysqli_prepare($conn, $sql);
    // 綁定參數
    mysqli_stmt_bind_param($stmt, 'sssss', $contactNumber, $faxNumber, $deliveryAddress, $password, $dealerID);
    // 執行語句
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }

    // 關閉語句
    mysqli_stmt_close($stmt);
}

// 關閉數據庫連接
mysqli_close($conn);
?>
