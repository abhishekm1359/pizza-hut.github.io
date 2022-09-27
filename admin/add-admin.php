<?php include('partial/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1> Add Admin </h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add'];  //displaying the session message 
                unset($_SESSION['add']); // Removing session message
            }
        ?>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php include('partial/footer.php');?>

<!-- for saving in database  -->
<?php 
    // Process the value from form and save in database

    // check wheather the button is clicked or not

    if(isset($_POST['submit']))
    {
        // button clicked
        // echo "button clicked";

        //1. get data fro form
        $full_name = $_POST ['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //encrypting password

        //2. sql query to save the data to database

        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username= '$username',
            password= '$password'
        ";

        //3. executing query and saving data in database  
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Check wheather the data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            // data inserted
            //echo "data inserted";
            // creating session variable to display message
            $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
            // redirecting page to manage admin page
            header("location:".SITEURL. 'admin/manage-admin.php');
        }
        else
        {
            // data not inserted
            //echo "data not inserted";
            $_SESSION['add']="Failed to Add Admin";
            // redirecting page to manage admin page
            header("location:".SITEURL. 'admin/add-admin.php');
        }
    }
    

?>