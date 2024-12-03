<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .carousel-item {
        height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .carousel-item img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .carousel-caption {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .card-img {
        object-fit: cover;
        height: 400px; 
    }
    .card-img-overlay {
        background-color: rgba(0, 0, 0, 0.4); 
    }
</style>
<body style="background-color: #64605f;">
    <?php require 'navbar.php'; ?>
    <div class="card text-center" style="background-color: #64605f;">
        <div class="card-header">
        </div>
        <div class="card text-bg-dark">
            <img src="img2/img1.png" class="card-img w-100" alt="Image">
            <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                <h5 class="card-title text-center text-white">Command and Conquer: Red Alert 2</h5>
                <a class="btn btn-primary fw-bold" href="add.php">Order</a>
                <p class="card-text text-center text-white"><small>game yang terkenal pada masanya</small></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
