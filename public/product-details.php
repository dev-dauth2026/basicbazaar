
 <!-- Include Navbar -->
 <?php 
 session_start();
 include '../includes/config.php'; 
 
 if(isset($_GET["product_details"])){
    $product_details_id = $_GET['product_details'];
    $product_detail_query  =$conn->prepare ("SELECT * from `products` WHERE product_id = ?");
    $product_detail_query->bind_param("i", $product_details_id);
    $product_detail_query->execute();
    $result_query = $product_detail_query->get_result();

}


if(isset($_GET["category_id"])){
    $category_id = $_GET["category_id"];
    $product_details_id = $_GET['product_details'];
    $category_query =$conn->prepare ("SELECT * from `products` WHERE category_id = ? AND product_id != ?");
    $category_query->bind_param("ii", $category_id,$product_details_id);
    $category_query->execute();
    $category_result_query = $category_query->get_result();
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

    
      <!-- Include product card -->
<div class="container py-5">
    <class class="row ">    
                        <!--  product detail carousel  -->
                    <?php if ($result_query->num_rows>0) { ?>
                    <?php  while ($row = $result_query->fetch_assoc()) { ?>
                        <div class='col-md-6 detail-image flex-column'>
                            <div id='carouselExampleIndicators' class='carousel slide'>
                                <div class='carousel-indicators'>
                                        <img data-bs-target='#carouselExampleIndicators' data-bs-slide-to='0'  aria-current='true' aria-label='Slide 1' class= 'active image2' src='../admin/product_images/<?php echo $row['product_img1']?>' alt='<?php echo $row['product_name']?>'>
                                        <img data-bs-target='#carouselExampleIndicators' data-bs-slide-to='1' aria-label='Slide 2' class= 'image3' src='../admin/product_images/<?php echo $row['product_img2']?>' alt='<?php echo $row['product_name']?>'>
                                        <img data-bs-target='#carouselExampleIndicators' data-bs-slide-to='2' aria-label='Slide 3' class= 'image4' src='../admin/product_images/<?php echo $row['product_img3']?>' alt='<?php echo $row['product_name']?>'>
                                </div>
                                <div class='carousel-inner'>
                                    <div class='carousel-item active'>
                                    <img class= 'image d-block w-100' src='../admin/product_images/<?php echo $row['product_img1']?>' alt='<?php echo $row['product_name']?>'>
                                    </div>
                                    <div class='carousel-item'>
                                    <img class= 'image d-block w-100' src='../admin/product_images/<?php echo $row['product_img2']?>' alt='<?php echo $row['product_name']?>'>
                                    </div>
                                    <div class='carousel-item'>
                                    <img class= 'image d-block w-100' src='../admin/product_images/<?php echo $row['product_img3']?>' alt='<?php echo $row['product_name']?>'>
                                    </div>
                                </div>
                               
                             </div>
                        
                        </div>

                        <!--  product detail carousel ends -->

                        <!--  product detail information  -->
                        <div class='col-md-6 '>
                            <div class='w-90'>
                                <?php 
                                $product_detail_brand_id = $row['brand_id'];
                                $product_brand_name_query =  $conn->prepare("SELECT * FROM `brand` WHERE brand_id = ?");
                                $product_brand_name_query->bind_param("i",$product_detail_brand_id);
                                $product_brand_name_query->execute();
                                $brand_name_query_result = $product_brand_name_query->get_result();
                                while ($brand_row = $brand_name_query_result->fetch_assoc()) { ?>
                                        <small><?php echo $brand_row['brand_name']?></small>
                                   <?php }?>
                                <h4> <?php echo $row['product_name']?></h4>
                                <?php 
                                $category_id = $row['category_id'];
                                $product_category_name_query =$conn->prepare ( "SELECT * FROM `category` WHERE category_id = ?");
                                $product_category_name_query->bind_param("i",$category_id);
                                $product_category_name_query->execute();
                                $category_name_query_result = $product_category_name_query->get_result();

                                while ($category_row = $category_name_query_result->fetch_assoc()) { ?>
                                    <small class='text-secondary-subtle text-secondary'>Category: <?php echo $category_row["category_name"] ?> </small>
                                <?php }  ?>

                               
                                
                                <!-- Star Rating -->
                                <div class='rating mb-3 mt-2'>
                                <span class='fas fa-star text-warning'></span> 
                                <span class='fas fa-star text-warning'></span> 
                                <span class='fas fa-star text-warning'></span> 
                                <span class='fas fa-star-half-alt text-warning'></span> 
                                <span class='far fa-star text-warning'></span> 
                                </div>
                                
                            
                                <h6>Price: <sup>$</sup> <span class='fs-3'><?php echo $row['product_price']?> </span> </h6>
                            
                                <p class='mb-3'>About the product: <?php echo $row['product_description']?> </p>


                                <form method='post' action='cart.php'>
                                    <input name='detail_product_id' type='hidden' value='<?php echo $row['product_id']?>'>
                                    <input name='detail_product_name' type='hidden' value='<?php echo $row['product_name']?>'>
                                    <input name='detail_product_price' type='hidden' value='<?php echo $row['product_price']?>'>
                                    <input name='detail_product_image' type='hidden' value='<?php echo $row['product_img1']?>'>
                               
                                     <!--  radio button list -->
                                    <div class='radio-button d-flex mb-3 gap-3'>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='color' id='Red' value='Red' checked>
                                            <label class='form-check-label' for='Red'>
                                                Red
                                            </label>
                                        </div>
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='color' id='Blue' value='Blue'>
                                            <label class='form-check-label' for='Blue'>
                                                Blue
                                            </label>
                                        </div>
                                        
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='color' id='White' value='White'>
                                            <label class='form-check-label' for='White'>
                                                White
                                            </label>
                                        </div>
                                        
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='color' id='Gray' value='Gray'>
                                            <label class='form-check-label' for='Gray'>
                                                Gray
                                            </label>
                                        </div>
                                    
                                    </div>
                            
                                     <!--  radio button list ends  -->
                            
                                    <!--  select list  -->
                                    
                                    <div class ='col-6 d-flex align-items-center'>
                                        <lable id='sizes' class='text-nowrap me-3'>Select Sizes:</lable>
                                        <select for='sizes' class='form-select' name='selected_size' aria-label='select_size'>
                                            <option selected>Select Size</option>
                                            <option value='XL' >XL</option>
                                            <option value='XL'>L</option>
                                            <option value='XL'>M</option>
                                            <option value='XL'>SM</option>
                                            <option value='XL'>XS</option>
                                        </select>
                                    </div>

                                    <!--  select list ends -->
                                    <br>

                                    <!--  select quantity  -->
                                    
                                    <div class ='col-6 d-flex align-items-center gap-2'>
                                        <lable class='text-nowrap me-3'>Select Quantity:</lable>
                                        <button class='btn border outline'> - </button>
                                        <input type='number' value='1' class='form-select' name='product_quantity' >
                                        <button class='btn border outline' > + </button>
                                        
                                    </div>

                                    <!--  select quantity ends -->
                                    
                                    <br>
                                    <input type='submit' name='add_to_cart' class='btn btn-primary' value = 'Add To Cart'>
                                </form>

                            </div>
                        </div>
                        <?php } ?>
                     <?php } ?>

                        <!--  product detail carousel ends -->


             <!-- related product carousel  -->
      <?php include '../includes/related_product_carousel.php'?>
       
        <!-- related product carousel  ends-->
        <?php include "../includes/customer_review.php" ?>

    </div>

</div>    

    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>

 <script>

    function Prev(){
        const parentCostumeSlider = document.getElementById("custome-carousel-item");

        parentCostumeSlider.insertBefore(parentCostumeSlider.children[parentCostumeSlider.children.length -1 ], parentCostumeSlider.children[0]);
    }
    function Next(){
        const parentCostumeSlider = document.getElementById("custome-carousel-item");
        parentCostumeSlider.appendChild(parentCostumeSlider.children[0])
   
    }
</script>

    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>


    <script src="js/script.js"></script>
</body>
</html>