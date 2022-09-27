<?php 

  // include constants page
  include('../config/constants.php');

  if(isset($_GET['id']) && isset($_GET['image_name'])) // can use both AND or &&
    {
      // process to delete
      // echo "Process to delete";
      // 1. Get id and image name
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];

      // 2.REmove the image if available
      // Check whether the image is available and delte only if available
      if($image_name !="")
      {
        // Image is present and remove from folder
        // get the image path
        $path="../images/food/".$image_name;

        // remove image from folder
        $remove = unlink($path);

        // check whether remove is succesfull or not
        if($remove==false)
        {
          // failed to remove image
          $_SESSION['upload'] = "<div class='error'>Failed to remove image fike</div>";
          // redirect the page
          header('location:'.SITEURL.'admin/manage-food.php');
          // Stop the delete process
          die();
        }
      }

      // 3.Delete food from database

      $sql = "DELETE FROM tbl_food WHERE id=$id";
      // execute the query
      $res = mysqli_query($conn, $sql);
      // Check whether the query is executed or not
      // 4.redirect to manage-food with session message
      if($res==true)
      {
        // food deleted
        $_SESSION['delete'] = "<div class='success'>Food deleted successfult</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }

      
      else
      {
        // failed to delete
        $_SESSION['delete'] = "<div class='error'>Failed to delete Food</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }
      

      
    }
    else
    {
      // redirect to manage food page
      // echo "redirect";
      $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
      header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

<?php include('partial/footer.php'); ?>