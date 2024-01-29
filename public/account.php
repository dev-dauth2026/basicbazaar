<?php 

session_start();

include '../includes/config.php'; 





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Bazaar</title>

    <?php include '../admin/includes/bootstrap_cdn.php'; ?>
    <?php include '../admin/includes/fontawesome_cdn.php'; ?>

    <!-- Your Custom CSS (if any) -->
    <link rel="stylesheet" href="../assets/css/product_css/product.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
      <!-- Include product card -->
<div class="container py-5">
    <div class="row col-6 mx-auto my-5 p-5 shadow rounded">
        <div class="  mx-auto d-flex flex-column mb-4">
        <h3 class="text-center">My Account </h3>
        <div class=" col-4 mx-auto custom-hr"></div>
        <hr class="text-warning">
        </div>
        <div class="">
            <p>Welcome, <strong><?php echo $_SESSION['user_name'] ?></strong>. You have been signuped successfully </p>
        </div>
        

    </div>

</div>    


    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>