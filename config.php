<?php
$host = "localhost";
$user = "root"; // Change if needed
$pass = "";
$dbname = "luxe_attiredb";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
