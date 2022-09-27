<?php 

    // Include constant folder
    include('../config/constants.php');

    // echo "Delete PAge";
    // check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        // Get the value and delete
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        // REmove the physical image file if available
        if($image_name !="")
        {
            // image is availbale. so remove it
            $path = "../images/category/".$image_name;

            // Remove the image
            $remove = unlink($path);

            // if failed to remove then add error message and stop process
            if($remove==false)
            {
                // set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category</div>";
                //  redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the process
                die();
            }
        }

        // Delete data from database 
        // query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the data deleted from database or not
        if($res==true)
        {
            // Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // set failed message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // redirect to manage category page with message
    }
    else
    {
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>