<?php 

session_start();

include '../includes/config.php'; 

if(isset($_GET['logged_out'])){
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['logged_in']);

    header('location: login.php?logged_out=You have been successfully logged out.');
    exit();
}

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
}





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

    
    <main class="container py-5">
        <div class="row  mx-auto  p-5 gap-4  rounded">
            
            <div class="  mx-auto d-flex flex-column">
                <div class="d-flex justify-content-end cursor-pointer">
                    <a class="text-info" href="account.php?logged_out=true">logout</a>
                </div>
                <h3 class="text-center">My Account Details</h3>
                <div class=" col-4 mx-auto custom-hr"></div>
                <hr class="text-warning">
              
            </div>
            
         

            <section>
                <div  class=" col-8 mx-auto shadow b p-5">
                    <table class="table table-borderless ">
                        <tr>
                            <th>Username:</th>
                            <td>Dav</td>
                            <td>
                                <a href="edit-account.php?edit_username=1">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>dav@gmail.com</td>
                            <td>
                                <a href="edit-account.php?edit_username=1">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>Clayfield Brisbane QLD 4011</td>
                            <td>
                                <a href="edit-account.php?edit_username=1">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Password:</th>
                            <td>xxxxxxxxxxxxx</td>
                            <td>
                                <a href="change-password.php?">Edit</a>
                            </td>
                        </tr>

                    </table>
                </div>
                
            </section>

            

        </div>

    </main>    


    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>