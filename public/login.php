<?php 

session_start();

include '../includes/config.php'; 

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
}

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare('SELECT user_id,user_name,user_email,password FROM users where user_email=? AND password=? LIMIT 1');
    $stmt->bind_param('ss', $email, $password);
    if($stmt->execute()){
        $stmt->bind_result($user_id,$user_name,$user_email,$password);
        $stmt->store_result();
        
        if($stmt->num_rows ==1){
           $stmt->fetch();

           $_SESSION['user_id'] = $user_id;
           $_SESSION['user_name'] = $user_name;
           $_SESSION['user_email'] = $user_email;
           $_SESSION['logged_in'] = true;

           if(isset($_POST['checkout'])){
            header("location: checkout.php?login=successfully logged in");

           }else{
            header("location: account.php?login=You have been logged in successfully.&checkout=". $_POST['checkout'] );

           }

        }else{
            header('location: login.php?error=Credential did not match.');
        }
    }else{
        header('location: login.php?error=Something went wrong.');
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

    
      <!-- Include product card -->
<div class="container py-5">
    <div class="row col-6 mx-auto my-5 p-5 shadow rounded">
       
        <?php if (isset($_GET['logged_out'])) {
            echo '<p class="bg-success-subtle d-flex align-item-center text-center rounded mb-4 py-2 px-3">';
            echo  $_GET['logged_out'] ; }
            echo'</p>';
            ?>
       
        <div class="  mx-auto d-flex flex-column mb-2">
        <h3 class="text-center">Login</h3>
        <div class=" col-4 mx-auto custom-hr"></div>
        <hr class="text-warning">
        </div>
        

        <form class="mx-auto mb-4 d-flex flex-column flex-wrap justify-content-between gap-3 " method="post" action="login.php" >
          <?php if (isset($_GET['error'])) {
            echo '<p class="text-danger">';
            echo  $_GET['error'] ; }
            echo'</p>';
            ?>
            
            
            <div class="form-group  d-flex flex-column gap-2">
            <label for="email">Email</label>
            <input class ="form-control" type="email" name="email" placeholder="Enter your email..." required>
            </div>
            <div class="form-group d-flex flex-column gap-2">
            <label for="password">Password</label>
            <input class ="form-control" type="password" name="password" placeholder="Enter your Password..." required>
            </div>
           
            <div class=" d-flex flex-column justify-content-end">
                <?php if (isset($_GET['checkout'])) {?>
                    <p>checkout</p>
                <input type="hidden" name="checkout" value="1" >
                <?php } ?>
                
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