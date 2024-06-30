<?php

setcookie("DealerID", "", time(), -100);
setcookie("ManagerID", "", time(), -100);
header("Location: ../index.html");
exit();

?>