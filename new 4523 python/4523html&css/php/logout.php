<?php

    setcookie("DealerName" , "" , time() , -100);
    setcookie("ManagerName" , "" , time() , -100);
    header("Location: ../index.html");
    exit();
    
?>

