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
    <link rel="stylesheet" href="../assets/css/product_css/product.css">
    <link rel="stylesheet" href="../assets/css/users/users.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
    <main class="container-fluid">
        <div class="row p-5">

             <!-- message  -->
            
            <?php if(isset($_GET['message'])){
                echo '<p class="p-2 px-3 bg-success-subtle text-success rounded">';
                echo $_GET['message'];
                echo '</p>';
            }
            ?>
                    
            <?php if (isset($_GET['register'])){ ?>
                <div class="d-flex justify-content-center align-items-center bg-success-subtle text-success mb-3 p-2 rounded">
                Welcome, <strong> <?php echo $_SESSION['user_name']; ?> </strong> <?php echo $_GET['register']; ?> .
                </div>
            <?php } ?>
            <?php if (isset($_GET['login'])){ ?>
                <div class="d-flex justify-content-center align-items-center bg-success-subtle text-success mb-3 p-2 rounded">
                Welcome, <strong> <?php echo $_SESSION['user_name']; ?> </strong> <?php echo $_GET['login']; ?> .
            </div>
            <?php } ?>

        
          
             <!-- user-navbar  -->
             <?php include '../includes/user_account_navbar.php' ?>
             <div class="col-9 py-5 d-flex flex-column gap-5 ">
                <div class="d-flex flex-column gap-2" >
                    <h3 class="text-center text-warning">My Account </h3>
                    <div class=" col-4 mx-auto custom-hr"></div>

                </div>
                
                <section class="col-10 mx-auto py-4 d-flex flex-column ">
                    <h5 class="text-secondary">Top Links</h5>
                    <hr class="col-2  text-warning">
                    <div class="d-flex gap-2">
                        <a href="orders.php" class=" order-list btn col-3 gap-3 border d-flex flex-column align-items-center justify-content-center p-4 text-center bg-secondary-subtle ">
                            <span class="fs-2 font-bold">12</span> 
                            <div class="">Your Orders</div>   
                        </a>
                        <a href="edit-account.php" class=" order-list btn col-3 border d-flex align-items-center justify-content-center p-4 text-center bg-secondary-subtle">
                            <div >Your Accounts</div>
                        </a>
                        <a href="change-password.php" class="order-list btn col-3 d-flex align-items-center justify-content-center border p-4 text-center bg-secondary-subtle">
                            <div>Change Password</div>
                        </a>
                        <a class="order-list btn col-3 d-flex align-items-center justify-content-center border p-4 text-center bg-secondary-subtle">
                            <div>Your Messages</div>
                        </a>
                    </div>
                    
                    
                </section>
                <section class="col-10 mx-auto" >
                    <h5 class="text-secondary">Your Orders</h5>
                    <hr class="col-2  text-warning">
                    <div>
                        <?php if($orders) { ?>
                        <table class="table table-borderless table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-warning">Order Id</th>
                                    <th class="bg-warning">Order Cost</th>
                                    <th class="bg-warning">Order Status</th>
                                    <th class="bg-warning">Order Date</th>
                                    <th class="bg-warning ">Action</th>
                                </tr>
                            
                            </thead>
                            <body>
                                <?php while ($row= $orders->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['order_id'] ?> </td>
                                    <td>$<?php echo $row['order_cost'] ?> </td>
                                    <td><?php echo $row['order_status'] ?> </td>
                                    <td><?php echo $row['order_date'] ?> </td>
                                    <td class="">
                                        <div class="d-flex gap-2 ">
                                            <form action="order-details.php" method="GET" >
                                                <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>" >
                                                <button title="view order details" class="border border-0 bg-transparent" name="order_details" type="submit"><i class="far fa-eye"></i></button>
                                            </form>
                                            <form action="" method="GET">
                                                <button title="cancel the order" class="border border-0 bg-transparent" name="cancel_order" type="submit"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    
                                    
                                    </td>


                                </tr>
                                <?php } ?>
                            </body>

                        </table>
                        <?php } ?>

                    </div>
                </section>
                <section class="col-10 mx-auto" >
                    <h5 class="text-secondary">Your Saved Items</h5>
                    <hr class="col-2  text-warning">
                   
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