<?php
include('../includes/config.php');
include('../includes/status_alert.php');



if(isset($_POST["add_color"])){
    $color = ucwords($_POST["color_title"]);
    $color_stmt = $conn->prepare("INSERT INTO color (color_name) VALUES (?)");
    $color_stmt->bind_param("s",$color);
    $color_stmt->execute();
}

if(isset($_GET["delete_color"])){
    $color_id = $_GET['delete_color'];
    $delet_color_stmt = $conn->prepare("DELETE FROM color WHERE color_id = ?");
    $delet_color_stmt->bind_param("i",$color_id);
    $delet_color_stmt->execute();
}
if(isset($_POST['update_color'])){ 
    $update_color_id = $_POST['update_color_id'];
    echo $update_color_id;
    $update_color_name = $_POST['update_color_name'];
    echo $update_color_name;
    $update_color_stmt = $conn->prepare("UPDATE color SET color_name=? WHERE color_id=?");
    $update_color_stmt->bind_param("si",$update_color_name,$update_color_id);
    $update_color_stmt->execute();

    $all_colors = "SELECT * FROM `color` ORDER BY color_name";
    $colors_result = $conn->query($all_colors);
    header("location: add-color.php?color_update_message= Color has been updated successfully.");
}

$all_colors = "SELECT * FROM `color` ORDER BY color_name";
$colors_result = $conn->query($all_colors);

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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 vh-100 overflow-auto p-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2">Admin Dashboard</h2>
                </div>

                <!-- Product Table -->
                <div class="mt-4">
                    <div class="w-full d-flex flex-column justify-content-between align-item-center mb-5">
                        <h2 class="display-7">Color List</h2>

                       <?php if(isset($_GET['color_update_message'])){ ?>
                        <p class="px-3 py-2 bg-success-subtle text-success rounded"><?php echo $_GET['color_update_message'] ?> </p>

                        <?php } ?>
                        <form class="" method="post" action="add-color.php">
                            <input type="text" class="p-2 p border border-secondary rounded text-capitalize" name="color_title" placeholder="Add New color..." required>
                            <input type="submit" name="add_color" class="p-2 btn btn-warning  border rounded text-decoration-none h-full" value="Add Color">
                        </form>
                    </div>

                    <div class="table-responsive w-full">
                        <?php if($colors_result->num_rows >0){ ?>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="col-12">
                                    <th class="col-2">ID</th>
                                    <th class="col-3">Color Name</th>
                                    <th class="col-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                              <?php  while ($colors = $colors_result->fetch_assoc()) { 

                                    if (isset($_GET["edit_color"]) && $_GET['edit_color'] == $colors['color_id']) {?>
                                        <form method='post' action="add-color.php">
                                            <tr>
                                                <td><input type='text' placeholder='<?php echo $colors['color_id']?>' name='update_color_id' value='<?php echo $colors['color_id']?>' readonly></td>
                                                <td><input type='text' placeholder='<?php echo $colors['color_name'] ?>' name='update_color_name' value='<?php echo $colors['color_name']?>' required> </td>
                                                <td>
                                                    <input class='btn btn-warning btn-sm' type='submit' name='update_color' value='Update'>
                                                    <a href='add-color.php?' class='btn btn-danger btn-sm' name='cancel_color' type='button'>Cancel</a>
                                                </td>
                                            </tr>
                                        </form>
                               
                                   <?php } else { ?>
                                      <tr>
                                        <td><?php echo $colors['color_id']?></td>
                                        <td><?php echo $colors['color_name']?> </td>
                                        <td>
                                            <a href='add-color.php?edit_color=<?php echo $colors['color_id']?>' class='btn btn-warning btn-sm'  name='edit_color'>Edit</a>
                                            <a href='add-color.php?delete_color=<?php echo $colors['color_id']?>' class='btn btn-danger btn-sm' name='delete_color'>Delete</a>
                                        </td>
                                    </tr>
                             
                                   <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php }else {?>
                                <div class="d-flex justify-content-center border p-5 fs-3">
                                    
                                      <div >Sorry, There is no color available.<div>
                                     <div>Please add some color for the product  </div>
                                    
                                </div>


                            <?php } ?>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include('includes/js_cdn.php') ?>
</body>

</html>
