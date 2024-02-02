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

if(isset($_SESSION['logged_in'])){

    if(isset($_POST['order_product_detail']) && isset($_POST['product_id']) && isset($_POST['order_id'])){
        $user_id = $_SESSION['user_id'];
        $order_id = $_POST['order_id'];
        $product_id = $_POST['product_id'];


        $stmt = $conn->prepare('SELECT * FROM order_items WHERE user_id=? AND order_id=? AND product_id=?');
        $stmt->bind_param('iii', $user_id,$order_id, $product_id);
        $stmt->execute();
    
        $order_product_detail = $stmt->get_result();
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
    <link rel="stylesheet" href="../assets/css/order-product-detail/order-product-detail.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
    <link rel="stylesheet" href="../assets/css/users/users.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
    <main class="container-fuild">
        <div class="row p-5">
              <!-- -navbar  -->
            <?php include '../includes/user_account_navbar.php' ?>
            <div class="col-9 py-5 d-flex flex-column gap-5 ">
                <div class="d-flex flex-column gap-2" >
                    <h3 class="text-center text-warning">Change Your Password</h3>
                    <div class=" col-4 mx-auto custom-hr"></div>

                </div>

                <section class="col-10 mx-auto  py-4 d-flex flex-column gap-3">
                    <?php while ($row= $order_product_detail->fetch_assoc()) { ?>
                    <div class="col-6 d-flex justify-content-center ">
                        <div class="order-product-detail d-flex justify-content-center">
                            <img class="order-product-images" src="../admin/product_images/<?php echo $row['product_image'] ?>" alt="<?php echo $row['product_name'] ?>">
                        </div>   
                    </div>
                    <div class="col-6" >
                        <h3><?php echo $row['product_name'] ?> </h3>
                        <p>Ratings: </p>
                        <p>$<?php echo $row['product_price'] ?> </p>
                        <p>Quantity: <?php echo $row['product_quantity'] ?> </p>
            
                    </div>
                    <?php } ?>
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