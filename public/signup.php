<?php 

session_start();

include '../includes/config.php'; 

if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $created_at = date('Y-m-d H:i:s');


    // if password did not match
    if($confirmpassword !== $password){
        header("location: signup.php?error=*Passwords did not match!");
    }
    // if password character is less than 6
    elseif(strlen($password) < 6){
        header("location: signup.php?error=The length of the password should be minimum 6 characters.");
    }else{

        // check whether the user already exists or not
        $stmt  =$conn->prepare("SELECT count(*) from users WHERE user_email=?") ;
        $stmt->bind_param('s',$email);
        $stmt->execute() ;
        $stmt->bind_result($num_rows);
        $stmt->store_result();
        $stmt->fetch();

        if($num_rows !=0){
            header('location: signup.php?error=User with this email id already exists.');
        }else{
        // create new user
            $password = md5($password);
            $stmt2 = $conn->prepare("INSERT INTO users (user_name,user_phone,user_email,password,created_at)
                            VALUES (?,?,?,?,?)");
            $stmt2->bind_param("sssss", $name,$phone,$email,$password,$created_at);

            if($stmt2->execute()){
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                
                header('location: account.php?register=You have been signuped successfully.');
            }else{
                header('location: signup.php?error=Sorry, could not create an account.');
            }
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

    
      <!-- Include product card -->
<div class="container py-5">
    <div class="row col-6 mx-auto my-5 p-5 shadow rounded">
        <div class="  mx-auto d-flex flex-column mb-4">
        <h3 class="text-center">Sign Up</h3>
        <div class=" col-4 mx-auto custom-hr"></div>
        <hr class="text-warning">
        </div>
        

        <form class="mx-auto mb-4 d-flex flex-column flex-wrap justify-content-between gap-3 " method="post" action="signup.php" >
        <p class="text-danger">  <?php if (isset($_GET['error'])) {echo  $_GET['error'] ;      }?></p>
            <div class="form-group  d-flex flex-column gap-2">
            <label for="name">Name</label>
            <input class ="form-control" type="text" name="name" placeholder="Enter your name..." required>
            </div>
            <div class="form-group d-flex flex-column gap-2">
            <label for="phone">Phone</label>
            <input class ="form-control" type="tel" name="phone" placeholder="Enter your phone..." required>
            </div>
            <div class="form-group  d-flex flex-column gap-2">
            <label for="email">Email</label>
            <input class ="form-control" type="email" name="email" placeholder="Enter your email..." required>
            </div>
            <div class="form-group d-flex flex-column gap-2">
            <label for="password">Password</label>
            <input class ="form-control" type="password" name="password" placeholder="Enter your Password..." required>
            </div>
            <div class="form-group  d-flex flex-column gap-2">
            <label for="confirmpassword">Confirm Password</label>
            <input class ="form-control" type="password" name="confirmpassword" placeholder="Enter your city..." required>
            </div>
            <div class=" d-flex flex-column justify-content-end">
                
                    <input type="submit" class ="btn btn-warning" name="signup" value="Sign Up">
                
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