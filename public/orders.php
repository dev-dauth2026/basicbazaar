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
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare('SELECT * FROM orders WHERE user_id=? ORDER BY order_date DESC');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result();
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
    <link rel="stylesheet" href="../assets/css/users/users.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
    <main class="container-fluid">
        
        <div class="row p-5 ">
            <!-- -navbar  -->
            <?php include '../includes/user_account_navbar.php' ?>

            <div class="col-9 py-5 d-flex flex-column gap-5 ">
                <div class="  mx-auto d-flex flex-column">
                    <h3 class="text-center">My Orders </h3>
                    <div class=" col-4 mx-auto custom-hr"></div>
                </div>
                
                    <div class="col-10 mx-auto  py-4 d-flex flex-column gap-3">
                        <?php if($orders) { ?>
                            
                                <?php while ($row= $orders->fetch_assoc()) { ?>
                                    <div class="order-list d-flex flex-column gap-3 border p-3 rounded">
                                        <div class="d-flex align-items-center bg-body-tertiary p-2">
                                            <div class="">
                                               Order Id : <?php echo $row['order_id'] ?>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between  p-1  gap-3 ">
                                        
                                            <div class="d-flex flex-column gap-2">
                                                <small class="text-secondary fs-6">Date Placed</small>
                                                <p><?php echo $row['order_date'] ?> </p> 
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <small class="text-secondary fs-6">Total Cost</small>
                                                <p class="fs-4">$<?php echo $row['order_cost'] ?> </p> 
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <small class="text-secondary fs-6">Order Status</small>
                                                <span class="p-1 text-center bg-warning rounded"><?php echo $row['order_status'] ?> </span>
                                            </div>

                                        
                                            <div class="d-flex flex-column gap-2">
                                            <small class="text-secondary fs-6">Actions</small>
                                                <div class="d-flex gap-2 ">
                                                    <form action="order-details.php" method="GET" >
                                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>" >
                                                        <button title="view order details" class="border border-0 bg-transparent" name="order_details" type="submit"><i class="far fa-eye"></i></button>
                                                    </form>
                                                    <form action="" method="GET">
                                                        <button title="cancel the order" class="border border-0 bg-transparent" name="cancel_order" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            
                                            
                                            </div>


                                        </div>

                                    </div>
                                    
                                <?php } ?>
                          
                        <?php } ?>

                    </div>

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