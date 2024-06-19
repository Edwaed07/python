
<?php
            echo 'test';
            
                $email = $_POST["email"];
                $passwd = $_POST["passwd"];
                $conn = mysqli_connect('127.0.0.1', 'root', '', 'projectdb') or die(mysqli_connect_error());
                $sql = "SELECT * FROM dealer where dealerID = '".$email."' and password ='".$passwd"'";
                
                $rs = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo"alert='login success'";
                    
                    mysqli_close($conn);
                }
               
                
                while($rc = mysqli_fetch_assoc($rs)) {
                    if($rc['dealerID'] == $email){
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
            
        ?>
