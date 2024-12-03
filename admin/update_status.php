<?php
session_start();
require 'conn.php';

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE transaksi SET status='$status' WHERE id='$id'";
    if (mysqli_query($connection, $query)) {
        $_SESSION['message'] = 'berhasil diterima!';
        $_SESSION['msg_type'] = 'success'; 
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = 'Gagal memperbarui status: ' . mysqli_error($connection);
        $_SESSION['msg_type'] = 'danger'; 
    }
}
?>



