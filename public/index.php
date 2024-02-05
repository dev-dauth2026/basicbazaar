
 <?php 

 session_start();
 include '../includes/config.php';

if(isset($_GET['search_input'])){
    $searchTerm = $_GET['search_input'];
    header('location: products.php?search_input='. $searchTerm);
 } 

 $watched_products = $conn->query("SELECT * from `products`");
 $products = $conn->query("SELECT * from `products`");
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
    <link rel="stylesheet" href="../assets/css/index/index.css">
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>
<body> 


       <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

     <!-- Include category Navbar -->
     <?php include '../includes/category_navbar.php'; ?>

     <!-- include carousel  -->
     <?php include '../includes/carousel.php'; ?>
    
      <!-- Include index categories card -->
      <?php include '../includes/index_categories.php'; ?>

      <!-- Include watched product card -->
      <?php include '../includes/watched_product.php'; ?>

       <!-- Include recommendation product -->
       <?php include '../includes/index_recommendation_product.php'; ?>   

    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>


    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>

    <!-- Your Custom Scripts (if any) -->
    <script src="js/script.js"></script>
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
    
</body>
</html>
