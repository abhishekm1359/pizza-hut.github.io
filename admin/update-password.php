<?php include('partial/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class = "tbl-30">
                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name = "current_password" placeholder="current pasword">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password"placeholder="new password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password"     placeholder="confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>


<?php 

            // check wheather the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // echo "clicked";

                // 1. Get the data from from
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);

                // 2. Check whether the user with current ID and current password exists or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
               
                // execute the query
                $res = mysqli_query($conn, $sql);
                
                if($res==true)
                {
                    // check whether data is availbale or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        // user exists and password can be changed
                        // echo "User Found";
                        // chech wheather the new password and confirm password match or not
                        if($new_password == $confirm_password)
                        {
                            // update the password
                            $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                            ";

                            // Execute the query
                            $res2 = mysqli_query($conn, $sql2);
                        

                            // check whether query is executed or not
                            if($res2==true)
                            {
                                // display success message
                                // redirect to manage admin page with success message
                                $_SESSION['change-pwd'] = "<div class= 'success'>Password changed successfully. </div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                // display error message
                                // redirect to manage admin page with failed message
                                $_SESSION['change-pwd'] = "<div class= 'error'>Failed to change Password. </div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            
                            }
                        } 
                        else
                        {
                            // redirect to manage admin page with error
                            $_SESSION['pwd-not-match'] = "<div class= 'error'>pwd did not match. </div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        // User does not exists set message and redirect
                        $_SESSION['user-not-found'] = "<div class= 'error'>User Not Found. </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                // 3. Check whether the new password and confirm password match or not

                // 4. Change Password if all above is true 
            }

?>

<?php include('partial/footer.php');?>