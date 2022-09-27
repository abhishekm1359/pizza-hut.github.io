<?php 
    // Include constant.php file here
    include('../config/constants.php');
    include('../css/owner.css');
    // 1. Get the ID of Admin to be deleted
    $id = $_GET['id'];

    // 2. Create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Exwcute the query
    $res= mysqli_query($conn, $sql);

    // Chech where query executed succesfully or not
    if($res==true)
    {
        // Query executed successfully and admin deleted
        // echo "Admin Deleted";
        // create session variable to display message
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>";
        // redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // failed to delete admin
        // echo "Failed to delete admin";

        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // 3. Redirect to manage admin page with message (success/error)


?>