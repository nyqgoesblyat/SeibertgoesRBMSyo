<?php
include 'db.php';

if($_SESSION['rolle'] == 'admin'){
    $id = $_GET['id'];
    $status = $_GET['s'];
    $conn->query("UPDATE buchungen SET status='$status' WHERE id=$id");
}

header("Location: dashboard.php");
?>
