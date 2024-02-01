<?php 

session_start();

include '../includes/config.php';

    if(empty($_SESSION['cart'])  || !isset($_SESSION['logged_in']) ){
        header('location: login.php?checkout=1');
    }
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ? ');
    $stmt->bind_param('i', $user_id) ;
    $stmt->execute() ;

    $user_result = $stmt->get_result();

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
    <link rel="stylesheet" href="../assets/css/checkout/checkout.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
      <!-- Include product card -->
<div class="container py-5">
    <div class="row my-5">
        
        <div class=" col-8 mx-auto d-flex flex-column mb-5">
        <?php if(isset($_GET['login'])) {?>
            <p class="p-2 px-3 bg-success-subtle text-success text-center rounded"><?php echo $_GET['login'] ?></p>
        
        <?php } ?>
        <h3 class="text-center">Checkout</h3>
        <div class=" col-4 mx-auto custom-hr"></div>
        </div>
        
<?php while ($user_row = $user_result->fetch_assoc()) { ?>
    <form class="col-7 mx-auto mb-4 d-flex flex-wrap justify-content-between gap-3" method="post" action="place-order.php">
        <div class="form-group col-5 d-flex flex-column gap-2">
         <label for="name">Name</label>
         <input class ="form-control" type="text" name="name" placeholder="Enter your name..." value ='<?php echo $user_row['user_name']?>' required>
        </div>
        <div class="form-group col-5 d-flex flex-column gap-2">
         <label for="phone">Phone</label>
         <input class ="form-control" type="tel" name="phone" placeholder="Enter your phone..." value ='<?php echo $user_row['user_phone']?>' required>
        </div>
        <div class="form-group col-12 d-flex flex-column gap-2">
         <label for="email">Email</label>
         <input class ="form-control" type="email" name="email" placeholder="Enter your email..." value ='<?php echo $user_row['user_email']?>' required>
        </div>
        <div class="form-group col-5 d-flex flex-column gap-2">
         <label for="address">Shipping Address</label>
         <input class ="form-control" type="text" name="address" placeholder="Enter your shipping address..." value ='<?php echo $user_row['user_address']?>' required>
        </div>
        <div class="form-group col-5 d-flex flex-column gap-2">
         <label for="city">City</label>
         <input class ="form-control" type="text" name="city" placeholder="Enter your city..." value ='<?php echo $user_row['user_city']?>' required>
        </div>
        <div class="form-group col-3 d-flex flex-column gap-2">
         <label for="state">State</label>
         <input class ="form-control" type="text" name="state" placeholder="Enter your state..." value ='<?php echo $user_row['user_state']?>' required>
        </div>
        <div class="form-group col-3 d-flex flex-column gap-2">
         <label for="postcode">Postcode</label>
         <input class ="form-control" type="text" name="postcode" placeholder="Enter your postcode..." value ='<?php echo $user_row['user_postcode']?>' required>
        </div>
        <div class="form-group col-3 d-flex flex-column gap-2">
         <label for="country">Country</label>
         <input class ="form-control" type="text" name="country" placeholder="Enter your country..." value ='<?php echo $user_row['user_country']?>' required>
        </div>
        <div class="col-12 d-flex flex-column justify-content-end">
                <p class="text-end">Total Amount: $<?php echo $_SESSION['totalPrice'] ?></p>
                 <input type="submit" class ="btn btn-warning" name="place_order" value="Place Order">
             
        </div>
        
    </form>
        
 <?php } ?> 

    </div>

</div>    
  <!-- related product carousel  ends-->
  <?php include "../includes/customer_review.php" ?>

    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>