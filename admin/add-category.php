<?php include('partial/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>
            <?php 
                
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            
            ?>

            <br><br>

            <!-- Add Category Page Starts -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn btn-secondary">
                        </td>
                    </tr>

                </table>


            </form>
            <!-- Add Category Page Ends -->

            <?php

                // check whether the submit button is pressed
                if(isset($_POST['submit']))
                {
                    // Clicked
                    // echo "clicked";

                    // 1. Get the value from Category form
                    $title=$_POST['title'];
                    
                    // For Radio input tag we need to check whether the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        // Get the value from form
                        $featured=$_POST['featured'];

                    }
                    else
                    {
                        // Set the default value
                        $featured="No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active=$_POST['active'];
                    }
                    else
                    {
                        $active="No";
                    }

                    // Chech whether the image is selected or not and set the image name accordingly
                    // print_r($_FILES['image']);

                    // die();//Break the code here

                    if(isset($_FILES['image']['name']))
                    {
                        // Upload the image
                        // to upload the image we need image name, source name and destination path
                        $image_name=$_FILES['image']['name'];

                        // upload image only if image is selected
                        if($image_name !="")
                        {

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
                                header('location:'.SITEURL.'admin/add-category.php');
                                // Stop Process
                                die();
                            }
                        }
                    }
                    else
                    {
                        // Don't upload the image and set the image name value as blank
                        $image_name="";
                    }



                    // 2. SQL query to insert the category to table
                    $sql="INSERT INTO tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                    ";


                    // 3. Execute the query and save in database
                    $res=mysqli_query($conn, $sql);

                    // 4. Check whether the query is executed or not
                    if($res==true)
                    {
                        // Query executed
                        $_SESSION['add']="<div class='success'> Category Added Successfully.</div>";
                        // Redirect to manage category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        // Failed to add category
                        $_SESSION['add']="<div class='error'> Failed to add Category.</div>";
                        // Redirect to manage category page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
                
            
            ?>


        </div>
    </div>



<?php include('partial/footer.php'); ?>