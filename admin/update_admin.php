<?php
session_start();
require 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #524646; height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="card text-center" style="width: 450px; background-color: rgba(165, 164, 164, 0.8);">
            <div class="card-header">
                <h3>Update Admin</h3>
            </div>

            <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM admin WHERE id = '$id'";
                $cek = mysqli_query($connection, $query);
                $data = mysqli_fetch_assoc($cek);
            ?>

            <form action="" method="post" class="p-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" value="<?= $data['password'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>" required>
                </div>
                <button class="btn btn-primary w-100 mt-3" type="submit" name="btnupdate">Update Admin</button>
            </form>
            <div class="card-footer text-body-secondary">
                <a href="management_admin.php" class="btn btn-outline-light">Return</a>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['btnupdate'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query = "UPDATE admin SET username = '$username', password = '$password', email = '$email' WHERE id = '$id'";
        $data = mysqli_query($connection, $query);

        if ($data) {
            echo "<script>alert('berhasil diedit'); window.location.href='management_admin.php';</script>";
            exit();
        } else {
            $error = mysqli_error($connection);
            echo "<script>alert('Error: $error');</script>";
        }
    }
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
