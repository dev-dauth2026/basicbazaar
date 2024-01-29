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
        <h3 class="text-center">Login</h3>
        <div class=" col-4 mx-auto custom-hr"></div>
        <hr class="text-warning">
        </div>
        

        <form class="mx-auto mb-4 d-flex flex-column flex-wrap justify-content-between gap-3 " method="post" action="login.php" >
        <p class="text-danger">  <?php if (isset($_GET['error'])) {echo  $_GET['error'] ;      }?></p>
            
            <div class="form-group  d-flex flex-column gap-2">
            <label for="email">Email</label>
            <input class ="form-control" type="email" name="email" placeholder="Enter your email..." required>
            </div>
            <div class="form-group d-flex flex-column gap-2">
            <label for="password">Password</label>
            <input class ="form-control" type="password" name="password" placeholder="Enter your Password..." required>
            </div>
           
            <div class=" d-flex flex-column justify-content-end">
                
                    <input type="submit" class ="btn btn-warning" name="login" value="Login">
                
            </div>
            <div class="form-group  d-flex flex-column ">
                <p>
                Don't you have an account? <a href="signup.php" class="">Sign Up</a>
                </p>
            
            </div>
            
        </form>
        
  

    </div>

</div>    


    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>