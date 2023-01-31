<?php

include 'include/connect.php';

session_start();

$user_id = $_SESSION['user_id'];
$select_user = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
$row_user = mysqli_fetch_array($select_user);

if (!isset($user_id)) {
   header('location:login.php');
}



if (isset($_POST['btn_firmorder'])) {
   $user_id = $_SESSION['user_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $payment = mysqli_real_escape_string($conn, $_POST['payment']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $placed_on = date('d/m/Y H:i:s');
   $total_price = 0;
   $total_quantity = 0;

   $select_cart = $conn->query("SELECT * FROM cart WHERE user_id = '$user_id'");
   while($row_cart = $select_cart->fetch_array()) {
      $total_quantity += $row_cart['quantity']; 
      $product_name .= $row_cart['product_name'] . ' | ' . $row_cart['quantity'] . ' Item '  . ' | ';

      $select_pd = $conn->query("SELECT * FROM products WHERE product_id = '".$row_cart['product_id']."'");
      while($row_pd = $select_pd->fetch_array()) {
       $total_price += $row_pd['price'] * $row_cart['quantity'];
      }

      $update_pd = $conn->query("UPDATE products SET quantity = quantity-'".$row_cart['quantity']."' WHERE product_id = '".$row_cart['product_id']."'");
    
   }

   $insert_order = $conn->query("INSERT INTO orders (user_id, name, number, email, payment, address, product_name, total_quantity, total_price, placed_on, payment_status)
   VALUES('$user_id','$name','$number','$email','$payment','$address','$product_name','$total_quantity','$total_price','$placed_on', 'wadmin')");
   if($insert_order) {
      $delete_cart = $conn->query("DELETE FROM cart WHERE user_id = '$user_id'");
      if($delete_cart) {
        echo "<script>alert('Completed Order ✅');window.location.href= 'home.php';</script>"; 
      }
   }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!--font-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!--css-->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'include/header.php'; ?>

   <div class="heading">
      <h3>checkout</h3>
      <p> <a href="home.php">home</a> / checkout </p>
   </div>

   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT cart.*, products.product_name, products.price, products.image
      FROM `cart` INNER JOIN products 
      WHERE cart.user_id = '$user_id' AND products.product_id = cart.product_id") or die('query failed');
      if (mysqli_num_rows($select_cart) > 0) {
       
         while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total += $total_price;
      ?>
            <p> <?php echo $fetch_cart['product_name']; ?> <span>(<?php echo number_format($fetch_cart['price']) . 'THB' . '/-' . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
      <div class="grand-total"> grand total : <span><?php echo number_format($grand_total, 2); ?>THB</span> </div>
   </section>





   <section class="checkout">

      <form action="" method="post">
         <h3>place your order</h3>
         <div class="flex">
            <div class="inputBox">
               <span>your name :</span>
               <input type="text" name="name" value="<?= $row_user['name'] ?>" required>
            </div>
            <div class="inputBox">
               <span>your number :</span>
               <input type="number" name="number" value="<?= $row_user['number'] ?>" required>
            </div>
            <div class="inputBox">
               <span>your email :</span>
               <input type="email" name="email" value="<?= $row_user['email'] ?>" required>
            </div>
            <div class="inputBox">
               <span>your address :</span>
               <input type="textr" name="address" value="<?= $row_user['address'] ?>" required>
            </div>
            <div class="inputBox">
               <span>payment method :</span>
               <select name="payment">
                  <option value="athome">Cash On Delivery</option>
               </select>
            </div>
         </div>
      
         <input type="submit" value="order now" class="btn" name="btn_firmorder">
      </form>
   </section>


   <!-- js   -->
   <script src="js/script.js"></script>

</body>

</html>