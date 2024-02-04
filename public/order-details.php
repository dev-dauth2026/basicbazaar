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

    if(isset($_GET['order_details']) && isset($_GET['order_id'])){
        $user_id = $_SESSION['user_id'];
        $order_id = $_GET['order_id'];


        $stmt = $conn->prepare('SELECT * FROM order_items WHERE user_id=? AND order_id=? ');
        $stmt->bind_param('ii', $user_id,$order_id);
        $stmt->execute();
    
        $order_details = $stmt->get_result();

        $stmt2 =$conn ->prepare('SELECT * FROM orders WHERE user_id= ? AND order_id=?');
        $stmt2->bind_param('ii', $user_id, $order_id);
        $stmt2->execute();

        $orders = $stmt2->get_result();
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
    <link rel="stylesheet" href="../assets/css/order_details/order_details.css">
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
                        <h3 class="text-center text-warning">Order Details</h3>
                        <div class=" col-4 mx-auto custom-hr"></div>

                    </div>

                    <section class="col-10 mx-auto  py-4 d-flex flex-column gap-3">
                        <?php if($order_details) { ?>
                        <div class="d-flex flex-column gap-3 border p-2 rounded  ">
                                 
                                    <div class="d-flex justify-content-between bg-secondary-subtle p-2 px-3">
                                        <div>Order Id: <?php echo $_GET['order_id'] ?> </div>
                                        <?php while ($ord = $orders->fetch_assoc()) { ?>
                                        <div><strong>Total: $<?php echo $ord['order_cost'] ?></strong></div>
                                        <?php } ?>
                                    </div>
                               
                                <div class="d-flex  flex-column justify-content-between gap-3 ">
                                    
                                    <table class="table table-hover table-borderless table-responsive">
                                        <thead>
                                            <tr class="border-bottom">
                                                <td colspan="2" class="text-secondary text-center">Product</td>
                                                <td class="text-secondary text-center">Quantity</td>
                                                <td class="text-secondary text-center">Actions</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row= $order_details->fetch_assoc()) { ?>
                                            <tr class="col-12">
                                                <td>
                                                    <div class="image-article d-flex justify-content-center">
                                                        <img class="order-images" src="../admin/product_images/<?php echo $row['product_image'] ?>" alt="<?php echo $row['product_name'] ?>">
                                                    </div> 
                                                </td>
                                                <td class="py-4 ">
                                                    
                                                    <div class="d-flex flex-column gap-2">
                                                        <div><?php echo $row['product_name'] ?> </div>
                                                        <div>$<?php echo $row['product_price'] ?> </div>
                                                    </div>
                                                    
                                                    
                                                
                                                </td>
                                           
                                                <td class="py-4 col-3  text-center"><?php echo $row['product_quantity'] ?> </td>
                                          

                                                <td class="py-4 col-3 ">
                                                    <div class="d-flex gap-2 justify-content-center">

                                                    <!-- <form action="product-details.php" method="GET">
                                                        <input type="hidden" name="product_details" value="<?php echo $row['product_id'] ?>">
                                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                                        <button title="view order details" class="border border-0 bg-transparent" name="product_details" type="submit"><i class="far fa-eye"></i></button>
                                                    </form> -->
                                                        <a href="product-details.php?product_details=<?php echo $row['product_id'] ?>" title="view order details" class="text-secondary border border-0 bg-transparent" name="product_details" ><i class="far fa-eye"></i></a>
                                                        <form action="" method="GET">
                                                                <button title="cancel the order" class="border border-0 bg-transparent" name="cancel_order" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                   


                                </div>
                               
                            

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