
 <!-- Include Navbar -->
 <?php 

 session_start();
 include '../includes/config.php';

 $color_array = array("blue","gray","green","orange","pink","purple","red","white","yellow");
 $brand_array = $conn->query("SELECT * FROM brand");
 
 $categories_result = $conn->query("SELECT * FROM category");

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

 }elseif((isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) || (isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color']))) {
        $filtered_brand_array = $_GET['brand'];
        $filtered_color_array = $_GET['color'];
        $brand_placeholders = implode(', ', array_fill(0, count($filtered_brand_array), '?'));
        $color_placeholders = implode(', ', array_fill(0, count($filtered_brand_array), '?'));

    if ((isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) && (isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color']))){
        $brand_color_stmt = $conn->prepare("SELECT * FROM products WHERE brand_id IN ($brand_placeholders) AND color_id IN ($color_placeholders)");
    
        $types = str_repeat('i', count($filtered_brand_array)+count($filtered_color_array));
        $brand_color_stmt->bind_param($types, ...$filtered_brand_array);
        $brand_color_stmt->execute();
        $results = $brand_color_stmt->get_result();
    }elseif (isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) {
        $brand_stmt = $conn->prepare("SELECT * FROM products WHERE brand_id IN ($brand_placeholders)");
    
        $types = str_repeat('i', count($filtered_brand_array));
        $brand_stmt->bind_param($types, ...$filtered_brand_array);
        $brand_stmt->execute();
        $results = $brand_stmt->get_result();
        $brand_stmt = $conn->prepare('');
        $results = $brand_stmt->get_result();
    }elseif(isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color'])) {
        $color_stmt = $conn->prepare("SELECT * FROM products WHERE color_id IN ($color_placeholders)");
    
        $types = str_repeat('i', count($filtered_color_array));
        $color_stmt->bind_param($types, ...$filtered_color_array);
        $color_stmt->execute();
        $results = $color_stmt->get_result();
        $color_stmt = $conn->prepare('');
        $results = $color_stmt->get_result();
    }

    
   
}
  else{
    $results  =$conn->query("SELECT * from `products`");
    
 }


    // Retrieve filter values from the query parameters
    $selectedColors = isset($_GET['colors']) ? explode(',', $_GET['colors']) : [];
    $selectedBrands = isset($_GET['brands']) ? explode(',', $_GET['brands']) : [];
    $selectedPrices = isset($_GET['prices']) ? explode(',', $_GET['prices']) : [];
    $selectedStars = isset($_GET['stars']) ? explode(',', $_GET['stars']) : [];

    // Build your SQL query based on the selected filters
    // Execute the query and fetch results

    // Example SQL query (you need to adjust this based on your database structure)
    $result =$conn->query( "SELECT * FROM products WHERE 
            -- color IN ('" . implode("','", $selectedColors) . "') AND 
            brand_id IN ('" . implode("','", $selectedBrands) . "')
        
            ");

     // price IN ('" . implode("','", $selectedPrices) . "') AND 
            // star IN ('" . implode("','", $selectedStars) . "')    
    

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
