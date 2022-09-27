<?php 
ob_start();
?>
<?php include('partials-front/menu.php') ?>

    <?php 
        // check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            // get food id and details of selected food
            $food_id = $_GET['food_id'];

            // get the details
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            // execute query
            $res = mysqli_query($conn, $sql);
            // count rows
            $count = mysqli_num_rows($res);
            // check whether data is available
            if($count==1)
            {
                // we have data
                // get the data from database
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                // Food not available
                // redirect to home page
                header('location:'.SITEURL);
            }

        }
        else
        {
            // redirect to homepage
            header('location:'.SITEURL);
        }
    
    ?>
    
    <!-- Order Section Starts Here -->
    <section class = "order-background">
        <div class="container">

            
            
            <h2 class="text-center text-white" style="font-size: 35px;">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order" >
                <fieldset>
                    <legend style="color: white;">Selected Food</legend>

                    <div class="food-menu-img food-menu-box">
                        <?php
                            // check whether the image is availbalr or not
                            if($image_name == "")
                            {
                                // image not availble
                                echo "<div class='error'>Image not Available</div>";
                            }
                            else
                            {
                                // image is availbale
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve" width="100px" height = "100px">
                                <?php
                            }
                        
                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                <br>
                <br>
                
                <fieldset>
                    
                    <legend>Delivery Details</legend>
                    <div class="order-label ">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Abhishek" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8846xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
                // check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // get all the details
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa");  //order date
                    $status = "Ordered"; //ordered, ondelivery, delivered
                    $customer_name = $_POST['full_name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    // save the order in database
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                        // echo $sql2;die();

                        // execute query
                        $res2 = mysqli_query($conn, $sql2);

                        // check whether query executed or not
                        if($res2==true)
                        {
                            //Query executed and order saved
                            $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
                            header('location:'.SITEURL);
                        }
                        else
                        {
                            // failed to order food
                            $_SESSION['order'] = "<div class='error text-center'>Food Ordered Successfully</div>";
                            header('location:'.SITEURL);
                            ob_enf_fluch();
                        }

                    

                }
            
            
            
            
            ?>


        </div>
    </section>
    <!-- Order Section Ends Here -->


<?php include('partials-front/footer.php'); ?>