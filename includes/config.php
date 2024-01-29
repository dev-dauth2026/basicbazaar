<!-- <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

?> -->
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
// Database configuration
$host =getenv('DB_HOST'); 
$username =  getenv('DB_USERNAME'); 
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE'); 

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

//brand section

global $status_message;

// admin section

//add brand
if (isset($_POST['add_brand'])) {
    $brand_title = ucwords($_POST['brand_title']);
    $brand_description = ucwords($_POST['brand_description']);

    if ($brand_title !== '') {
        $check_brand = "select * from `brand` where brand_name = '$brand_title'";
        $brand_exist = mysqli_query($conn, $check_brand);
        $brand_num_available = mysqli_num_rows($brand_exist);

        if ($brand_num_available > 0) {
            header("Location: add-brand.php?add_brand_status=failed&add_message_status=exists&action_category=brand");
        } else {
            $insert_brand = "insert into `brand` (brand_name, brand_description) values ('$brand_title','$brand_description')";
            $result_query = mysqli_query($conn, $insert_brand);

            if($result_query){
                header("Location: add-brand.php?add_brand_status=success&add_message_status=success&action_category=brand");
            }else{
                header("Location: add-brand.php?add_brand_status=failed&add_message_status=failed&action_category=brand");
            }
            
        }
    } else {
        header("Location: add-brand.php?add_brand_status=empty&add_message_status=empty&action_category=brand");
    }
}

//edit brand

if(isset($_GET['edit_brand'])){

    $edit_brand_id = $_GET['edit_brand'];

    $fetch_brand = "SELECT * FROM `brand` WHERE brand_id = $edit_brand_id";
    $brand_fetch_result = mysqli_query($conn,$fetch_brand);

    $row_brand = mysqli_fetch_assoc($brand_fetch_result);
    $edit_brand_name = $row_brand["brand_name"];
};

if(isset($_POST["update_brand"])){
    $update_brand_id = $_POST['update_brand_id'];
    $update_brand_name = $_POST['update_brand_name'];
    $update_brand_description = $_POST['update_brand_description'];

    if(!empty($update_brand_name)){

        $update_brand_name_query = "UPDATE `brand` SET 
                            `brand_name` =  '$update_brand_name'
                            WHERE brand_id = '$update_brand_id'";
        mysqli_query($conn,$update_brand_name_query);
        
    }
    if(!empty($update_brand_description)){

        $update_brand_description_query = "UPDATE `brand` SET 
                            `brand_description` = '$update_brand_description'
                            WHERE brand_id = '$update_brand_id'";
        
        mysqli_query($conn,$update_brand_description_query);
    }
    
    header("Location: add-brand.php?update_status=success&action_category=brand");
}

//delete brand

if(isset($_GET["delete_brand"])){
    $delete_brand_id = $_GET["delete_brand"];

    $delete_brand_query = "DELETE FROM `brand` WHERE brand_id = '$delete_brand_id' ";

    mysqli_query($conn,$delete_brand_query);

    header("Location: add-brand.php?delete_status=success&action_category=brand");

}

function BrandDropDown(){
    global $conn;
    $edit_product_id = $_GET['edit_product'];
    $all_brand = "select * from `brand`";
    $result_brand = mysqli_query($conn,"$all_brand");
    if($result_brand>0){
        while($row_brand = mysqli_fetch_array($result_brand)) {
            $select_brand_id = $row_brand["brand_id"];
            $select_brand_name = $row_brand["brand_name"];

            echo "<option value='$select_brand_id' $select_brand_id==$edit_product_id && selected>$select_brand_name</option> ";
    
        }
    }else{
        echo "
        <h2 class = 'text-center'>No Brand available</h2>
        
        ";
    }
                                    
}


 //category section

 // add category
 if(isset($_POST['add_category'])){

    $category_title = ucwords($_POST['cat_title']);

    if($category_title !==''){
        $check_category = "select * from `category` where category_name = '$category_title'";
        $category_exist = mysqli_query($conn,$check_category);
        $category_num_available = mysqli_num_rows($category_exist);

        if ($category_num_available>0){
            header("Location: add-category.php?add_category_status=failed&add_message_status=failed&action_category=category");

        }else{
            $insert_category = "insert into `category` (category_name) values ('$category_title')";
            $result = mysqli_query($conn, $insert_category);

            if($result){
                header("Location: add-category.php?add_category_status=success&add_message_status=success&action_category=category");
            }

        }
    }else{
        header("Location: add-category.php?add_category_status=failed&add_message_status=empty&action_category=category");
     
    }
   
}

 //delete category

 if(isset($_GET['delete_category'])){
    $delete_category_id = $_GET['delete_category'];
    $delete_category_query = "delete from `category` where category_id = '$delete_category_id'";
    mysqli_query($conn,$delete_category_query);

    header("Location: add-category.php?delete_status=success&action_category=category");
 }

 //edit category

 if(isset($_GET["edit_category"])){
    global $edit_category;
   $edit_category_id = $_GET["edit_category"];
 }

 // update category

 if(isset($_POST['update_category'])){
    $update_category_name = ucwords($_POST['category_name']);
    if($update_category_name != ''){
        $edit_category_query = "update  `category` set category_name ='$update_category_name' where category_id = '$edit_category_id'";
        mysqli_query($conn,$edit_category_query);

        header("Location: add-category.php?category_update=success&update_status=success&action_category=category");
    }
    
 }

 // category dropdown
 
 function CategoryDropdown(){
    global $conn;
    $edit_product_id = $_GET['edit_product'];
    $all_categories = "select * from `category`";
    $result_category = mysqli_query($conn,$all_categories);
    while($row_category = mysqli_fetch_array($result_category)) {
        $select_category_id = $row_category["category_id"];
        $select_category_name = $row_category["category_name"];

        echo "<option value='$select_category_id' $select_category_id==$edit_product_id && selected>$select_category_name</option>"; 

    }
 }


//get all products 

// edit_product 

if(isset($_GET['edit_product'])){
    $edit_product_id = $_GET['edit_product'];

    $query_edit_product = "SELECT * FROM `products` WHERE product_id = $edit_product_id";
    $edit_query_result = mysqli_query($conn,$query_edit_product);
    while($row_edit_product = mysqli_fetch_assoc($edit_query_result)){
        $edit_product_id = $row_edit_product['product_id'];
        $edit_product_name = $row_edit_product['product_name'];
        $edit_product_description = $row_edit_product['product_description'];
        $edit_product_price = $row_edit_product['product_price'];
        $edit_category_id = $row_edit_product['category_id'];
        $edit_brand_id = $row_edit_product['brand_id'];
        $edit_product_img1 = $row_edit_product['product_img1'];
        $edit_product_img2 = $row_edit_product['product_img2'];
        $edit_product_img3 = $row_edit_product['product_img3'];
        $edit_created_at = $row_edit_product['created_at'];
        $edit_status = $row_edit_product['status'];
    }
 }


// add product

if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category_id = $_POST['product_category'];
    $brand_id = $_POST['product_brand'];
    $status = 'true';

    // $uploadDirectory = "./product_images/";

    $product_image1 = $_FILES["product_image1"]["name"];
    $product_image2 = $_FILES["product_image2"]["name"];
    $product_image3 = $_FILES["product_image3"]["name"];

    $temp_image1 = $_FILES["product_image1"]["tmp_name"];
    $temp_image2 = $_FILES["product_image2"]["tmp_name"];
    $temp_image3 = $_FILES["product_image3"]["tmp_name"];



    if ($product_name =='' || $product_description =='' || $product_price =='' || $category_id =='' || $brand_id =='' || $product_image1 =='' || $product_image2 =='' || $product_image3 ==''){
        header("Location: add-product.php?add_product_status=empty&add_message_status=empty&action_category=product");
  
    }else{
        if (!file_exists("product_images")) {
            mkdir("product_images", 0777, true);
        }
         // Upload the images
         move_uploaded_file($temp_image1, "product_images/"."$product_image1");
         move_uploaded_file($temp_image2, "product_images/"."$product_image2");
         move_uploaded_file($temp_image3, "product_images/"."$product_image3");
     
        $add_product_query = "insert into `products` (product_name, product_description,
                             product_price,category_id,brand_id,product_img1,product_img2,product_img3,created_at,status)
                             values ('$product_name','$product_description','$product_price','$category_id','$brand_id','$product_image1','$product_image2','$product_image3',NOW(),'$status')";

         $result_query = mysqli_query($conn, $add_product_query);

         if($result_query){
            header("Location: add-product.php?add_product_status=success&add_message_status=success&action_category=product");

         }else{
            header("Location: add-product.php?add_product_status=failed&add_message_status=failed&action_category=product");
         }    

    }
}



// edit product 
if(isset($_GET["edit_product"])){
    global $edit_category;
    $edit_product_id = $_GET["edit_product"];
                                            
 }

//  update product 
if(isset($_POST['update_product'])){
    $update_product_id = $_POST['product_id'];
    $update_product_name = $_POST['product_name'];
    $update_product_description = $_POST['product_description'];
    $update_product_price = $_POST['product_price'];
    $update_category_id = $_POST['product_category'];
    $update_brand_id = $_POST['product_brand'];
    $update_status = 'true';

    // If not empty, move the uploaded files and update the corresponding database fields
    if (!empty($_FILES["product_image1"]["name"])) {
        $update_product_image1 = $_FILES["product_image1"]["name"];
        $temp_image1 = $_FILES["product_image1"]["tmp_name"];
        move_uploaded_file($temp_image1, "product_images/$update_product_image1");
        $update_image1_query = "UPDATE `products` SET `product_img1` = '$update_product_image1' WHERE `product_id` = '$update_product_id'";
        mysqli_query($conn, $update_image1_query);
    }

    if (!empty($_FILES["product_image2"]["name"])) {
        $update_product_image2 = $_FILES["product_image2"]["name"];
        $temp_image2 = $_FILES["product_image2"]["tmp_name"];
        move_uploaded_file($temp_image2, "product_images/$update_product_image2");
        $update_image2_query = "UPDATE `products` SET `product_img2` = '$update_product_image2' WHERE `product_id` = '$update_product_id'";
        mysqli_query($conn, $update_image2_query);
    }

    if (!empty($_FILES["product_image3"]["name"])) {
        $update_product_image3 = $_FILES["product_image3"]["name"];
        $temp_image3 = $_FILES["product_image3"]["tmp_name"];
        move_uploaded_file($temp_image3, "product_images/$update_product_image3");
        $update_image3_query = "UPDATE `products` SET `product_img3` = '$update_product_image3' WHERE `product_id` = '$update_product_id'";
        mysqli_query($conn, $update_image3_query);
    }
     
        // Update the other product details
        $update_product_query = "UPDATE `products` SET 
                                `product_name` = '$update_product_name', 
                                `product_description` = '$update_product_description', 
                                `product_price` = '$update_product_price', 
                                `category_id` = '$update_category_id', 
                                `brand_id` = '$update_brand_id' 
                                WHERE `product_id` = '$update_product_id'
                                ";

         $result_query = mysqli_query($conn, $update_product_query);

         if($result_query){
            header("Location: all-products.php?update_status=success&action_category=product");

         }else{
            header("Location: all-products.php?update_status=failed&action_category=product");
         }    
    
}

// update product ends 


// delete product

if(isset($_GET['delete_product'])){
    $delete_product_id = $_GET['delete_product'];
    $delete_product_query = "delete from `products` where product_id = $delete_product_id";
    mysqli_query($conn, $delete_product_query);

    header("Location: all-products.php?deleted_status=success&action_category=product");
 }



 // public pages

 // product details

 
 //category filtering

?>
