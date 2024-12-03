<?php
require 'conn.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); 
    $query = "DELETE FROM user WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location: management_user.php?status=deleted");
        exit();
    }
} else {
    header("Location: management_user.php");
    exit();
}
