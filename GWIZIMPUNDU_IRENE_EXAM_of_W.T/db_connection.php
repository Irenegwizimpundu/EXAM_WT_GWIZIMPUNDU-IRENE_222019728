<?php
// Connection details
$host = "localhost";
$user = "IRENE";
$pass = "GWIZIMPUNDU$06.";
$database = "fitnesstrackerapplication";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>