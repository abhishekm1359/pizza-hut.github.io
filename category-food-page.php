<?php include('partials-front/menu.php'); ?>
<?php

    // check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        // category id is set and get the id
        $category_id = $_GET['category_id'];
        // get category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        // execute query
        $res = mysqli_query($conn, $sql);

        // get the value from database
        $row = mysqli_fetch_assoc($res);

        // get the titlw
        $category_title = $row['title'];
    }
    else
    {
        // category not passes
        // redirect to main page
        header('location:'.SITEURL);
    }

?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!--Food Menu Starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center" >Menu</h2>

            <?php 
             
                // create sql query to get food based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";

                // execute query
                $res2 = mysqli_query($conn, $sql2);

                // count rows
                $count2 = mysqli_num_rows($res2);

                // check whether food is availbale
                if($count2>0)
                {
                    // food available
                    while($row2 = mysqli_fetch_assoc($res2))
                    {   
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                            <div class="food-menu-box " data-aos="zoom-in" >
                                <div class="food-menu-img">
                                    <?php 
                                    
                                        if($image_name == "")
                                        {
                                            // image not availbale
                                            echo "<div class = 'error'>Food not Available</div>";
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
                    //food not available
                    echo "<div class='error'>Food not available</div>";
                }
             
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--Food Menu Ends here-->

<?php include('partials-front/footer.php'); ?>