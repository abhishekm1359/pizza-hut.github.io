<?php include('partials-front/menu.php'); ?>

   
    <!--Food Search Starts here-->
    <section class="food-search text-center">
        <div class="container" data-aos="fade-up">

            <form action="food-search-page.html" method="POST">
                <input type="search" name="search" placeholder="Search for food.." required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
            
        </div>
    </section>
    <!--Food Search Ends here-->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
    
   
    <!--Categories Starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center" data-aos="fade-up" data-aos-duration="1000">Explore Food</h2>

            <?php 

                // create query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";
                // execute query
                $res = mysqli_query($conn, $sql);
                // count rows to check whether category is available or not
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    // category available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get the values title, image_name, id
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-food-page.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <!-- check whether image is availale or not -->
                                    <?php 
                                        if($image_name=="")
                                        {
                                            // display message
                                            echo "<div class = 'error'>Image not available</div>";
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
                    echo "<div class = 'error'>Category Not Added</div>";
                }
            
            
            ?>
               
            
             
            <div class="clearfix"></div>
        </div>
    </section>
    <!--Categories Ends here-->

  
    <!--Food Menu Starts here-->
    <section class="food-menu">
        <div class="container">
             <h2 class="text-center" data-aos="fade-up">Today's Menu</h2>

            <?php 
             
                //  getting foods from database that are active and features
                // sql query
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured = 'Yes' LIMIT 6";

                // execute query
                $res2 = mysqli_query($conn, $sql2);

                // count rows
                $count2 = mysqli_num_rows($res2);

                // check whether food available or not
                if($count2>0)
                {
                    // food available
                    while($row = mysqli_fetch_assoc($res2))
                    {
                        // get all values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>
                            <div class="food-menu-box" data-aos="zoom-in">
                                <div class="food-menu-img">

                                    <?php 
                                        // check whether image available or not
                                        if($image_name == "")
                                        {
                                            // image not availabel
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                        else
                                        {
                                            // image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" alt="pizz image" class="img-responsive img-curve" width="100px" height="100px"> 
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
                echo "<div class='error'>Food Not Available</div>";
                }
            ?>

                

            <div class="clearfix"></div>
        </div>
    </section>
    <!--Food Menu Ends here-->

    <!-- pop section starts here -->
    <div class="popup">
        <div class="contentbox">
            <div class="close"></div>
            <div class="imgbx">
                <img src="images/getvaccine1.png">
            </div>
            <div class="content">
                <div>
                    <h2> Get Vaccinated </h2>
                    <h3> Get Covid19 Vaccine and wear mask when you are outside and maintain social distance from one another.</h3>   
                </div>
            </div>

        </div>
    </div>

    <!-- automatic show popup after 2 seconds -->
    <script>
        const popup = document.querySelector('.popup');
        const close = document.querySelector('.close');

        window.onload = function(){
            setTimeout(function(){
                popup.style.display = "block";
                // add time delay
            },2000)
        }

        close.addEventListener('click', () => {
            popup.style.display = "none";
        } )

    </script>





    <!-- pop section ends here -->

   
<?php include('partials-front/footer.php'); ?>