<?php
$select_user = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
$row_user = $select_user->fetch_array();
?>

<header class="header">
   <?php if (!isset($_SESSION['user_id']) and !isset($_SESSION['admin_id'])) { ?>
      <div class="header-1">
         <div class="flex">
            <div class="share">
            </div>
            <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
         </div>
      </div>
   <?php } ?>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">GraphiXtreme</a>

         <nav class="navbar">
            <a href="home.php" <?= basename($_SERVER['PHP_SELF']) == "home.php" ? "style='color: #2fbc2a;'" : ""; ?>>home</a>
            <a href="about.php" <?= basename($_SERVER['PHP_SELF']) == "about.php" ? "style='color: #2fbc2a;'" : ""; ?>>about</a>
            <a href="shop.php" <?= basename($_SERVER['PHP_SELF']) == "shop.php" ? "style='color: #2fbc2a;'" : ""; ?>>shop</a>
            <a href="nvidia.php" <?= basename($_SERVER['PHP_SELF']) == "nvidia.php" ? "style='color: #2fbc2a;'" : ""; ?>>nvidia</a>
            <a href="amd.php" <?= basename($_SERVER['PHP_SELF']) == "amd.php" ? "style='color: #2fbc2a;'" : ""; ?>>amd</a>
            <a href="orders.php" <?= basename($_SERVER['PHP_SELF']) == "orders.php" ? "style='color: #2fbc2a;'" : ""; ?>>orders</a>
         </nav>


         <div class="icons">


          
 
            <div id="user-btn" class="iuser fas fa-user"></div>
            <?php
            $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE status = 'w' AND user_id = '$user_id'") or die('query failed');
            $cart_rows_number = mysqli_num_rows($select_cart_number);
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i>(<?php echo $cart_rows_number; ?>)</a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $row_user['name']; ?></span></p>
            <p>email : <span><?php echo $row_user['email']; ?></span></p>
            <p>phone : <span><?php echo $row_user['number']; ?></span></p>
            <p>address : <span><?php echo $row_user['address']; ?></span></p>
            <a href="user_editprofile.php" class="btn btn-warning">Edit</a>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>