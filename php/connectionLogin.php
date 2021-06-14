<?php

$servername = "localhost";
$username = "adminTest";
$password = "12345678";
$dbname = "testDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

 ?>
