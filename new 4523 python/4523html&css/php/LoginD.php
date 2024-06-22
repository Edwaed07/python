<?php
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    if($email == "" || $passwd == ""){
        header("Location: ../LoginSales.html");
    }
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
    $sql = "SELECT COUNT(*) FROM dealer where dealerID = '".$email."' and password ='".$passwd."'";
    $rs = $conn->query($sql);
    $count = mysqli_fetch_array($rs)[0];
    if ($count >= 1) {
        setcookie("DealerID", $email, time() + 720000000);
        // Redirect to home.php
        header("Location: home.php");
        exit();
    } else {
        echo ''.$email.' '.$passwd;
        echo "Error email or password";
    }
    mysqli_close($conn);
?>