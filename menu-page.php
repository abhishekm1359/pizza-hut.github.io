<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search-page.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!--Food Menu Starts here-->
    <section class="food-menu">
        <div class="container">
             <h2 class="text-center">All Menu</h2>

            <?php 
             
                // display food which are active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                // execute the query
                $res = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($res);

                //check whether food available
                if($count>0)
                {
                    // food availbale
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        ?>
                            <div class="food-menu-box " data-aos="zoom-in">
                                <div class="food-menu-img">
                                    <?php 
                                        // check whether image is available
                                        if($image_name=="")
                                        {
                                            // image not available
                                            echo "<div class='error'>Image not found</div>";
                                        }
                                        else
                                        {
                                            // image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="pizz image" class="img-responsive img-curve" width="100px" height="100px">
                                            <?php
                                        }
                                    

                                    ?>
                                     
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-details"><?php echo $description; ?></p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order-page.php?food_id=<?php echo $id; ?>" class="btn btn-primary"> Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    // food not available
                    echo "<div class='error'>Food not Found</div>";
                }
             
            ?>

            

            <div class="clearfix"></div>

        </div>
    </section>
    <!--Food Menu Ends here-->
    <?php include('partials-front/footer.php'); ?>