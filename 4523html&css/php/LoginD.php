
<?php
            echo 'test';
            if(isset($_POST["submit"])){
                $email = $_POST["email"];
                $passwd = $_POST["passwd"];
                $conn = mysqli_connect('localhost', 'root', '', 'projectdb') or die(mysqli_connect_error());
                $sql = "SELECT dealerID, password FROM dealer";
                $rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $userExists = false;
                
                while($rc = mysqli_fetch_assoc($rs)) {
                    if($rc['dealerID'] == $email){
                        $userExists = true;
                        if($rc['password'] == $passwd){
                            session_start();
                            $_SESSION['isLogin'] = 'D';
                            $_SESSION['loginID'] = $email;
                            header('Location: ../home.html');
                            mysqli_free_result($rs);
                            mysqli_close($conn);
                            exit();
                        } else {
                            echo '<script type="text/javascript">
                            document.getElementById("error").innerHTML = "Password Incorrect!";
                            document.getElementById("error").style.display = "block";
                            </script>';
                        }
                    }
                }
            }
        ?>
