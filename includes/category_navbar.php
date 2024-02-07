<?php 
$all_categories =$conn->query( "select * from `category`");
?>
<nav class="navbar bg-secondary px-3 text-white" style="height: 40px;">
        <div class="container-fuild h-100">
            <ul class=" d-flex gap-5 align-items-center h-100">
            <li  class="nav-item   h-100">
                            <a class="nav-link text-light" href="products.php">All</a>
                        </li>
                <?php  while($row_category = $all_categories->fetch_assoc()){ ?>
                        <li class='nav-item'>
                         <a class='nav-link' href='products.php?category_id=<?php echo $row_category['category_id']; ?>'><?php echo $row_category['category_name']; ?></a>
                         </li>
                  <?php } ?>      

            </ul>
        </div>
</nav>