<?php
session_start();
require 'conn.php';
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #64605f;">
<div class="container mt-5" style="max-width: 500px;">
   <div class="card text-center">
       <div class="card-header">
           <h3>Profile Anda</h3>
       </div>
       <div class="card-body">
           <?php       
           $select = mysqli_query($connection, "SELECT * FROM user WHERE id = '$id'") or die('query failed');

           if(mysqli_num_rows($select) > 0) {
               $row = mysqli_fetch_assoc($select);

               if ($row['image'] == '') {
                   echo '<img src="img/default-avatar.png" class="img-thumbnail" style="width: 150px; height: 150px;">';
               } else {
                   echo '<img src="img/'.$row['image'].'" class="img-thumbnail" style="width: 150px; height: 150px;">';
               }

               echo '<h3 class="mt-3">' . ($row['username']) . '</h3>';
           } else {
               echo '<p class="text-danger">User not found.</p>'; 
           }
           ?>
           <div class="mt-4">
               <a href="update_profile.php" class="btn btn-primary">Update Profile</a>
               <!-- Tombol Logout dengan modal konfirmasi -->
               <button class="btn btn-danger" onclick="showLogoutModal()">Log out</button>
           </div>
       </div>
       <div class="card-footer text-muted">
           <a href="dashboard.php" class="btn btn-outline-secondary">Back to Dashboard</a>
       </div>
   </div>
</div>

<!-- Modal konfirmasi logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Log out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <!-- Tombol Ya untuk konfirmasi logout -->
                <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
// Fungsi untuk menampilkan modal konfirmasi logout
function showLogoutModal() {
    var logoutModal = new bootstrap.Modal(document.getElementById("logoutModal"));
    logoutModal.show();
}
</script>
</body>
</html>
