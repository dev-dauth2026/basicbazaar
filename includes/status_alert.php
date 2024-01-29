<?php

global $action_status;
global $status_message;
global $action_category;

if(isset($_GET['action_category'])){
    $action_category = $_GET['action_category'];
}


if(isset($_GET["add_message_status"]) && $_GET['add_message_status']== 'success') {
    $action_status ='success';
    $status_message = "The '$action_category' has been added successfully.";
    }

if(isset($_GET["add_message_status"]) && $_GET['add_message_status']== 'failed') {
    $action_status ='failed';
    $status_message = "There is something wrong while adding the $action_category.";
    }

if(isset($_GET["add_message_status"]) && $_GET['add_message_status']== 'empty') {
    $action_status ='failed';
    $status_message = "Please add a new '$action_category'" ;
    }

if(isset($_GET["add_message_status"]) && $_GET['add_message_status']== 'exists') {
    $action_status ='failed';
    $status_message = "Please add a new '$action_category'" ;
    }

if(isset($_GET["update_status"]) && $_GET['update_status']== 'success') {
    $action_status ='success';
    $status_message = "The '$action_category' has been updated successfully.";
}

if(isset($_GET["delete_status"]) && $_GET['delete_status']== 'success') {
    $action_status ='success';
    $status_message = "The '$action_category' has been deleted successfully.";
    }

function ActionMessage() {
    global $action_status;
    global $status_message;
    if($status_message !== '' ){
        if($action_status == 'success'){
            echo "<span id='statusMessage' class='py-2 px-3 text-emphasis-success bg-success-subtle rounded mb-3 fade-transition'>
            $status_message
          </span>";
        }
        if($action_status == 'failed'){
            echo "<span id='statusMessage' class='py-2 px-3 text-emphasis-danger bg-danger-subtle rounded mb-3 fade-transition'>
            $status_message
          </span>";
        }

        echo "<script>
        setTimeout(function() {
            var statusMessage = document.getElementById('statusMessage');
            statusMessage.style.display = 'none';
        }, 2000); 
        </script>";
      }
    }

?>
