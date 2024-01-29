
<div class="container p-2">
        <div class="row wrap min-vh-100">

            <!-- Product Card -->
            <?php 
         
             
             if(isset($_GET["category_id"])){
                $category_id = $_GET["category_id"];
                $product_list = "SELECT * FROM `products` WHERE category_id = $category_id";
                $result_query = mysqli_query($conn,$product_list);

             }elseif(isset($_GET['search_input'])){
                $searchTerm = $_GET['search_input'];
                if(count($searchTermArray = explode(' ',$searchTerm))>1){
                    foreach($searchTermArray as $word){
                        $conditions[] = "product_name LIKE '%$word%'";
                    }
                      // Combine conditions using OR to allow any match
                     $combinedConditions = implode(' AND ', $conditions);
                   
                    $search_query = "SELECT * FROM `products` WHERE $combinedConditions";
                }else{
                    $search_query = "SELECT * FROM `products` WHERE product_name LIKE '%$searchTerm%'";
                }
                
                $result_query = mysqli_query($conn,$search_query);

             } else{
                $product_list  = "SELECT * from `products`";
                $result_query = mysqli_query($conn,$product_list);
             }

           
            $num_of_row = mysqli_num_rows($result_query);
          
            if($num_of_row>0){
             while ($row = mysqli_fetch_array($result_query)) {
                 $product_id = $row["product_id"];
                 $product_name = $row["product_name"];
                 $product_price = $row["product_price"];
                 $product_description = $row["product_description"];
                 $product_image1 = $row["product_img1"];
                 $product_image2 = $row["product_img2"];
                 $product_image3 = $row["product_img3"];
                
                         echo 
                        "
                        <div class=' col-lg-3 col-md-4 col-sm-6 col-12 '>
                            <div class='custom_product card p-2 mb-2' >
                                <a href='product-details.php?product_details=$product_id' class='pointer'><img src='../admin/product_images/$product_image1' alt='Product Image' class='card-img-top custome-image '></a>
                                <div class='card-body'>
                                    <h6 class='product-title'>$product_name</h6>
                                    <p class='product-price'>$$product_price</p>
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
                        ";
             }
                   
             }else{
                echo "
                <div class ='col-lg-10 mx-auto d-flex justify-content-center align-items-center p-5 m-5 shadow '>
                        <h3> Sorry, No product Available</h3>
                
                </div>
        
                
                ";
             }
    

            ?>
            

        </div>
 </div>
  <!-- <button class='btn btn-primary btn-add-to-cart'>Add to Cart</button>
<a href='#' class='btn btn-outline-secondary btn-details'>Details</a> -->