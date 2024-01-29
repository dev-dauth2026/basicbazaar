
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
   <link rel="styleshee" href="../assets/css/global_css/global.css">
</head>

<body>
<div class="container-fluid">
        <div class="row">
            <!-- included navbar  -->
            <?php include 'includes/siderbar.php'  ?>
            
            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 pb-5 vh-100 overflow-scroll">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">Admin Dashboard</h2>
                </div>
               
                <!-- Add Product Form -->
                <div class="mt-4 w-50 mx-auto p-5 shadow">
                        <h3>Update Product</h3>
                                    
                        <form class="d-flex flex-column gap-3" enctype="multipart/form-data" method="post" >
                        <?php ActionMessage() ?>
                                <div class="form-group">
                                <label for="productName">Product ID</label>
                                <input type="text" class="form-control" id="productName" name="product_id" value="<?php echo $edit_product_id?>" placeholder="Enter product name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="product_name" value="<?php echo $edit_product_name?>" placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Product Description</label>
                                <textarea type="text"   class="form-control "  id="productDescription" name="product_description" rows="3" placeholder="Enter product description" >  
                                 <?php echo trim($edit_product_description)?> 
                                </textarea>
                            </div>
                            <div class="form-group ">
                                <label for="productPrice">Product Price</label>
                                <input type="text" class="form-control" id="productPrice" name="product_price"  value="<?php echo $edit_product_price ?>" placeholder="Enter product price">
                            </div>

                          
                            <div class="form-group">
                                <label for="productCategory">Product Category</label>
                                <select class="form-select " id="productCategory" name="product_category">
                                <option  selected>Select Category</option>
                                <?php CategoryDropdown() ?>
                                 </select>
                            </div>

                          
                            <div class="form-group">
                            <label for="productBrand">Product Brand</label>
                                <select class="form-select " id="productBrand" name="product_brand">
                                <option selected>Select Brand</option>
                                <?php BrandDropDown()  ?>
                                 </select>

                            </div>
                            
                 
                            <div class="form-group">
                                <label for="image1">Image 1</label>
                                <input type="file" class="form-control" id="image1" name="product_image1" value="<?php echo $edit_product_img1?>" >
                            </div>
                            <div class="form-group">
                                <label for="image2">Image 2</label>
                                <input type="file" class="form-control" id="image2" name="product_image2" >
                            </div>
                            <div class="form-group">
                                <label for="image3">Image 3</label>
                                <input type="file" class="form-control" id="image3" name="product_image3" >
                            </div>
                            <input type="submit" name="update_product" class="btn btn-primary" value="Update Product">
                            <a href="all-products.php" type="submit" name="update_product" class="btn btn-danger" >Cancel</a>
                        </form>
                </div>
             
            </main>
        </div>
</div>

    <?php include('includes/js_cdn.php') ?>
</body>

</html>