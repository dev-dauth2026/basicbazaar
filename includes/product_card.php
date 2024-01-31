

<div class="container p-2">
        <div class="row col-12 wrap min-vh-100 ">

            <!-- Product Card -->
            <?php  if($products->num_rows>0){ ?>
              <?php  while ($row = $products->fetch_assoc()) { ?>
                        <div class=' col-lg-3 col-md-4 col-sm-6 col-12 '>
                            <div class='custom_product card p-2 mb-2' >
                                <a href='product-details.php?product_details=<?php echo $row['product_id']?>' class='pointer'>
                                    <img src='../admin/product_images/<?php echo $row['product_img1']?>' alt='Product Image' class='card-img-top custome-image '>
                                </a>
                                <div class='card-body'>
                                    <h6 class='product-title'><?php echo $row['product_name'] ?></h6>
                                    <p class='product-price'><?php echo $row['product_price'] ?></p>
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
               
                <div class ='col-lg-10 mx-auto d-flex justify-content-center align-items-center p-5 m-5 shadow '>
                        <h3> Sorry, No product Available</h3>
                
                </div>
    
             <?php } ?>
            

        </div>
 </div>
  <!-- <button class='btn btn-primary btn-add-to-cart'>Add to Cart</button>
<a href='#' class='btn btn-outline-secondary btn-details'>Details</a> -->