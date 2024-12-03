<?php
include 'conn.php';
session_start();
$id = $_SESSION['id'];

if (isset($_POST['update_profile'])) {
    $update_name = mysqli_real_escape_string($connection, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);

    $select_old = mysqli_query($connection, "SELECT username, email FROM user WHERE id = '$id'") or die('query failed');
    $old_data = mysqli_fetch_assoc($select_old);
    
    if ($update_name != $old_data['username']) {
        mysqli_query($connection, "UPDATE user SET username = '$update_name' WHERE id = '$id'") or die('query failed');
        $message[] = 'Name updated successfully!';
    }

    if ($update_email != $old_data['email']) {
        mysqli_query($connection, "UPDATE user SET email = '$update_email' WHERE id = '$id'") or die('query failed');
        $message[] = 'Email updated successfully!';
    }

    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($connection, ($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($connection, ($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($connection, ($_POST['confirm_pass']));

    $result = mysqli_query($connection, "SELECT password FROM user WHERE id = '$id'") or die('query failed');
    $row = mysqli_fetch_assoc($result);
    $current_pass = $row['password'];

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $current_pass) {
            $message[] = 'Old password not matched!';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'Confirm password not matched!';
        } else {
            mysqli_query($connection, "UPDATE user SET password = '$confirm_pass' WHERE id = '$id'") or die('query failed');
            $message[] = 'Password updated success!';
        }
    }

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'img/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image is too large';
        } else {
            mysqli_query($connection, "UPDATE user SET image = '$update_image' WHERE id = '$id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            $message[] = 'Image updated success!';
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
   <title>Update Profile</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style=" background-color: #64605f;">
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h3>Profile Anda</h3>
        </div>
        <div class="card-body">
            <?php
            $select = mysqli_query($connection, "SELECT * FROM user WHERE id = '$id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="text-center mb-3">
                    <?php
                    if ($fetch['image'] == '') {
                        echo '<img src="img/default-avatar.png" class="img-thumbnail" style="width: 150px; height: 150px;">';
                    } else {
                        echo '<img src="img/' . $fetch['image'] . '" class="img-thumbnail" style="width: 150px; height: 150px;">'; 
                    }
                    ?>
                </div>
                <?php
                if (isset($message)) {
                    foreach ($message as $msg) {
                        $alert_type = strpos($msg, 'not matched') !== false || strpos($msg, 'Failed') !== false || strpos($msg, 'too large') !== false ? 'alert-danger' : 'alert-success';
                        echo '<div class="alert ' . $alert_type . ' alert-dismissible fade show" role="alert">';
                        echo $msg;
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';
                    }
                }                
                ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="update_name" class="form-label">Username:</label>
                        <input type="text" name="update_name" id="update_name" value="<?php echo $fetch['username']; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="update_email" class="form-label">Your Email:</label>
                        <input type="email" name="update_email" id="update_email" value="<?php echo $fetch['email']; ?>" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="update_image" class="form-label">Update Your Pic:</label>
                    <input type="file" name="update_image" id="update_image" accept="image/jpg, image/jpeg, image/png" class="form-control">
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                        <label for="update_pass" class="form-label">Old Password:</label>
                        <div class="input-group">
                            <input type="password" name="update_pass" id="update_pass" placeholder="Enter previous password" class="form-control">
                            <button type="button" onclick="togglePassword('update_pass')" class="btn btn-outline-secondary">Show</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="new_pass" class="form-label">New Password:</label>
                        <div class="input-group">
                            <input type="password" name="new_pass" id="new_pass" placeholder="Enter new password" class="form-control">
                            <button type="button" onclick="togglePassword('new_pass')" class="btn btn-outline-secondary">Show</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_pass" class="form-label">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm new password" class="form-control">
                        <button type="button" onclick="togglePassword('confirm_pass')" class="btn btn-outline-secondary">Show</button>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" value="Update Profile" name="update_profile" class="btn btn-primary">
                    <a href="profile.php" class="btn btn-secondary">Go Back</a>
                </div>
            </form>
        </div>    
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
