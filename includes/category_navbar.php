<nav class="navbar bg-secondary px-3 text-white" style="height: 40px;">
        <div class="container-fuild h-100">
            <ul class=" d-flex gap-5 align-items-center h-100">
            <li  class="nav-item   h-100">
                            <a class="nav-link text-light" href="products.php">All</a>
                        </li>
                <?php

                $all_categories = "select * from `category`";
                $result_category = mysqli_query($conn, $all_categories) or die(mysqli_error($conn));
                
                    while($row_category = mysqli_fetch_array($result_category)){
                        $category_id = $row_category["category_id"];
                        $category_name = $row_category["category_name"];

                        echo "
                        <li class='nav-item'>
                         <a class='nav-link' href='products.php?category_id=$category_id'>$category_name</a>
                         </li>";
                        

                    };
              

                ?>

            </ul>
        </div>
</nav>