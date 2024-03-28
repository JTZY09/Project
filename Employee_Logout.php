<?php
    setcookie("username", "", time() -3600);
    header("Location:Employee_Login.php")
?>