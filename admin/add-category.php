
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
        <?php 
        include 'includes/siderbar.php' 
        
        ?>
            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">Admin Dashboard</h2>
                </div>
                <!-- Product Table -->
                <div class="mt-4">
                    <div class="w-full d-flex flex-column justify-content-between align-item-center  bg-[red] mb-5">
                        <h2 class="display-7">Categories List</h2>
                     
                         <?php ActionMessage() ?>
                      
                        <form class="" method="post" class="w-100 d-flex justify-content-end">
                            <input type="text" class="p-2 mt-3 border border-secondary rounded" name = "cat_title" placeholder="Add New Category...">
                            <input type="submit" name = "add_category" class="p-2 bg-primary text-light border rounded  text-decoration-none h-full" value="Add Category" >

                        </form>
                    </div>
                    
                
                    <div class="table-responsive w-full">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="col-12">
                                    <th class="col-4">ID</th>
                                    <th class="col-4">Name</th>
                                    <th class="col-4">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                
                                <?php
                                $all_categories = "select * from `category` ";
                                $result_category = mysqli_query($conn, $all_categories);
                                while($row_category = mysqli_fetch_array($result_category)){
                                    $category_id = $row_category["category_id"];
                                    $category_name = $row_category["category_name"];

                                    if(isset($_GET['edit_category']) && $_GET['edit_category']==$category_id){

                                        echo "
                                        <form method='post'>
                                            <tr>
                                                <td>$category_id </td>
                                                <td><input type='text' name='category_name' placeholder='$category_name'> </td>
                                                <td>
                                                <input type='submit' name='update_category' class='btn btn-warning btn-sm' value='Update'>
                                                <a href='add-category.php' class='btn btn-danger btn-sm' name ='delete_category' >Cancel</a>
                                                </td>
                                            </tr>
                                        </form>
                                        
                                        ";
                                       
                                    }else{
                                        echo" <tr>
                                        <td>$category_id </td>
                                        <td>$category_name </td>
                                        <td>
                                        <a href='add-category.php?edit_category=$category_id' class='btn btn-warning btn-sm' name='edit_category'>Edit</a>
                                        <a href='add-category.php?delete_category=$category_id' class='btn btn-danger btn-sm' name ='delete_category' >Delete</a>
                                         </td>
                                         </tr>
                                        ";

                                    }
                                    
                                }
                                ?>
                                

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <?php include('includes/js_cdn.php') ?>
</body>

</html>
