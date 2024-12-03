<?php 
require 'conn.php';
session_start();

$sql = "SELECT COUNT(id) as total_admin FROM admin";
$result = mysqli_query($connection, $sql);

$total_admin = 0;
if ($result && $row = mysqli_fetch_assoc($result)) {
    $total_admin = $row['total_admin'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #64605f;">
<?php require 'navbar.php'; ?>
<br><br><br>
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Admin Management</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <h5>Total Admin: <?php echo $total_admin; ?></h5>
            </div>

            <table class="table table-dark table-hover table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM admin";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>    
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td>
                                <a href="update_admin.php?id=<?php echo $row['id'];?>" class="btn btn-warning mt-1">Update</a>
                                <button class="btn btn-danger mt-1" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-body-secondary">
            <a href="add_admin.php" class="btn btn-outline-primary">Tambah Admin</a>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus admin ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <form id="deleteForm" method="POST" action="delete_admin.php">
                    <input type="hidden" name="id" id="deleteId">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
document.getElementById('confirmDeleteModal').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 
    var adminId = button.getAttribute('data-id'); 
    document.getElementById('deleteId').value = adminId;
});
</script>
</body>
</html>
