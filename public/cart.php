<?php include '../includes/config.php'; ?>
<?php
session_start();

if (isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
        $product_id_array = array_column($_SESSION['cart'], 'detail_product_id');

        if(!in_array($_POST['detail_product_id'],$product_id_array)){
            $product_id = $_POST['detail_product_id'];
            $product_name = $_POST['detail_product_name'];
            $product_price = $_POST['detail_product_price'];
            $product_quantity = $_POST['product_quantity'];
            $product_image = $_POST['detail_product_image'];

            $product_array = array (
                'product_id'=>$product_id,
                'product_name'=>$product_name,
                'product_price'=>$product_price,
                'product_quantity'=>$product_quantity,
                'product_image'=>$product_image,
            );

            $_SESSION['cart'][$product_id] = $product_array;

        }else{
           echo  "<script> alert('product has been already added')</script>";
           header('location: product-details.php');
        }

    }else{
        $product_id = $_POST['detail_product_id'];
        $product_name = $_POST['detail_product_name'];
        $product_price = $_POST['detail_product_price'];
        $product_quantity = $_POST['product_quantity'];
        $product_image = $_POST['detail_product_image'];

        $product_array = array (
            'product_id'=>$product_id,
            'product_name'=>$product_name,
            'product_price'=>$product_price,
            'product_quantity'=>$product_quantity,
            'product_image'=>$product_image,
        );

        $_SESSION['cart'][$product_id] = $product_array;

       
    }

     //call totalPrice
     CalculateTotalPrice();

}elseif(isset($_POST['remove_product'])){
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //call totalPrice
    CalculateTotalPrice();

}elseif(isset($_POST['edit_quantity'])){
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // product array of selected $product_id
    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product_array;

    if($product_quantity == 0){
        unset($_SESSION['cart'][$product_id]);
    }

    //call totalPrice
    CalculateTotalPrice();


}

// calculate total

function CalculateTotalPrice(){

    $totalPrice = 0;

    foreach($_SESSION['cart'] as $key => $value){
        $product_key = $_SESSION['cart'][$key];
        $product_price = $product_key['product_price'];
        $product_quantity = $product_key['product_quantity'];

        $totalPrice += $product_price * $product_quantity;
    }

    $_SESSION['totalPrice'] = $totalPrice;
}

?>

 <!-- Include Navbar -->

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
    <link rel="stylesheet" href="../assets/css/cart/cart.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

    
      <!-- Include product card -->
<div class="container py-5">
    <div class="row ">
    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){ ?>
        <table class='table table-striped table-hover '>
            <thead >
                <tr >
                    <th colspan="2" class="bg-warning text-light text-center">Product</th>

                    <th class="bg-warning text-light"> Product Quantity</th>
                    <th class="bg-warning text-light">Product Price</th>
                </tr>
            </thead>
            
            <tbody class="table-group-divider">
                
               <?php foreach($_SESSION['cart'] as $key => $value){?>
                    <tr >
                        <td>
                            <div class="d-flex ">
                                <div class="image-article d-flex justify-content-center">
                                    <img class="cart-image " src="../admin/product_images/<?php echo $value['product_image'] ?>" alt="<?php echo $value['product_name'] ?>" >
                                </div>
                                
                                
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column ms-3 ">
                                    <p class="mb-0"><?php echo $value['product_name'] ?> </p>
                                    <p class="mb-0">$<?php echo $value['product_price'] ?> </p>
                                    <form method="post" action="cart.php">
                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                        <input class="text-danger mt-0 fs-6 border border-0 bg-transparent" name="remove_product" type="submit" value="Remove" />
                                    </form>
                                    
                                </div>
                        </td>
                        <td >
                            <form method="post" action="cart.php" >

                                <input class="" type="hidden" name="product_id" value ="<?php echo $value['product_id'] ?>" />
                                <input class="col-1 text-center" type="number" min="0" name="product_quantity" value ="<?php echo $value['product_quantity'] ?>" />
                                <input class="bg-transparent border border-0 text-info" type="submit" name="edit_quantity" value ="Edit" />
                            </form>

                            
                        </td>
                        <td>$ <?php echo $value['product_quantity'] * $value['product_price']  ?></td>
                    </tr>
                
                <?php 
            
            
            }?>
                
                
                <tr>
                    <th colspan="3" class='text-end'>Total</th>
                    <th>$ <?php echo $_SESSION['totalPrice']  ?></th>
                </tr>
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-end">
            <form method="post" action="checkout.php">
                 <input type="submit" name="checkout" class ="btn btn-warning" value="Checkout">
            </form>
             
        </div>
        <?php }else{
                echo "
                <div class='d-flex flex-column justify-content-center align-items-center p-5 shadow mb-5 vh-100'>
                <h2>There is no product in the cart.</h2>
                <a href='index.php' class='text-warning '>Home Page</a>
                </div>
                
                ";
                
            }?>
        
       
       

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