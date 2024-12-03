<?php
require 'conn.php';
if (isset($_POST['btnlogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = mysqli_query($connection, "SELECT * FROM user WHERE username='$username' AND password='$password' AND email='$email'");
    if ($query && $query->num_rows == 1) {
        $row = mysqli_fetch_assoc($query); 

        session_start();
        $_SESSION['id'] = $row['id'];  
        $_SESSION['username'] = $row['username'];  
        header("Location: dashboard.php"); 
        exit("<script>alert('Berhasil');</script>");
    } else {
        $error_message = 'Username, password, atau email salah';
    }

    $connection->close();
}
?>
<?php
session_start();
if (isset($_SESSION['success_message'])) {
    echo "<script>alert('{$_SESSION['success_message']}');</script>";
    unset($_SESSION['success_message']); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-image: url('img/logo c&c.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .card {
            width: 450px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(165, 164, 164, 0.8);
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card text-center">
        <div class="card-header">
            <h3>Login</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="text-center mb-3">
                    <?php
                    if (isset($error_message)) {
                        echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button type="button" id="togglePasswordBtn" class="btn btn-outline-secondary" onclick="togglePassword()">Show</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div>
                    <button class="btn btn-primary form-control mt-3" type="submit" name="btnlogin">Login</button>
                </div>
            </form>
            <div class="card-footer text-body-secondary">
                <a href="register.php">not have an account?</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleButton = document.getElementById("togglePasswordBtn");

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
