<?php

include 'include/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- css   -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'include/header.php'; ?>

   <div class="heading">
      <h3>your orders</h3>
      <p> <a href="home.php">home</a> / orders </p>
   </div>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($order_query) > 0) {
            
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
         ?>
               <div class="box">
                  <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                  <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                  <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                  <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                  <p> product name : <span><?php echo $fetch_orders['product_name']; ?></span> </p>
                  <p> total quantity : <span><?php echo $fetch_orders['total_quantity']; ?> Item</span> </p>
                  <p> payment method : <span>Cash On Delivery</span> </p>
                  <p> total price : <span><?php echo number_format($fetch_orders['total_price'], 2); ?> THB</span> </p>
                  <p> Shipment Date : <span><?php echo $fetch_orders['shipment_date']; ?></span> </p>
                  <p> Received Date : <span><?php echo $fetch_orders['received_date']; ?></span> </p>
                  <p> payment status :
                     <span style="color:<?php if ($fetch_orders['payment_status'] == 'wadmin') {
                                             echo 'red';
                                          } else {
                                             echo 'green';
                                          } ?>;">
                        <?php 
                           if($fetch_orders['payment_status'] == "wadmin") {
                              echo "Waiting For Admin To Check";
                           } elseif($fetch_orders['payment_status'] == "wdelivery") {
                              echo "The Product Is Deing Delivered";
                           } elseif($fetch_orders['payment_status'] == "finish") {
                              echo "The Product Has Been Shipped";
                           } elseif ($fetch_orders['payment_status'] == "rproduct") {
                              echo "Return Product";
                           } elseif ($fetch_orders['payment_status'] == "rpd") {
                              echo "Product Returned Successfully";
                           }
                        ?>
                     </span>
                  </p>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>






   <?php include 'include/footer.php'; ?>



   <!--   js   -->
   <script src="js/script.js"></script>

</body>

</html>