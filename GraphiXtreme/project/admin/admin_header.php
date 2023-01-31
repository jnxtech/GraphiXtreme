<?php
$admin_id = $_SESSION['admin_id'];

$select_admin = $conn->query("SELECT * FROM users WHERE id = '$admin_id'");
$row_admin = $select_admin->fetch_array();
?>
<header class="header">

   <div class="flex">
      

      <a href="admin_page.php" class="logo">AdminPanel</a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_brand.php">Brand</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>

      </nav>

      <div class="icons">

         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $row_admin['name']; ?></span></p>
         <p>email : <span><?php echo $row_admin['email']; ?></span></p>
         <p>phone : <span><?php echo $row_admin['number']; ?></span></p>
         <p>address : <span><?php echo $row_admin['address']; ?></span></p>
         <a href="admin_editprofile.php" class="btn btn-warning">Edit</a>
         <a href="admin_logout.php" class="delete-btn">logout</a>

      </div>
   </div>
</header>