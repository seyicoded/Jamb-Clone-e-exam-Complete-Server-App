<?php
    session_start();
    session_destroy();
    header("Location:adminlogin.php");
    echo "<script>window.location.replace('adminlogin.php');</script>";
?>