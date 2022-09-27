<?php include('../config/constants.php') ?>


<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/owner.css">
    </head>
    

    <body class="bgimage">
    
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <?php 
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>


            <br><br>
            <!-- Login Form starts here -->
            <form action="" method="POST" class="text-center">
            <p class="style">Username:</p><br>
            <input type="text" name="username" placeholder="Enter Username" class="style"><br><br>
            <p class="style">Password:</p><br>
            <input type="password" name="password" placeholder="Enter Password" class="style" ><br><br>
            
            <input type="submit" name="submit" value="Login" class = "btn btn-primary"><br><br>
            </form>
            <!-- Login Form ends here -->

            <p class="text-center">Created by <a href="#">Abhishek</a></p>
        </div>
    </body>
</html>

<?php 

    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // procced for Login
        // 1. Get the data from Login Form
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        // 2. SQL to check whether the username and password exists or not
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute Query
        $res = mysqli_query($conn, $sql);

        // 4. count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // user availbale
            $_SESSION['login'] = "<div class = 'success'>Login success.</div> ";
            $_SESSION['user'] = $username;//To check whether the user is logedin or not and logout will nse it




            // Redirect to Manage-admin Page
            header('location:'.SITEURL.'admin/main.php' );
        }
        else
        {
            // User not available
            $_SESSION['login'] = "<div class = 'error text-center'>Username Or Password is Wrong.</div> ";
            // Redirect to Manage-admin Page
            header('location:'.SITEURL.'admin/login.php' );
        }
    }

?>