<?php 

session_start();

include '../includes/config.php'; 

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
}

if(isset($_GET['logged_out'])){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['logged_in']);

    header('location: login.php?logged_out=You have been successfully logged out.');
    exit();
}

if(isset($_SESSION['logged_in'])){
    $user_id= $_SESSION['user_id'];

    if(isset($_POST['update_user_profile'])){
        $user_name= $_POST['username'];
        $user_phone = $_POST['phone'];
        $user_email= $_POST['email'];
        $user_address = $_POST['address'];
        $user_city = $_POST['city'];
        $user_state = $_POST['state'];
        $user_postcode = $_POST ['postcode'];
        $user_country = $_POST['country'];

        $stmt = $conn->prepare("UPDATE users SET user_name = ?, user_phone =?, user_email=?, user_address= ?, user_city =?, user_state = ?, user_postcode=?, user_country =? 
                    WHERE user_id = ?");
        $stmt->bind_param("ssssssisi",$user_name,$user_phone,$user_email,$user_address,$user_city,$user_state,$user_postcode,$user_country, $user_id);
        $stmt->execute();
        header('location: edit-account.php?account_update = Account has been updated successfully.');
    
    }

    
    $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1' );
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();

   

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
    <link rel="stylesheet" href="../assets/css/users/users.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
    <main class="container-fluid ">
        <div class="row  p-5 ">

            
        <?php  if(isset($_GET['account_update'])){?>
                <p class="p-2 px-3 bg-success-subtle text-success"><?php echo $_GET['account_update']; ?> </p>
           <?php } ?>
            
            
            <!-- -navbar  -->
            <?php include '../includes/user_account_navbar.php' ?>

            <div class="col-9 py-5 d-flex flex-column gap-5 ">
                <div class="d-flex flex-column gap-2" >
                    <h3 class="text-center text-warning">My Profile </h3>
                    <div class=" col-4 mx-auto custom-hr"></div>

                </div>
                
                <section class="col-10 mx-auto  py-4 d-flex flex-column gap-3">
                    <div class="d-flex flex-column">
                        <h5 class="text-secondary">Your Photo</h5>
                        <hr class="col-2  text-warning">
                    </div>
                    <div class="d-flex flex-row">
                        <i class="user-profile fas fa-user-circle col-3"></i>
                        <div class="d-flex flex-column gap-2 col-9">
                            <p>Upload your profile image of appropriate file extension and size</p>
                            <div class="d-flex align-items-center gap-3">
                                <button class="btn btn-warning">Upload Image</button>
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            
                        </div>

                    </div>
                   
                </section>
                <section class="col-10 mx-auto  py-4 d-flex flex-column gap-3">
                    <div class="d-flex flex-column">
                        <h5 class="text-secondary">Personal Information</h5>
                        <hr class="col-2  text-warning">
                        <form class="d-flex flex-column gap-3" method="POST" action="edit-account.php">
                                <?php while ($row = $user_result->fetch_assoc()){?>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="form-group col-5 d-flex flex-column gap-2">
                                                <label class="text-secondary" for="username">Username:</label>
                                                <input class="form-control " name="username" type="text" value="<?php echo $row['user_name']?>" required >
                                            </div>
                                            <div class="form-group col-5 d-flex flex-column gap-2">
                                                <label class="text-secondary"  for="phone">Phone:</label>
                                                <input class="form-control " name="phone" type="tel" pattern="[0-9]{10}" value="<?php echo $row['user_phone']?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group d-flex flex-column gap-2">
                                            <label class="text-secondary" for="email">Email:</label>
                                            <input class="form-control " name="email" type="email"  value="<?php echo $row['user_email']?>" required>
                                        </div>
                                        <div class="form-group d-flex flex-column gap-2">
                                            <label class="text-secondary" for="address">Address:</label>
                                            <input class="form-control " name="address" type="text"  value="<?php echo $row['user_address']?>" >
                                        </div>
                                        <div class="d-flex gap-3">
                                            <div class="form-group col-3 d-flex flex-column gap-2">
                                                <label class="text-secondary" for="city">City:</label>
                                                <input class="form-control " name="city" type="text"  value="<?php echo $row['user_city']?>" >
                                            </div>
                                            <div class="form-group col-3 d-flex flex-column gap-2">
                                                <label class="text-secondary" for="state">State:</label>
                                                <input class="form-control " name="state" type="text"  value="<?php echo $row['user_state']?>" required>
                                            </div>
                                            <div class="form-group d-flex flex-column gap-2">
                                                <label class="text-secondary" for="postcode">Post Code:</label>
                                                <input class="form-control " name="postcode" type="text"  value="<?php echo $row['user_postcode']?>" required>
                                            </div>
                                            <div class="form-group d-flex flex-column gap-2">
                                                <label class="text-secondary" for="country">Country:</label>
                                                <input class="form-control " name="country" type="text"  value="<?php echo $row['user_country']?>" required>
                                            </div>
                                        </div>
                                    <?php } ?>
                                        <div class="d-flex justify-content-end">
                                            <input class="btn border-warning text-warning" type="submit" name="update_user_profile" value="Save">
                                        </div>
                                        

                            </form>
                    </div>
                </section>

                <section class="col-10 mx-auto  py-4 d-flex flex-column gap-3">
                    
                </section>


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