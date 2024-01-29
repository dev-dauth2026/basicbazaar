<?php
 include('../includes/config.php');
 include('../includes/status_alert.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Bazaar Admin Dashboard</title>

    <?php include('includes/bootstrap_cdn.php') ?>
    <?php include('includes/fontawesome_cdn.php') ?>
 
</head>

<body>
<div class="container-fluid">
        <div class="row">
        <?php include 'includes/siderbar.php' ?>

            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 vh-100 overflow-scroll">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">Admin Dashboard</h2>
                </div>

                <!-- Product Management Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text">150</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <a href="add-category.php" class="text-decoration-none text-dark">
                                <h5 class="card-title">Categories</h5>
                                <p class="card-text">10</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Brands</h5>
                                <p class="card-text">8</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Product Table -->
                <div class="mt-4 d-flex flex-column  w-100">
                <?php ActionMessage() ?>
    
                    <div class="w-100">
                        <a href="./add-product.php" class="p-2 bg-primary text-light border rounded float-end text-decoration-none">Add Product</a>

                    </div> <br>
                    <h3>Product List</h3>
                    <div class="table-responsive  overflow-auto w-100">
                        <table class="table table-striped table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th >Product Image</th>
                                    <th >Product Name</th>
                                    <th >Description</th>
                                    <th >Price</th>
                                    <th >Category Id</th>
                                    <th >Brand Id</th>
                                    <th >Created At</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 $all_products = "select * from `products`";
                                 $result_query = mysqli_query($conn, $all_products);

                                 $num_of_row = mysqli_num_rows($result_query);
                                 if ($num_of_row > 0) {
                                    while ($row = mysqli_fetch_array($result_query)) {
                                        $product_id = $row["product_id"];
                                        $product_name = $row["product_name"];
                                        $product_description = $row["product_description"];
                                        $product_price = $row["product_price"];
                                        $category_id = $row["category_id"];
                                        $brand_id = $row["brand_id"];
                                        $product_img1 = $row["product_img1"];
                                        $created_at = $row["created_at"];

                                       
                                        if(isset($_GET["edit_product"])){
                                            echo "
                                            <tr>
                                            <td>$product_id</td>
                                            <td>
                                            <img src = 'product_images/$product_img1' alt = '$product_name' style='height:70px; object-fit:'contain''>
                                            </td>
                                            <td>$product_name</td>
                                            <td>$product_description</td>
                                            <td>$ $product_price</td>
                                            <td>$category_id</td>
                                            <td>$brand_id</td>
                                            <td>$created_at</td>
                                            
                                            <td>
                                                <a href='update-product.php?edit_product=$product_id' class='btn btn-warning btn-sm' name='edit_product'>Edit</a>
                                                <a href='all-products.php?delete_product=$product_id' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>
                                        </tr>
                                            ";
                                        }else{

                                        }
                                        echo "
                                        <tr>
                                        <td>$product_id</td>
                                        <td>
                                        <img src = 'product_images/$product_img1' alt = '$product_name' style='height:70px; object-fit:'contain''>
                                        </td>
                                        <td>$product_name</td>
                                        <td>$product_description</td>
                                        <td>$ $product_price</td>
                                        <td>$category_id</td>
                                        <td>$brand_id</td>
                                        <td>$created_at</td>
                                        
                                        <td>
                                            <a href='update-product.php?edit_product=$product_id' class='btn btn-warning btn-sm' name='edit_product'>Edit</a>
                                            <a href='all-products.php?delete_product=$product_id' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                    </tr>
                                        ";
                                    
                                    }
                                } else {
                                    echo "<tr>
                                    <td colspan='9'>
                                    <h2 class = 'text-center'>No Products available</h2>
                                    </td>
                                    </tr>
                                   
                                    
                                    ";
                                }

                                ?>
                                

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

<?php include('includes/js_cdn.php') ?>
</body>

</html>
