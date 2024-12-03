<?php
require 'conn.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id']; 

if (isset($_POST['add'])) {
    $nickname = $_POST['nickname'];
    $order = $_POST['order'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    $query = "INSERT INTO transaksi (user_id, nickname, `order`, tanggal, jam) 
              VALUES ('$user_id', '$nickname', '$order', '$tanggal', '$jam')";
    $data = mysqli_query($connection, $query);

    if (!$data) {
        die("Error: " . mysqli_error($connection));
    }
    header("Location: read.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-image: url('img/logo c&c.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="card text-center" style="width: 500px; background-color: rgba(165, 164, 164, 0.8);">
            <div class="card-header">
                <h3>Order</h3>
            </div>
            <form action="" method="post" class="d-flex flex-column align-items-center">
                <div class="mb-3 w-75">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" class="form-control" name="nickname" required>
                </div>
                <div class="mb-3 w-75">
                    <label for="order" class="form-label">Order</label>
                    <textarea class="form-control" name="order" rows="3" required></textarea>
                </div>
                <div class="mb-3 w-75">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>
                <div class="mb-3 w-75">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" class="form-control" name="jam" required>
                </div>
                <button class="btn btn-primary w-75 mt-3" type="submit" name="add">Order</button>
            </form>
            <div class="card-footer text-body-secondary">
                <a href="dashboard.php" class="btn btn-outline-light">Return</a>
            </div>    
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
