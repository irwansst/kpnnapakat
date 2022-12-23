<?php

$server = "localhost";
$username = "root";
$password = "k124t05";
$database = "db_napakat";

// Koneksi dan memilih database di server
($GLOBALS["___mysqli_ston"] = mysqli_connect($server, $username, $password)) or die("Koneksi gagal");
mysqli_select_db($GLOBALS["___mysqli_ston"], $database) or die("Database tidak bisa dibuka");
?>
