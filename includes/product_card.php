
<div class="container-fluid py-4 ">
        <div class=" row filters ">
            <div class="col-lg-2 col-md-2 col-sm-3 col-4 d-flex flex-column gap-5">
                <form method="GET" action="products.php" class="d-flex flex-column gap-3">
                
                
                <input type="submit" value="Filter" class="btn btn-warning float-end">
                <!-- selected filter  -->
                <?php if(isset($_GET['color'] )|| (isset($_GET['brand'])) || (isset($_GET['filter_price']))) { ?>
                <div class="border p-2 rounded">
                    <h2 id="query"></h2>
                    <div class="d-flex justify-content-between">
                        <div><h6>Selected Filter</h6></div>
                        
                        <div><a href="products.php"><small class="text-danger">Clear</small></a></div>
                    </div>
                    
                    <hr class="custom-hr m-0  mb-2">
                   
                    <div class="d-flex flex-column gap-1">
                        <?php if(isset($_GET['color'])){ ?>
                            <p>Color :</p>
                            <?php foreach($_GET['color'] as $key=> $filtered_color_value){ ?>
                                <div class="d-flex justify-content-between align-items-center bg-success-subtle text-success px-3 py-1 rounded ">
                                <?php if($color_array->num_rows>0){ ?>
                                     <?php foreach ($color_array as $color){?>
                                        <?php if($filtered_color_value == $color['color_id']){ ?>
                                                    <span>
                                                     <?php echo $color['color_name'] ?>
                                                    </span>
                                                    <button type="button" class="pe-auto text-success border-0 bg-transparent" onclick="UnSetParam('color[]',<?php echo $filtered_color_value; ?>)"><i class="fas fa-times"></i></button>
                                                     
                                            <?php } ?>
                                    <?php }?>
                                 <?php }?>
                                </div>
                            <?php } ?>

                        <?php } ?>
                        <br>
                       
                        <?php if(isset($_GET['brand'])){ ?>
                            <p>Brand :</p>
                            <?php foreach($_GET['brand'] as $brand_key =>$filtered_brand_value){ ?>
                                <div class="d-flex justify-content-between align-items-center bg-success-subtle text-success px-3 py-1 rounded ">
                                <?php if($brand_array->num_rows>0){ ?>
                                     <?php foreach ($brand_array as $brand){?>
                                        <?php if($filtered_brand_value == $brand['brand_id']){ ?>
                                                    <span>
                                                    <?php echo $brand['brand_name'] ?>
                                                    </span>
                                                    <button type="button" class="pe-auto text-success border-0 bg-transparent" onclick="UnSetParam('brand[]',<?php echo $filtered_brand_value; ?>)"><i class="fas fa-times"></i></button>
                                                    
                                            <?php } ?>
                                    <?php }?>
                                 <?php }?>
                                </div>
                            <?php } ?>

                        <?php } ?>
                        <?php if(isset($_GET['filter_price'])){ ?>
                            <p>Price :</p>
                       
                                <div class="d-flex justify-content-between align-items-center bg-success-subtle text-success px-3 py-1 rounded ">
                                    <span>
                                    upto $<?php echo $_GET['filter_price'] ?>
                                    </span>
                                    <button type="button" class="pe-auto text-success border-0 bg-transparent" onclick="UnSetParamPrice('filter_price')"><i class="fas fa-times"></i></button>
                                </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>


                <!-- color filter  -->
                <div class=" d-flex flex-column">
                    <h6>Colors</h6>
                    <hr class="custom-hr m-0 mb-2">
                    <div class="d-flex flex-column">
                        <?php if($color_array->num_rows>0){ ?>
                        <?php foreach ($color_array as $color){?>
                            <div class="d-flex gap-3">
                            <input type="checkbox" name="color[]" value="<?php echo $color['color_id']; ?>"  
                            <?php if(isset($_GET['color'])) { ?>
                                    <?php foreach ($_GET['color'] as $filtered_color_id){ 
                                        if($filtered_color_id == $color['color_id']){
                                            echo 'checked';
                                        }

                                     } ?>

                                <?php } ?>
                            >
                            <label for="color[]" class="text-capitalize"><?php echo $color['color_name']; ?></label>
                        </div>
                        <?php } ?>
                     <?php } ?>
                    </div>
                </div>

                 <!-- customer review filter  -->
                <div class=" d-flex flex-column">
                    <h6>Size</h6>
                    <hr class="custom-hr mt-0">
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="xs">
                            <label for="xs">XS </label>   
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="sm">
                            <label for="sm">SM </label>   
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="md">
                            <label for="md">M </label>   
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="l">
                            <label for="l">L </label>   
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="xl">
                            <label for="xl">XL </label>   
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="xxl">
                            <label for="xxl">XXL </label>   
                        </div>
                    </div>
                </div>

                <!-- brand filter  -->
                <div class=" d-flex flex-column">
                    <h6>Brands</h6>
                    <hr class="custom-hr m-0 mb-2">
                
                    <div class="d-flex flex-column">
                    
                            <?php foreach ($brand_array as $brand):?>
                               
                            <div class="d-flex gap-3">
                                <input 
                                type="checkbox" 
                                name="brand[]" 
                                value="<?php echo $brand['brand_id']; ?>" 
                                <?php if(isset($_GET['brand'])) { ?>
                                    <?php foreach ($_GET['brand'] as $filtered_brand_id){ 
                                        if($filtered_brand_id == $brand['brand_id']){
                                            echo 'checked';
                                        }

                                     } ?>

                                <?php } ?>
                                
                                >
                                
                                <label for="brand[]" class="text-capitalize"><?php echo $brand['brand_name']; ?></label>
                            </div>
                         
                            <?php endforeach; ?>
                           
                            
                    </div>
                   
                </div>

                <!-- price filter  -->
            <div class=" d-flex flex-column">
                    <h6>Price</h6>
                    <hr class="custom-hr m-0">
                    <div class="d-flex flex-column">
                        <div class="position-relative py-3 ">
            
                                <span id="priceRangeValue" class="position-absolute  translate-middle badge rounded-pill text-dark  bg-light "> 
                                    <?php if(isset($_GET['filter_price'])) { ?>
                                    $<?php echo $_GET['filter_price'] ; ?>
                                
                                        <?php }else{ ?>
                                            <?php echo  $maximum_price; ?>
                                        <?php } ?>
                                </span>
                                <input id="rangeInput" name="filter_price"  class="w-100 m-2" type="range" min="0" max="<?php echo  $maximum_price; ?>" 
                                <?php if(isset($_GET['filter_price'])) { ?>
                                       value ="<?php echo $_GET['filter_price'] ; ?>"
                                    
                                    <?php }else{ ?>
                                    value ="<?php echo  $maximum_price; ?>"
                                <?php } ?>
                                >
                        </div>                 
                        
                    </div>

                </div> 

                <!-- customer review filter  -->
                <!-- <div class=" d-flex flex-column">
                    <h6>Customer Review</h6>
                    <hr class="custom-hr ">
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="star5">
                            <label for="star5">
                                <div class='rating'>
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                </div>
                            </label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="star4">
                            <label for="star4">
                                <div class='rating'>
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                </div>
                            </label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="star3">
                            <label for="star3">
                                <div class='rating'>
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                </div>
                            </label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="star2">
                            <label for="star2">
                                <div class='rating'>
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                </div>
                            </label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="star2">
                            <label for="star2">
                                <div class='rating'>
                                        <span class='fas fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                        <span class='far fa-star text-warning'></span> 
                                </div>
                            </label>
                        </div>
                        
                        

                    </div>
                </div> -->
            </form>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-8 col-8 ">
                <div class="row g-3 ">
                    <!-- Product Card -->
                    <?php  if($products->num_rows>0){ ?>
                                <?php  while ($row = $products->fetch_assoc()) { ?>

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 ">
                                        <div class="custom_product card p-2" >
                                
                                            <a href='product-details.php?product_details=<?php echo $row['product_id']?>&category_id=<?php echo $row['category_id'] ?>' class='pointer'>
                                                <img src='../admin/product_images/<?php echo $row['product_img1']?>' alt='Product Image' class='card-img-top custome-image '>
                                            </a>
                                            <div class='d-flex flex-column '>
                                                <h6 class='product-title'><?php echo $row['product_name'] ?></h6>
                                                <p class='product-price'>$<?php echo $row['product_price'] ?></p>
                                                <!-- Star Rating -->
                                                <div class='rating'>
                                                <span class='fas fa-star text-warning'></span> 
                                                <span class='fas fa-star text-warning'></span> 
                                                <span class='fas fa-star text-warning'></span> 
                                                <span class='fas fa-star-half-alt text-warning'></span> 
                                                <span class='far fa-star text-warning'></span> 
                                                </div>
                                            
                                            </div>
                            
                                        </div>
                                    </div>
                                
                                        
                                <?php }?> 
                                    
                            <?php }else{ ?>
                                
                                    <div class ='col-lg-10 mx-auto d-flex justify-content-center  p-5 m-5  '>
                                            <h3> Sorry, No product Available</h3>
                                    
                                    </div>
                        
                        <?php } ?>
                </div>
            
                

            </div>
        </div>
 </div>

  <!-- <button class='btn btn-primary btn-add-to-cart'>Add to Cart</button>
<a href='#' class='btn btn-outline-secondary btn-details'>Details</a> -->