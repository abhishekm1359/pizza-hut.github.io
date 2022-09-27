<?php include('partial/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="title of food">
                    </td>
                                       
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="decsription of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php 
                                // create php to display category from database
                                // 1. Create sql to get all active category from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // execute the sql query
                                $res=mysqli_query($conn, $sql);

                                // Count the rows to check whether we have category or not
                                $count=mysqli_num_rows($res);

                                // if count is greter than 0 we have category else we do not have category
                                if($count>0)
                                {
                                    // we have category
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // get the details of category
                                        $id = $row['id'];
                                        $title=$row['title'];
                                        ?>
                                             <option value="<?php echo $id;?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    // we do not have category
                                    ?>
                                        <option value="0">No Category Found</option>
                                    <?php
                                }
                                //2. display on drop down
                            
                            ?>


                            
                        </select>
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
                        <input type="submit" name="submit" value="Add food" class="btn btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
        
            // check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                // Add the food in databse
                // echo "clicked";
                // 1. get the data from form 
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                // Check whether radio button for featured and active
                if(isset($_POST['featured']))
                {
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";//setting default value
                }

                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";//setting default value
                }

               

                // 2. upload the image if selected
                // check whether the select image is clicked or not and upload only if image is selcted
                if(isset($_FILES['image']['name']))
                {
                    // get the details of selected image 
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is selected or not
                    if($image_name!="")
                    {
                        // image is selcted
                        // A. Rename the image
                        // get the extension of the selected image like jpg,png etc
                        $ext = end(explode('.',$image_name));

                        // create new name for image
                        $image_name= "Food-Name-".rand(000,999).".".$ext; //New image name like Food-Name-776.jpg

                        // B. Upload the image
                        // get the source path and destination path

                        // Source path is current location of the image 
                        $src = $_FILES['image']['tmp_name'];

                        // destination path for image to be uploded
                        $dst = "../images/food/".$image_name;

                        // finally rpload the image
                        $upload = move_uploaded_file($src, $dst);

                        // check whether image uploaded or not
                        if($upload==false)
                        {
                            // failed to upload image
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            // redirect to add food page
                            header('location:'.SITEURL.'admin/add-food.php');
                            // stop the sessoion
                            die();
                        }
                    }
                }
                else
                {
                     $image_name="";//setting default to blank
                }

                // 3. Insert into database
                
                // create a sql query to add data to database
                $sql2="INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price, 
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'

                ";

                // execute the query
                $res2=mysqli_query($conn, $sql2);

                // check whether the data is inserted or not

                if($res2==true)
                {
                    // data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to add Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                // redirect with message to manage food page
            }
        
        ?>

    </div>
</div>



<?php include('partial/footer.php');?>