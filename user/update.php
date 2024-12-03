<?php
require 'conn.php';

$id = $_GET['id'];

// Pastikan ID terdefinisi dan ambil data transaksi berdasarkan ID
$query = "SELECT * FROM transaksi WHERE id = '$id'";
$cek = mysqli_query($connection, $query);

if (mysqli_num_rows($cek) > 0) {
    $data = mysqli_fetch_assoc($cek);
} else {
    echo "<script>alert('Data tidak ditemukan.'); window.location.href='read.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 500px;">
            <div class="card-header text-center">
                <h3>Update Order</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nickname" class="form-label">Nickname</label>
                        <input type="text" class="form-control" name="nickname" value="<?= htmlspecialchars($data['nickname']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="text" class="form-control" name="order" value="<?= htmlspecialchars($data['order']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= htmlspecialchars($data['tanggal']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam" class="form-label">Jam</label>
                        <input type="time" class="form-control" name="jam" value="<?= htmlspecialchars($data['jam']) ?>" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit" name="btnupdate">Edit</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="read.php" class="btn btn-secondary">Return</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($_POST['btnupdate'])) {
        $nickname = mysqli_real_escape_string($connection, $_POST['nickname']);
        $order = mysqli_real_escape_string($connection, $_POST['order']);
        $tanggal = mysqli_real_escape_string($connection, $_POST['tanggal']);
        $jam = mysqli_real_escape_string($connection, $_POST['jam']);

        $update_query = "UPDATE transaksi SET nickname = '$nickname', `order` = '$order', tanggal = '$tanggal', jam = '$jam' WHERE id = '$id'";
        $data = mysqli_query($connection, $update_query);

        if ($data) {
            echo "<script>
                    alert('Data berhasil di edit.');
                    window.location.href = 'read.php';
                  </script>";
        } else {
            echo "<script>alert('Error updating record: " . mysqli_error($connection) . "');</script>";
        }
    }
    ?>
</body>
</html>
