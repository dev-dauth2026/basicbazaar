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
    $stmt = $conn->prepare('SELECT * FROM orders WHERE user_id=?');
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
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
    <main class="container py-5">
        <div class="row  mx-auto  p-5 gap-4  rounded">
            
            <div class="  mx-auto d-flex flex-column">
                <?php if(isset($_GET['message'])){
                    echo '<p class="p-2 px-3 bg-success-subtle text-success rounded">';
                    echo $_GET['message'];
                    echo '</p>';
                }
                ?>
                <div class="d-flex justify-content-end cursor-pointer">
                    <a class="text-info" href="account.php?logged_out=true">logout</a>
                </div>
                <h3 class="text-center">My Account </h3>
                <div class=" col-4 mx-auto custom-hr"></div>
                <hr class="text-warning">
                <div class="">
                <?php if (isset($_GET['register'])){ 
                    echo '<p>Welcome,';
                    echo '<strong>';
                    echo $_SESSION['user_name'];
                    echo '</strong>! ';

                    echo $_GET['register'];
                }
                ?>
                 <?php if (isset($_GET['register']) || isset($_GET['login'])){ 
                    echo '<p>Welcome,';
                    echo '<strong>';
                    echo $_SESSION['user_name'];
                    echo '</strong>! ';

                    echo $_GET['login'];
                }
                ?>
             </div>
            </div>
            
            <div class="p-3 col-12 d-flex  gap-2">
                <a href="#orders" class="btn col-3 gap-3 border d-flex align-items-center justify-content-center p-5 text-center bg-secondary-subtle ">
                <span class="fs-2 font-bold">12</span> 
                <div class="">Your Orders</div>   
                </a>
                <a href="edit-account.php" class="btn col-3 border d-flex align-items-center justify-content-center p-5 text-center bg-secondary-subtle">
                    <div >Your Accounts</div>
                </a>
                <a href="change-password.php" class="btn col-3 d-flex align-items-center justify-content-center border p-5 text-center bg-secondary-subtle">
                    <div>Change Password</div>
                </a>
                <a class="btn col-3 d-flex align-items-center justify-content-center border p-5 text-center bg-secondary-subtle">
                    <div>Your Messages</div>
                </a>
                
            </div>

            <section class="mt-5" data-bs-spy="scroll" data-bs-smooth-scroll="true" id="orders">
                <h3 class="text-center">Your Orders</h3>
                <hr class="col-2 mx-auto">
                <div>
                    <?php if($row= $orders->fetch_assoc()) { ?>
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="bg-warning">Order Id</th>
                                <th class="bg-warning">Order Cost</th>
                                <th class="bg-warning">Order Status</th>
                                <th class="bg-warning">Order Date</th>
                                <th class="bg-warning">Action</th>
                            </tr>
                           
                        </thead>
                        <body>
                            <?php while ($row= $orders->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['order_id'] ?> </td>
                                <td>$<?php echo $row['order_cost'] ?> </td>
                                <td><?php echo $row['order_status'] ?> </td>
                                <td><?php echo $row['order_date'] ?> </td>
                                <td>
                                    <form action="" method="GET">
                                    <button class="border border-0 bg-transparent" type="submit"><i class="far fa-eye"></i></button>
                                    </form>
                                </td>


                            </tr>
                            <?php } ?>
                        </body>

                    </table>
                    <?php } ?>

                </div>
            </section>

            

        </div>

    </main>    


    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>