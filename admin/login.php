<?php
require 'conn.php';
session_start();
if (isset($_POST['btnlogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = mysqli_query($connection, "SELECT * FROM admin WHERE username='$username' AND password='$password' AND email='$email'");
    if ($query->num_rows == 1) {
        $row = mysqli_fetch_assoc($query);

        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = 'Username, password, atau email salah';
    }
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card text-center shadow-lg p-4" style="width: 100%; max-width: 400px; background-color: #8c8989; color: white;">
    <div class="card-header">
        <h3>Login</h3>
    </div>
    <form action="" method="post" class="p-3">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger text-center mb-3" role="alert">
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" required>
                <button type="button" onclick="togglePassword()" class="btn btn-outline-secondary">Show</button>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <button class="btn btn-primary w-100 mt-3" type="submit" name="btnlogin">Login</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleButton = passwordField.nextElementSibling;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.textContent = "Hide";
        } else {
            passwordField.type = "password";
            toggleButton.textContent = "Show";
        }
    }
</script>
</body>
</html>