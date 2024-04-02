<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";
session_unset();
$_SESSION['errmsg']="You have successfully logout";
header('location:login.php');
?>

