<?php include('partials-front/menu.php'); ?>



    <!--Categories Starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center" >Explore Food</h2>

            <?php
                // display all category that are active
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                $res = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($res);

                // check whether category available
                if($count>0)
                {
                    // category available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>

                            <a href="<?php echo SITEURL; ?>category-food-page.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                <?php 
                                    if($image_name =="")
                                    {
                                        // image not available
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        // image Available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" alt="pizza image" class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?> 
                                    
                            
                                    <h3  class="float-text float-text-img"> <?php echo $title; ?></h3>
                                </div>
                            </a> 

                        <?php

                    }
                }
                else
                {
                    // category not available
                    echo "<div class='error'>Category Not Found</div>";
                }
            
            ?>

               
            
             
            
            
            
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!--Categories Ends here-->

<?php include('partials-front/footer.php'); ?>