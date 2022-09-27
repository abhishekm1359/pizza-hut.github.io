<?php 
ob_start();
?>


<?php include('partial/menu.php');?>

<!-- Main Content Starts -->
<div class="main-content">
          <div class="wrapper-order">
                <h1>Manage Order</h1>

                <br><br>

                <?php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <?php
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                ?>  
                <br><br>
    
                <!-- button to add admin -->

                
                <table class="tbl-full">
                    <tr >
                        <th> Sl.No</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    
                        // get all the details from database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC" ;
                        // Execute query
                        $res = mysqli_query($conn, $sql);
                        // count number of rows
                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        // check data is available
                        if($count>0)
                        {
                            // data available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // Get all the order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>

                                    <tr class = "small">
                                    
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php 
                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color:orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color:green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color:red;'>$status</label>";
                                                }
                                            
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update Order</a>
                                            
                                        </td>
                                        
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            // data not available
                            echo "<tr><td colspan='12' class = 'error'> Order not available </td></tr>";
                        }
                    
                    ?>

                    

                   

                </table>


            </div>
</div>
<!-- Main Content Ends -->
<div class="main-content, wrapper , text-center">
    <form action="" method="POST" class="order" >
        <input type="submit" name="Delete" value="Delete All" class="btn btn-danger">
    </form>
</div>
<?php

    // check whether delete button is clicked or not
    if(isset($_POST['Delete']))
    {
        // echo "pressed";
        $sql2 = "DELETE FROM tbl_order";
        // execute query
        $res2 = mysqli_query($conn, $sql2);

        if($res2 == TRUE)
        {
            //Query executed and updated
            $_SESSION['delete'] = "<div class='success'>Order deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        else
        {
            // failed to update
            $_SESSION['delete'] = "<div class='error'>Order delete failed</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
            ob_enf_fluch();
            
        }


    }

?>



<?php include('partial/footer.php');?>