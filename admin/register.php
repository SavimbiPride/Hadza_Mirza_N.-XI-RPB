<?php
session_start();
require 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    .main {
        height: 100vh;
        background-color: ;
    }

    .login-box {
        width: 500px;
        height: 400px;
        box-sizing: border-box;
        border-radius: 10px;
        background-color: #64605f;
    }
    body {
        background-image: url('img/logo c&c.jpeg');
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat;
    }
</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
            <h1 style ="color: #ffffff;">Register</h1>
                <div>
                    <label for="username">username</label>
                    <input type="text" class="form-control" name="username" placeholder="Hadza" required>
                </div>
                <div>
                    <label for="password">password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div>
                    <label for="password">email</label>
                    <input type="text" class="form-control" name="email" placeholder="abc@gmail.com" required>
                </div>
                <div>
                    <button class="btn btn-primary form-control mt-3" type="submit" name="btntambah">submit</button>
                </div>
            </form>
            <br>
            <a style="color: #ffffff;" href="login.php">have account?. log in now</a>
        </div>
        <div>
        <?php
            if (isset($_POST['btntambah'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];

                $query = "INSERT INTO admin (username, password, email) VALUES ('$username', '$password', '$email')";
                mysqli_query($connection, $query);

                header("Location: login.php");
            }
        ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>