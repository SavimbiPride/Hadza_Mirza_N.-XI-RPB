<?php
session_start();
require 'conn.php';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($connection, $_POST['name']);
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $pass = mysqli_real_escape_string($connection, $_POST['password']);
   $cpass = mysqli_real_escape_string($connection, $_POST['cpassword']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'img/' . $image;

   $select = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $message[] = 'User already exists';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Confirm password not matched!';
      } elseif ($image_size > 2000000) {
         $message[] = 'Image size is too large!';
      } else {
         $insert = mysqli_query($connection, "INSERT INTO user(username, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');

         if ($insert) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $_SESSION['success_message'] = 'Registered success!';
            header('location:login.php');
            exit();
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-secondary">
<div class="card text-center" style="width: 400px; background-color: rgba(165, 164, 164, 0.8);">
   <div class="card-header">
      <h3>Register Now</h3>
   </div>
   <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
         <?php if (isset($message)) {
            foreach ($message as $msg) {
               echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
            }
         } ?>
         <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" id="name" placeholder="Enter username" class="form-control" required>
         </div>
         <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email" class="form-control" required>
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
               <input type="password" name="password" id="password" placeholder="Enter password" class="form-control" required>
               <button type="button" onclick="togglePassword('password')" class="btn btn-outline-secondary">Show</button>
            </div>
         </div>
         <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <div class="input-group">
               <input type="password" name="cpassword" id="cpassword" placeholder="Confirm password" class="form-control" required>
               <button type="button" onclick="togglePassword('cpassword')" class="btn btn-outline-secondary">Show</button>
            </div>
         </div>
         <div class="mb-3">
            <label for="image" class="form-label">Profile</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/jpg, image/jpeg, image/png">
         </div>
         <button type="submit" name="submit" class="btn btn-primary w-100">Register Now</button>
      </form>
   </div>
   <div class="card-footer">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
   function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const button = field.nextElementSibling;
      if (field.type === "password") {
         field.type = "text";
         button.textContent = "Hide";
      } else {
         field.type = "password";
         button.textContent = "Show";
      }
   }
</script>
</body>
</html>
