<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'conn.php';
$user_id = $_SESSION['id'];  

$query = "SELECT t.*, u.username 
          FROM transaksi t 
          JOIN user u ON t.user_id = u.id 
          WHERE t.user_id = '$user_id'";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "Error in query execution: " . mysqli_error($connection); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #64605f;">
<?php require 'navbar.php'; ?>
<div class="card text-center">  
<div class="card-header">
    <h3>Orderan Anda</h3>
</div>    
<div class="card-body">
<table class="table table-dark table-hover">
<thead>
    <tr>
        <th>NickName</th>
        <th>Order</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Tools</th>
        <th>Status</th>
    </tr>
</thead>
<tbody>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
    ?>    
        <tr>
            <td><?php echo $row['nickname']; ?></td>
            <td><?php echo $row['order']; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td><?php echo $row['jam']; ?></td>
            <td>
                <?php if ($row['user_id'] == $_SESSION['id']) { ?>
                    <a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success mt-1" role="button">Edit</a>
                    <button class="btn btn-danger mt-1" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                <?php } else { ?>
                    <span>Unauthorized</span>
                <?php } ?>
            </td>
            <td><?php echo $row['status']; ?></td>
        </tr>
    <?php
        }
    ?>
</tbody>
</table>   
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
                Apakah Anda yakin ingin menghapus orderan anda?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <a id="deleteConfirmBtn" href="#" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function confirmDelete(id) {
    var deleteLink = "delete.php?id=" + id;
    document.getElementById("deleteConfirmBtn").href = deleteLink;
    var confirmModal = new bootstrap.Modal(document.getElementById("confirmDeleteModal"));
    confirmModal.show();
}
</script>
</body>
</html>
