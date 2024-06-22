<?php

    setcookie("DealerID" , "" , time() , -100);
    setcookie("managerID" , "" , time() , -100);
    header("Location: ../index.html");
    exit();
    
?>

