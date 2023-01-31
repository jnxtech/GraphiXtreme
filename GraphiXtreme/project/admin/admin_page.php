<?php

include '../include/connect.php';

session_start();


$admin_id = $_SESSION['admin_id'];
$select_admin = $conn->query("SELECT * FROM users WHERE id = '$admin_id'");
$row_admin = $select_admin->fetch_array();

if (!isset($admin_id)) {
   header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!--font-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!--css-->
   <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>





   <?php include 'admin_header.php'; ?>
   <section class="dashboard">
      <h1 class="title">dashboard</h1>


      <div class="box-container">


         <div class="box">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'wadmin'") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?> List</h3>
            <a href="admin_orders.php?st=wadmin" class="btn btn-warning">New Orders</a>
         </div>

         <div class="box">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'wdelivery'") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?> List</h3>
            <a href="admin_orders.php?st=wdelivery" class="btn btn-warning">In Delivery</a>
         </div>

         <div class="box">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'finish'") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?> List</h3>
            <a href="admin_orders.php?st=finish" class="btn btn-warning">Successfully Delivered</a>
         </div>

         <div class="box">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'rproduct'") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?>List</h3>
            <a href="admin_orders.php?st=rproduct" class="btn btn-warning">Return</a>
         </div>

         <div class="box">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE payment_status = 'rpd'") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?php echo $number_of_orders; ?> List</h3>
            <a href="admin_orders.php?st=rpd" class="btn btn-warning">Product Returned Successfully</a>
         </div>


         <div class="box">
            <?php
            $select_quantity = mysqli_query($conn, "SELECT SUM(quantity) as total_quantity FROM `products`");
            $row = mysqli_fetch_assoc($select_quantity);
            $total_quantity = $row['total_quantity'];
            ?>
            <h3><?php echo $total_quantity; ?> List</h3>
            <a href="admin_products.php?st=rproduct" class="btn btn-warning">Total Number Of Products</a>
         </div>




         <div class="box">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?> Person</h3>
            <a href="admin_users.php?st=user" class="btn btn-warning">User</a>
         </div>



         <div class="box">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $number_of_users; ?> Person</h3>
            <a href="admin_users.php?st=admin" class="btn btn-warning">Admin</a>
         </div>







         <div class="box">
            <?php
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
            ?>
            <h3><?php echo $number_of_account; ?> Person</h3>
            <a href="admin_users.php" class="btn btn-warning">All User</a>
         </div>


   </section>



   <script src="../js/admin_script.js"></script>

</body>

</html>