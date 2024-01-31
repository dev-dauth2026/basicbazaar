<?php 

session_start();

include '../includes/config.php'; 

if(isset($_GET['logged_out'])){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['logged_in']);

    header('location: login.php?logged_out=You have been successfully logged out.');
    exit();
}

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
}

if(isset($_POST['change_password'])){
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $user_email = $_SESSION['user_email'];

    if($newpassword !== $confirmpassword){
        header('location: change-password.php?error=Passwords did not match.');
    }elseif(strlen($newpassword)<6){
        header('location: change-password.php?error=Passwords must be minimum 6 characters.');
    }
    else{
        
        $password = md5($newpassword);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE user_email=?");
        $stmt->bind_param("ss", $password,$user_email);
        if($stmt->execute()){
            header("location: account.php?message=Password has been updated successfully.");
        }else{
            header("location: change-password.php?error=Could update the password."); 
        }

    }
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
        <div class="row col-6  mx-auto  p-5 gap-4  rounded shadow">
            
            <div class="  mx-auto d-flex flex-column">
                <h3 class="text-center">Change your Account Password</h3>
                <div class="col-10  mx-auto custom-hr"></div>
            </div>
          
            <div  class=" mx-auto">
                <form class="d-flex flex-column gap-3" action="change-password.php" method="POST" >
                    <?php if(isset($_GET['error'])){
                        echo '<p class="p-2 bg-danger-subtle text-danger px-3 rounded">';
                        echo $_GET['error'];
                        echo '</p>';
                        } ?>
                    <div class="form-group d-flex flex-column gap-2">
                        <label for="newpassword">New Password </label>
                        <input class="form-control" min="6" type="password" name="newpassword" placeholder="Enter your new password..." required>
                    </div>
                    <div class="form-group d-flex flex-column gap-2">
                        <label for="confirmpassword">Confirm Password </label>
                        <input class="form-control" min="6" type="password" name="confirmpassword" placeholder="Enter your new password..." required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-warning" type="submit" name="change_password" value="Change Password">
                    </div>
                </form>
            </div>
            
        </div>

    </main>    


    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>