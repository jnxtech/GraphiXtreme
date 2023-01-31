<?php

include 'include/connect.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' AND user_id = '$user_id'AND status = 'w'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      echo "no product!";
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, product_id, product_name, quantity, status) VALUES('$user_id', '$product_id' , '$product_name' ,'$product_quantity', 'w')") or die('query failed');
      echo 'product added to cart!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'include/header.php'; ?>

   <div class="heading">
      <h3>our shop</h3>
      <p> <a href="home.php">home</a> / shop </p>
   </div>

   <section class="products">

      <h1 class="title">products</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               $select_brand = mysqli_query($conn, "SELECT name FROM `brand` WHERE brand_id = '" . $fetch_products['brand_id'] . "'");
               $row = mysqli_fetch_assoc($select_brand);
               $brand_name = $row['name'];
         ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="product_name"style="font-size: 20px;color:#333;"><?php echo $fetch_products['product_name']; ?></div>
                  <div class="product_id" style="font-size: 20px;color:#2fbc2a;"><?php echo $fetch_products['product_id']; ?></div>
                  <div class="price"><?php echo number_format($fetch_products['price']); ?> THB</div>
                  <div class="quantity"style="font-size: 20px;color:#c0392b;"><?php echo $fetch_products['quantity']; ?> item</div>
                  <div class="brand"><?php echo 'brand  ' . $brand_name; ?><div>

                        <input type="number" min="1" max="<?= $fetch_products['quantity']; ?>" name="product_quantity" class="qty" required>
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['product_id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['product_name']; ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </form>

         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>


   </section>









   <?php include 'include/footer.php'; ?>


  
   <script src="js/script.js"></script>

</body>

</html>