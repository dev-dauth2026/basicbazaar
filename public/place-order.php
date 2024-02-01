<?php 

session_start();

include '../includes/config.php'; 

if(isset($_POST['place_order']) && isset($_SESSION['logged_in'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $total_cost = $_SESSION['totalPrice'];
    $order_status = "on hold";
    $user_id = $_SESSION['user_id'];
    $order_date = date("Y-m-d H:i:s");
   
    $stmt = $conn->prepare ("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_email,user_city,user_address,order_date) 
            VALUES (?,?,?,?,?,?,?,?)") ;

    $stmt->bind_param("isisssss", $total_cost, $order_status,$user_id,$phone,$email,$city,$address,$order_date);

    $stmt->execute() ;

    $order_id = $stmt->insert_id ;

    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        $product_image = $product['product_image'];

        $stmt2 = $conn->prepare ("INSERT INTO order_items (order_id,product_id,product_name,product_price,product_quantity,user_id,product_image)
                                    VALUES (?,?,?,?,?,?,?)") ;
        $stmt2->bind_param("iisiiis", $order_id,$product_id,$product_name,$product_price,$product_quantity,$user_id,$product_image);
        $stmt2->execute() ;
    }
}else{
    header("locatin: login.php");
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
        <div class=" col-8 mx-auto d-flex flex-column mb-5 text-center">
        <h3 class="text-center">Order has been placed successfully.</h3>
        <div class="col-12 d-flex justify-content-center">
            <button class="btn btn-warning">Pay Now</button>
        </div>
        </div>
        

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