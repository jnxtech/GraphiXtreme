<?php

include 'include/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_POST['cart_quantity2'])) {
   $cart_id = $_POST['cart_id'];
   $product_id = $_POST['product_id'];

   $chk_qc = $conn->query("SELECT * FROM products WHERE product_id = '$product_id'");
   $row_chkqc = $chk_qc->fetch_array();
   if($row_chkqc['quantity'] >= $_POST['cart_quantity2']) {
      $update_cart = $conn->query("UPDATE cart SET quantity = '".$_POST['cart_quantity2']."' WHERE id = '$cart_id'");
      if($update_cart) {
         header('location:cart.php');
      }  
   } else {
      echo "<script>alert('จำนวนสินค้าไม่พอ!')</script>";
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- css  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'include/header.php'; ?>

   <div class="heading">
      <h3>shopping cart</h3>
      <p> <a href="home.php">home</a> / cart </p>
   </div>

   <section class="shopping-cart">

      <h1 class="title">products added</h1>

      <div class="box-container">
         <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT cart.*,products.product_id, products.product_name, products.price, products.image
         FROM `cart` INNER JOIN products 
         WHERE cart.user_id = '$user_id' AND cart.status = 'w' AND products.product_id = cart.product_id") or die('query failed');

         if (mysqli_num_rows($select_cart) > 0) {
           
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {


         ?>
               <div class="box">
                  <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
                  <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                  <div class="product_name"style="font-size: 20px;color:#2fbc2a;"><?php echo $fetch_cart['product_name']; ?></div>
                  <div class="product_id" style="font-size: 20px;color:#333;"><?php echo $fetch_cart['product_id']; ?></div>
                  <div class="price"><?php echo number_format($fetch_cart['price']); ?> THB</div>
                  <form action="" method="post">
                  
                     <input type="number" min="1" name="cart_quantity2" onchange="this.form.submit()" value="<?php echo $fetch_cart['quantity']; ?>">
                     <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">                   
                     <input type="hidden" name="product_id" value="<?php echo $fetch_cart['product_id']; ?>">                   
                     
                  </form>
                  <div class="sub-total"> sub total : <span><?php echo number_format($sub_total = ($fetch_cart['quantity'] * $fetch_cart['price'])); ?> THB</span> </div>
               </div>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
      </div>

      <div style="margin-top: 2rem; text-align:center;">
         <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
      </div>

      <div class="cart-total">
         <p>Total Price : <span><?php echo number_format($grand_total, 2); ?> THB</span></p>
         <div class="flex">
            <a href="shop.php" class="option-btn">continue shopping</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to payment</a>
         </div>
      </div>

   </section>







   <?php include 'include/footer.php'; ?>


   <!-- js  -->
   <script src="js/script.js"></script>

</body>

</html>