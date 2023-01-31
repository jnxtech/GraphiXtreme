<?php

include 'include/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      echo 'This product is already in your cart.!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      echo 'The product has been successfully added to the cart!';
   }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'include/header.php'; ?>

   <section class="home">

      <div class="content">

         <h3>Graphics Card Second Hand</h3>
         <p> welcome to GraphiXtreme </p>
         <a href="about.php" class="white-btn">discover more</a>
      </div>

   </section>





   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/w2.jpg" alt="">
         </div>

         <div class="content">
            <h3>about us</h3>
            <p>One-stop shop for computer graphics guarantee every piece according to customer usage requirements Warranty for every product, cheap graphics card center, really delivered
               Good quality computer graphics center Cheap price, must be GraphiXtreme only.</p>
            <a href="about.php" class="btn">read more</a>
         </div>
      </div>

   </section>








   <?php include 'include/footer.php'; ?>

   
   <script src="js/script.js"></script>

</body>

</html>