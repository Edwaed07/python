<?php
    extract($_POST);
    $conn = mysqli_connect('localhost', 'root', '', 'projectdb') or die(mysqli_connect_error());
    session_start();
    $dealerID = $_SESSION['loginID'];

    $sql = "UPDATE dealer SET contactNumber = $tel, faxNumber = $fax, deliveryAddress = '$addr'";
    if(!empty($passwd)){
        $sql .= ", password = '$passwd'";
    }
    $sql .= " WHERE dealerID = '$dealerID'";
    $rs = mysqli_query($conn, $sql);
    if(mysqli_affected_rows($conn) > 0){
        header('Location: ../update.php?result=success');
    } else {
        header('Location: ../update.php?result=fail');
    }
    
    mysqli_close($conn);
    exit();
?>