<?php
$conn = new mysqli("localhost", "root", "", "raumbuchung");
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen");
}
session_start();
?>
