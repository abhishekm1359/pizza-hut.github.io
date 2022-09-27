<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 

            // check whether the id is set or not
            if(isset($_GET['id']))
            {
                // get id and all details
                $id = $_GET['id'];

                // crete sql id to get all details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // Execute the query
                $res = mysqli_query($conn,$sql);

                // count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // get all data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active']; 
                }
                else
                {
                    // redirect to manage categoey page with message'
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            } 
        
        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>" >
                    </td>
                </tr>

                <tr>
                    <td>Current Image : </td>
                    <td>
                        <?php

                            if($current_image !="")
                            {
                                // Display the image
                                ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?> "  width="100px" >
                                <?php 
                            }
                            else
                            {
                                // display message
                                echo "<div class='error'>Image not added</div>";
                            }
                        
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>

                <tr>
                    <td>Featured : </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active : </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn btn-secondary">
                    </td>
                </tr>
            

            </table>
        </form>

        <?php 
        
            // check if submit is pressed
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // 1. Get all the values from form

                $id = $_POST['id'];
                $title=$_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. Updating new image if selected
                // check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    // get the image details
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is availbale are not
                    if($image_name !="")
                    {
                        // image available
                        // A. upload the new image


                        // Auto Rename our image
                            // get the extension of our image(jpg, png etc)
                            $ext = end(explode('.',$image_name));

                            // Rename the image
                            $image_name="Food_Category_".rand(000, 999).'.'.$ext;
                            

                            $source_path=$_FILES['image']['tmp_name'];

                            $destination_path="../images/category/".$image_name;

                            // finally upload the image
                            $upload = move_uploaded_file($source_path , $destination_path);

                            // check whether the image is uploaded or not
                            // and if image is not uploded then we will stop process and redirect with error message
                            if($upload==false)
                            {
                                // Set Message 
                                $_SESSION['upload'] = "<div class='error'>Failed to upload Image.<div>";
                                // redirect to add category page
                                header('location:'.SITEURL.'admin/manage-category.php');
                                // Stop Process
                                die();
                            }



                        //B.  Remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            // Check whether the image is removed or not
                            // if fialed to remove then display message and stop process
                            if($remove==false)
                            {
                                // failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-ategory.php');
                            }
                        }
                                           


                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // 3. Update to database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name='$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                // Execute the query
                $res2= mysqli_query($conn, $sql2);

                // 4. Redirect to manage category page
                // Check wether query executed or not
                if($res2==true)
                {
                    // category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // failed to update category
                    $_SESSION['update'] = "<div class='error'> Failed to update Category</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }


            }
        
        
        ?>
    </div>
</div>


<?php include('partial/footer.php')?>;