
 <!-- Include Navbar -->
 <?php 

 session_start();
 include '../includes/config.php';

 $color_array = $conn->query("SELECT * FROM color");
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

 }
 elseif((isset($_GET['brand'])) || (isset($_GET['color'])) || (isset($_GET['filter_price']))) {
        if(isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])){
            $filtered_brand_array = $_GET['brand'];
            $brand_placeholders = implode(', ', array_fill(0, count($filtered_brand_array), '?'));
        }
        if(isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color'])){
            $filtered_color_array = $_GET['color'];
            $color_placeholders = implode(', ', array_fill(0, count($filtered_color_array), '?'));
        }
        if(isset($_GET['filter_price']) ){
            $filtered_price = (int)$_GET['filter_price'];
        }
// if filters have all 3 filter (brand, color and price)
    if ((isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) && 
        (isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color'])) &&  
        (isset($_GET['filter_price'])) ){
        $brand_color_price_stmt = $conn->prepare("SELECT * FROM products WHERE brand_id IN ($brand_placeholders) AND color_id IN ($color_placeholders) AND product_price <= ?");
    
        $types = str_repeat('i', count($filtered_brand_array)+count($filtered_color_array)) . 'i';
        $params = array_merge( $filtered_brand_array,$filtered_color_array,[$filtered_price]);
        $brand_color_price_stmt->bind_param($types,...$params);
        $brand_color_price_stmt->execute();
        $results = $brand_color_price_stmt->get_result();

// if filters have brand and color selected
    }elseif ((isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) && 
    (isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color'])) 
     ){
        $brand_color_stmt = $conn->prepare("SELECT * FROM products WHERE brand_id IN ($brand_placeholders) AND color_id IN ($color_placeholders) ");

        $types = str_repeat('i', count($filtered_brand_array)+count($filtered_color_array)) ;
        $params = array_merge( $filtered_brand_array,$filtered_color_array);
        $brand_color_stmt->bind_param($types,...$params);
        $brand_color_stmt->execute();
        $results = $brand_color_stmt->get_result();

    }
    // if filter has brand and price selected
    elseif ((isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) && 
        (isset($_GET['filter_price'])) ){
        $brand_price_stmt = $conn->prepare("SELECT * FROM products WHERE brand_id IN ($brand_placeholders)  AND product_price <= ?");
    
        $types = str_repeat('i', count($filtered_brand_array)) . 'i';
        $params = array_merge( $filtered_brand_array,[$filtered_price]);
        $brand_price_stmt->bind_param($types,...$params);
        $brand_price_stmt->execute();
        $results = $brand_price_stmt->get_result();

    }
    // if filter has color and price selected
    elseif (
        (isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color'])) &&  
        (isset($_GET['filter_price'])) ){
        $color_price_stmt = $conn->prepare("SELECT * FROM products WHERE   color_id IN ($color_placeholders) AND product_price <= ?");
    
        $types = str_repeat('i', count($filtered_color_array)) . 'i';
        $params = array_merge($filtered_color_array,[$filtered_price]);
        $color_price_stmt->bind_param($types,...$params);
        $color_price_stmt->execute();
        $results = $color_price_stmt->get_result();

    }
    // if filter has brand e selected
    elseif (isset($_GET['brand']) && is_array($_GET['brand']) && !empty($_GET['brand'])) {
        $brand_stmt = $conn->prepare("SELECT * FROM products WHERE brand_id IN ($brand_placeholders)");
    
        $types = str_repeat('i', count($filtered_brand_array));
        $brand_stmt->bind_param($types, ...$filtered_brand_array);
        $brand_stmt->execute();
        $results = $brand_stmt->get_result();

    }
    // if filter has color selected
    elseif(isset($_GET['color']) && is_array($_GET['color']) && !empty($_GET['color'])) {
        $color_stmt = $conn->prepare("SELECT * FROM products WHERE color_id IN ($color_placeholders)");
    
        $types = str_repeat('i', count($filtered_color_array));
        $color_stmt->bind_param($types, ...$filtered_color_array);
        $color_stmt->execute();
        $results = $color_stmt->get_result();

    }
    // if filter has  price selected
    elseif(isset($_GET['filter_price'])  && !empty($_GET['filter_price'])) {
        $filter_price_stmt = $conn->prepare("SELECT * FROM products WHERE product_price <=?");
        $filter_price_stmt->bind_param('i',$filtered_price);
        $filter_price_stmt->execute();
        $results = $filter_price_stmt->get_result();

    }
}
else{
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

   <script>
    const rangeInput = document.getElementById('rangeInput');
    const rangeValueDisplay = document.getElementById('priceRangeValue');

    rangeValueDisplay.style.display= 'none'

    // Function to update the position and value display
    function updateDisplay() {
      // Get the position of the thumb relative to the range input element
      const thumbPosition = (rangeInput.value / rangeInput.max) * rangeInput.offsetWidth;

      // Set the left position of the display element to align with the thumb position
      rangeValueDisplay.style.left = thumbPosition + 'px';

      // Set the text content of the display element to the current value of the range input
      rangeValueDisplay.textContent ='$'+ rangeInput.value;

      // Show the display element
      rangeValueDisplay.style.display = 'block';
    }

    // Add event listeners for input and mousemove events to update the display
    rangeInput.addEventListener('input', updateDisplay);
    rangeInput.addEventListener('mousemove', updateDisplay);
  </script>
    
</body>
</html>
