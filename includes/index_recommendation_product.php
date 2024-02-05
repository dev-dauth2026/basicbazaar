


<div class='container related-product   flex-column my-5 '>
            <h4 class="text-secondary">Recommended products</h4>
            <hr class="custom-hr col-2">
            <div id='relatedProduct' class='position-relative mt-3'>
                <div class='overflow-auto d-flex flex-row  bg-opacity-85  gap-3 costume-slider' id='custome-carousel-item' onload="showSlide()">
                            <?php if($products->num_rows > 0) { ?>
                                    <?php while ($product = $products->fetch_assoc()) {    ?>
                                    <div  class=' custom-carousel-column d-flex flex-column justify-content-center border p-2 col-lg-2 col-md-4 col-sm-6 col-xs-12 px-5' id='slide" .($i). "'>
                                        <img class='d-block mb-2' src='../admin/product_images/<?php echo $product['product_img1']?> ' alt=''>
                                            <h6 class='text-truncate text-warning-subtle'><?php echo $product['product_name']?> </h6>
                                
                                            <!-- Star Rating -->
                                        <div class='rating'>
                                            <span class='fas fa-star text-warning'></span> 
                                            <span class='fas fa-star text-warning'></span> 
                                            <span class='fas fa-star text-warning'></span> 
                                            <span class='fas fa-star-half-alt text-warning'></span> 
                                            <span class='far fa-star text-warning'></span> 
                                        </div>
                                        <h5>$<?php echo $product['product_price']?> </h5>
                                        
                                    </div>

                                <?php } ?>
                             <?php } ?>

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