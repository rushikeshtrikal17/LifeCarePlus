<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lifecare_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed");
}
?>