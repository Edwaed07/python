
<?php
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    if($email == "" || $passwd == ""){
        header("Location: ../LoginSales.html");
        exit();
    }
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());

    $sql = "SELECT COUNT(*) FROM salesmanager where salesManagerID = '".$email."'";
    $rs = $conn->query($sql);
    $dealerExists = mysqli_fetch_array($rs)[0] > 0;

    if ($dealerExists) {
        $sql = "SELECT COUNT(*) FROM salesmanager where salesManagerID = '".$email."' and password ='".$passwd."'";
        $rs = $conn->query($sql);
        $count = mysqli_fetch_array($rs)[0];
        if ($count >= 1) {
            setcookie("ManagerID", $email, time() + 720000000);
            header("Location: ../item.html");
            exit();
        } else {
            $errorMessage = "Error password";
        }
    } else {
        $errorMessage = "Error email";
    }

    if (isset($errorMessage)) {
        echo "<!DOCTYPE html>
        <html>
        <head>
        <title>Login Error</title>
        <style>
            .error-message {
                font-size: 24px; 
                margin: 20px;
            }
            .back-btn {
                width: 100px;
                padding: 10px;
                margin: 20px auto;
                background-color: #007bff;
                color: white;
                font-size: 20px;
                border-radius: 5px;
            }
        </style>
        </head>
        <body>
        <div class='error-message'>" . $errorMessage . "</div>
        <a href='../LoginSales.html' class='back-btn'>Back</a>
        </body>
        </html>";
    }
    mysqli_close($conn);
?>
