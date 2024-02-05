
 <!-- Include Navbar -->
 <?php 

 session_start();
 include '../includes/config.php';

 if(isset($_GET["category_id"])){
    $category_id = $_GET["category_id"];
    $results =$conn->query ("SELECT * FROM `products` WHERE category_id = $category_id");
   

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
    
    $results = $conn->query($search_query);

 } else{
    $results  =$conn->query("SELECT * from `products`");
    
 }

 $products = $results;
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
      <?php include '../includes/product_card.php'; ?>

      <!-- include pagination -->

      <?php include '../includes/product_pagination.php'; ?>

     

    <!-- Include Navbar -->
     <?php include '../includes/footer.php'; ?>


    <!-- Bootstrap JS (optional, but may be needed for some components) -->
    <?php include '../admin/includes/js_cdn.php'; ?>

    <!-- Your Custom Scripts (if any) -->
    <script src="js/script.js"></script>
    
    
</body>
</html>
