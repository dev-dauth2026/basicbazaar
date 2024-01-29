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
    <link rel="stylesheet" href="../assets/css/global_css/global.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/siderbar.php' ?>

            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">Admin Dashboard</h2>
                </div>

                <!-- Product Table -->
                <div class="mt-4">
                    <div class="w-full d-flex flex-column justify-content-between align-item-center mb-5">
                        <h2 class="display-7">Brand List</h2>
                        <?php ActionMessage() ?>
                       
                        <form class="" method="post">
                            <input type="text" class="p-2 p border border-secondary rounded" name="brand_title" placeholder="Add New brand...">
                            <input type="text" class="p-2 p border border-secondary rounded" name="brand_description" placeholder="Add brand description...">
                            <input type="submit" name="add_brand" class="p-2 bg-primary text-light border rounded text-decoration-none h-full" value="Add Brand">
                        </form>
                    </div>

                    <div class="table-responsive w-full">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="col-12">
                                    <th class="col-2">ID</th>
                                    <th class="col-3">Brand Name</th>
                                    <th class="col-5">Brand Description</th>
                                    <th class="col-2">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $all_brands = "select * from `brand` ";
                                $result_brand = mysqli_query($conn, $all_brands);
                                while ($row_brand = mysqli_fetch_array($result_brand)) {
                                    $brand_id = $row_brand["brand_id"];
                                    $brand_name = $row_brand["brand_name"];
                                    $brand_description = $row_brand["brand_description"];

                                    if (isset($_GET["edit_brand"]) && $_GET['edit_brand'] == $brand_id) {
                                        echo "
                                        <form method='post'>
                                        <tr>
                                            <td><input type='text' placeholder='$brand_id' name='update_brand_id' value='$brand_id' readonly></td>
                                            <td><input type='text' placeholder='$brand_name' name='update_brand_name' value='$brand_name'> </td>
                                            <td><input type='text' placeholder='$brand_description' name='update_brand_description' value='$brand_description'> </td>
                                            <td>
                                                <input class='btn btn-warning btn-sm' type='submit' name='update_brand' value='Update'>
                                                <a href='add-brand.php?' class='btn btn-danger btn-sm' name='delete_brand' type='button'>Cancel</a>
                                            </td>
                                        </tr>
                                        </form>
                                        ";
                                    } else {
                                        echo " <tr>
                                        <td>$brand_id </td>
                                        <td>$brand_name </td>
                                        <td>$brand_description </td>
                                        <td>
                                            <a href='add-brand.php?edit_brand=$brand_id' class='btn btn-warning btn-sm' type='submit' name='edit_brand'>Edit</a>
                                            <a href='add-brand.php?delete_brand=$brand_id' class='btn btn-danger btn-sm' name='delete_brand'>Delete</a>
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
