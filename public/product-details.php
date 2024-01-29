

 <!-- Include Navbar -->
 <?php include '../includes/config.php'; ?>
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
            <?php 

            if(isset($_GET["product_details"])){
                    $product_details_id = $_GET['product_details'];
                    $product_detail_query  = "SELECT * from `products` WHERE product_id = $product_details_id";

                    $result_query = mysqli_query($conn,$product_detail_query);
                    while ($row = mysqli_fetch_array($result_query)) {
                        $product_detail_id = $row["product_id"];
                        $product_detail_name = $row["product_name"];
                        $product_detail_category_id = $row["category_id"];
                        $product_detail_brand_id = $row["brand_id"];
                        $product_detail_price = $row["product_price"];
                        $product_detail_description = $row["product_description"];
                        $product_detail_image1 = $row["product_img1"];
                        $product_detail_image2 = $row["product_img2"];
                        $product_detail_image3 = $row["product_img3"];
                        $image_array = [$product_detail_image1,$product_detail_image2,$product_detail_image3];

                        $product_category_name_query =  "SELECT * FROM `category` WHERE category_id = $product_detail_category_id";
                        $category_name_query_result  = mysqli_query($conn,$product_category_name_query);
                        while ($row = mysqli_fetch_array($category_name_query_result)) {
                            $detail_product_category_name = $row["category_name"];
                        }

                        $product_brand_name_query =  "SELECT * FROM `brand` WHERE brand_id = $product_detail_brand_id";
                        $brand_name_query_result  = mysqli_query($conn,$product_brand_name_query);
                        while ($row = mysqli_fetch_array($brand_name_query_result)) {
                            $detail_product_brand_name = $row["brand_name"];
                        }


                        echo "

                        <!--  product detail carousel  -->

                        <div class='col-md-6 detail-image flex-column'>
                            <div id='carouselExampleIndicators' class='carousel slide'>
                                <div class='carousel-indicators'>
                                        <img data-bs-target='#carouselExampleIndicators' data-bs-slide-to='0'  aria-current='true' aria-label='Slide 1' class= 'active image2' src='../admin/product_images/$product_detail_image1' alt='$product_detail_name'>
                                        <img data-bs-target='#carouselExampleIndicators' data-bs-slide-to='1' aria-label='Slide 2' class= 'image3' src='../admin/product_images/$product_detail_image2' alt='$product_detail_name'>
                                        <img data-bs-target='#carouselExampleIndicators' data-bs-slide-to='2' aria-label='Slide 3' class= 'image4' src='../admin/product_images/$product_detail_image3' alt='$product_detail_name'>
                                </div>
                                <div class='carousel-inner'>
                                    <div class='carousel-item active'>
                                    <img class= 'image d-block w-100' src='../admin/product_images/$product_detail_image1' alt='$product_detail_name'>
                                    </div>
                                    <div class='carousel-item'>
                                    <img class= 'image d-block w-100' src='../admin/product_images/$product_detail_image2' alt='$product_detail_name'>
                                    </div>
                                    <div class='carousel-item'>
                                    <img class= 'image d-block w-100' src='../admin/product_images/$product_detail_image3' alt='$product_detail_name'>
                                    </div>
                                </div>
                               
                             </div>
                        
                        </div>

                        <!--  product detail carousel ends -->

                        <!--  product detail information  -->
                        <div class='col-md-6 '>
                            <div class='w-90'>
                                <small>$detail_product_brand_name</small>
                                <h4> $product_detail_name</h4>
                                <small class='text-secondary-subtle text-secondary'>Category: $detail_product_category_name </small>
                                <!-- Star Rating -->
                                <div class='rating mb-3 mt-2'>
                                <span class='fas fa-star text-warning'></span> 
                                <span class='fas fa-star text-warning'></span> 
                                <span class='fas fa-star text-warning'></span> 
                                <span class='fas fa-star-half-alt text-warning'></span> 
                                <span class='far fa-star text-warning'></span> 
                                </div>
                                
                            
                                <h6>Price: <sup>$</sup> <span class='fs-3'>$product_detail_price </span> </h6>
                            
                                <p class='mb-3'>About the product: $product_detail_description</p>


                                <form method='post' action='cart.php'>

                                    <input name='detail_product_id' type='hidden' value='$product_detail_id'>
                                    <input name='detail_product_name' type='hidden' value='$product_detail_name'>
                                    <input name='detail_product_price' type='hidden' value='$product_detail_price'>
                                    <input name='detail_product_image' type='hidden' value='$product_detail_image1'>
                               
                        
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
                                        <input type='input' value='1' class='form-select' name='product_quantity' >
                                        <button class='btn border outline' > + </button>
                                        
                                    </div>

                                    <!--  select quantity ends -->
                                    
                                    <br>
                                    <input type='submit' name='add_to_cart' class='btn btn-primary' value = 'Add To Cart'>
                                </form>

                            </div>
                        </div>
                        <!--  product detail carousel ends -->

                        
                        ";

                        }
                    }

            ?>


             <!-- related product carousel  -->
        <div class='related-product   flex-column mt-5 '>
            <h4>Related products</h4>
            <div id='relatedProduct' class='position-relative mt-5'>
                <div class='overflow-auto d-flex flex-row  bg-opacity-85  gap-3 costume-slider' id='custome-carousel-item' onload="showSlide()">
                    <?php 
              
                            $all_products_list  = "SELECT * from `products`";

                            $result_query = mysqli_query($conn,$all_products_list);
                            $row = mysqli_fetch_array($result_query);
                            $i=0;

                            while ($row = mysqli_fetch_array($result_query) ) {
                            $i+=1;
                            //     $product_detail_id = $row["product_id"];
                                $product_detail_name = $row["product_name"];
                                $product_detail_price = $row["product_price"];
                                    $product_detail_image1 = $row["product_img1"];
                           
                            echo "
                                
                                    <div  class=' custom-carousel-column d-flex flex-column justify-content-center border p-2 col-lg-2 col-md-4 col-sm-6 col-xs-12 px-5' id='slide" .($i). "'>
                                        <img class='d-block mb-2' src='../admin/product_images/" . $product_detail_image1 . "' alt='" . $product_detail_name . "'>
                                            <h6 class='text-truncate text-warning-subtle'>$product_detail_name</h6>
                                
                                            <!-- Star Rating -->
                                        <div class='rating'>
                                            <span class='fas fa-star text-warning'></span> 
                                            <span class='fas fa-star text-warning'></span> 
                                            <span class='fas fa-star text-warning'></span> 
                                            <span class='fas fa-star-half-alt text-warning'></span> 
                                            <span class='far fa-star text-warning'></span> 
                                        </div>
                                        <h5>$ $product_detail_price</h5>
                                        
                                    </div>
                                    
                                ";
                                
                            }
                    ?>
             

                </div>
                  <!-- Previous Button -->
                <button type="button" class="position-absolute start-0 top-50 z-1 border border-0 border-none outline-none" onclick="Prev()">
                    <i class="fas fa-chevron-left fa-2x"></i>
                </button>

                <!-- Next Button -->
                <button type="button" class=" position-absolute end-0 top-50 z-1 border border-none" onclick="Next()">
                <i class="fas fa-chevron-right fa-2x"></i>
                </button>
             
               
            </div>   
    
        </div>
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