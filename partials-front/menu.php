<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Important to make title website responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza hut Website</title>
    <!--Linking our css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/aos.css">
</head>
<body>
    
    
    <!--Navigatio bar Starts here-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="images/logo4.png" alt="Pizza logo" class="img-responsive-logo" data-aos="fade-right">
            </div>
            <p class="text-center" style="color:#222f3e; font-size: 50px; font-family:Brush Script MT;" >Topping Masters Pizza House</p>
            
            <div class="menu text-right" >
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>category-page.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>menu-page.php">Menu</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!--Navigatio bar Ends here-->