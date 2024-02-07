
<div class="container-fluid py-4 ">
        <div class=" row filters ">
            <div class="col-lg-2 col-md-2 col-sm-3 col-4 d-flex flex-column gap-5">
                <form method="GET" action="products.php" class="d-flex flex-column gap-5">
                
                <input type="submit" value="Filter" class="btn btn-warning float-end">
                <!-- selected filter  -->
                <div>
                    <h6>Selected Filter</h6>
                    <hr class="custom-hr ">
                    <div class="d-flex flex-column gap-2">
                        <span class="bg-success-subtle text-success px-3 py-1 rounded ">Shoes X</span>
                        <span class="bg-success-subtle text-success px-3 py-1 rounded ">4 Star and Up X</span>
                    </div>
                 </div>


                <!-- color filter  -->
                <div class=" d-flex flex-column">
                    <h6>Colors</h6>
                    <hr class="custom-hr ">
                    <div class="d-flex flex-column">
                        <?php foreach ($color_array as $color){?>
                            <div class="d-flex gap-3">
                            <input type="checkbox" name="color[]" value="<?php echo $color; ?>"  >
                            <label for="<?php echo $color; ?>" class="text-capitalize"><?php echo $color; ?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- brand filter  -->
                <div class=" d-flex flex-column">
                    <h6>Brands</h6>
                    <hr class="custom-hr ">
                
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
                <!-- <div class=" d-flex flex-column">
                    <h6>Price</h6>
                    <hr class="custom-hr ">
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="pricerange1">
                            <label for="pricerange1">Up to $25</label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="pricerange2">
                            <label for="pricerange2">$25 to $50</label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="pricerange3">
                            <label for="pricerange3">$50 to $100</label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="pricerange4">
                            <label for="pricerange4">$100 to $200</label>
                        </div>
                        <div class="d-flex gap-3">
                            <input type="checkbox" name="pricerange5">
                            <label for="pricerange5">$200 & above</label>
                        </div>
                        

                    </div>
                </div> -->

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