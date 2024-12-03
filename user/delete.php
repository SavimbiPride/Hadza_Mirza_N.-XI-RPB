<?php
session_start();
require 'conn.php';

$id = $_GET['id'];
$query = "DELETE FROM transaksi WHERE id='$id'";
$data = mysqli_query($connection, $query);

if ($data) {
    header("location:read.php");
} else {
    echo "<script>alert('Error deleting record or permission denied.'); window.location.href = 'read.php';</script>";
}
?>
