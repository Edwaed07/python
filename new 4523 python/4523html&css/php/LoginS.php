<?php
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    if($email == "" || $passwd == ""){
        header("Location: ../LoginDealer.html");
    }
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
    $sql = "SELECT COUNT(*) FROM salesmanager where salesManagerID = '".$email."' and password ='".$passwd."'";
    $rs = $conn->query($sql);
    $count = mysqli_fetch_array($rs)[0];
    if ($count >= 1) {
        setcookie("managerName", $email, time() + 7200);
        // Redirect to item.html
        header("Location: ../item.html");
        exit();
    } else {
        echo ''.$email.' '.$passwd;
        echo "Error email or password";
    }
    mysqli_close($conn);
?>