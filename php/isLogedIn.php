<?php

session_start();

if($_SESSION['cookiename'] == "") {
 header("Location: php/login.php");
}
 ?>
