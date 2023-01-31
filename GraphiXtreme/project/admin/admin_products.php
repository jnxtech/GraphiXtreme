<?php
include '../include/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};


if (isset($_POST['add_product'])) {


   
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $price = $_POST['price'];
   $product_id = $_POST['product_id'];
   $quantity = $_POST['quantity'];
   $brand = $_POST['brand_id'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   
   $image_tmp_name = $_FILES['image']['tmp_name'];
   
   $image_folder = '../uploaded_img/' . $image;




   
   $select_product_name = mysqli_query($conn, "SELECT product_name FROM `products` WHERE product_name = '$product_name'") or die('query failed');

  
   if (mysqli_num_rows($select_product_name) > 0) {
      echo 'product_name already added';
   } else {
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(product_name, product_id, price, quantity, brand_id, image) VALUES('$product_name','$product_id', '$price','$quantity','$brand', '$image')") or die('query failed');

      if ($add_product_query) {
         if ($image_size > 2000000) {
            echo 'รูปมีขนาดใหญ่เกินไป';
         } else {
         
            move_uploaded_file($image_tmp_name, $image_folder);
            echo 'เพิ่มสินค้าเรียบร้อย';
         }
      } else {
         echo 'เพิ่มสินค้าไม่ได้!';
      }
   }
}





if (isset($_GET['delete'])) {
   
   $delete_id = $_GET['delete'];


   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');

   header('location:admin_products.php');
}








if (isset($_POST['update_product'])) {
   
   $update_p_id = $_POST['update_p_id'];
   $update_product_name = $_POST['update_name'];
   $update_product_id = $_POST['update_product_id'];
   $update_price = $_POST['update_price'];
   $update_quantity = $_POST['update_quantity'];
   $update_brand = $_POST['update_brand'];

   mysqli_query($conn, "UPDATE `products` SET product_name = '$update_product_name',product_id = '$update_product_id',price = '$update_price',quantity = '$update_quantity',brand_id = '$update_brand' WHERE id = '$update_p_id'") or die('query failed');

   header('location:admin_products.php');
}

?>








<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- css -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>


   <?php include 'admin_header.php'; ?>





   <section class="add-products">

      <h1 class="title">products</h1>



      <form action="" method="post" enctype="multipart/form-data">
         <h3>add product</h3>
         <input type="text" name="product_name" class="box" placeholder="enter product name" required>
         <input type="number" min="0" name="product_id" class="box" placeholder="enter product id" required>
         <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
         <input type="number" min="0" name="quantity" class="box" placeholder="enter product quantity" required>
         <select name="brand_id" class="box" required>
            <option value="">Select brand</option>
            <?php
            $select_brands = mysqli_query($conn, "SELECT brand_id, name FROM `brand`");
            while ($row = mysqli_fetch_assoc($select_brands)) {
            ?>
               <option value="<?php echo $row['brand_id']; ?>"><?php echo $row['name']; ?></option>

            <?php
            }
            ?>
         </select>
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>

         <input type="submit" value="add product" name="add_product" class="btn">

      </form>






   </section>







   <section class="show-products">

      <div class="box-container">



         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               
               $select_brand = mysqli_query($conn, "SELECT name FROM `brand` WHERE brand_id = '" . $fetch_products['brand_id'] . "'");
               
               $row = mysqli_fetch_assoc($select_brand);
              
               $brand_name = $row['name'];

         ?>
               <div class="box">
                  <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="product_name" style="font-size: 20px;color:#2fbc2a;"><?php echo $fetch_products['product_name']; ?></div>
                  <div class="product_id" style="font-size: 20px;color:#2fbc2a;"><?php echo 'id  ' . $fetch_products['product_id']; ?></div>
                  <div class="price"><?php echo number_format($fetch_products['price']); ?> THB</div>
                  <div class="quantity" style="font-size: 20px;color:#2fbc2a"><?php echo $fetch_products['quantity']; ?> Item</div>
                  <div class="brand"><?php echo 'brand  ' . $brand_name; ?><div>
                        <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
                     </div>
               <?php
            }
         } else {
            echo 'ยังไม่มีสินค้า';
         }
               ?>
                  </div>
   </section>









   <section class="edit-product-form">



      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
           
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>

               <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                  <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                  <input type="text" name="update_name" value="<?php echo $fetch_update['product_name']; ?>" class="box" required placeholder="enter product name">
                  <input type="number" name="update_product_id" value="<?php echo $fetch_update['product_id']; ?>" min="0" class="box" required placeholder="enter product id">
                  <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
                  <input type="number" name="update_quantity" value="<?php echo $fetch_update['quantity']; ?>" min="0" class="box" required placeholder="enter product quantity">
                  <input type="hidden" name="update_brand" value="<?php echo $fetch_update['brand_id']; ?>">
                  <select name="update_brand" class="box" required>
                     <option value="">Select brand</option>
                     <?php
                     $select_brands = mysqli_query($conn, "SELECT brand_id, name FROM `brand`");
                     while ($row = mysqli_fetch_assoc($select_brands)) {
                     ?>
                        <option value="<?php echo $row['brand_id']; ?>"><?php echo $row['name']; ?></option>

                     <?php
                     }
                     ?>
                  </select>



                  <input type="submit" value="update" name="update_product" class="btn">
                  <input type="reset" value="cancel" id="close-update" class="option-btn">
               </form>
      <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>

   </section>









   <!-- js -->
   <script src="../js/admin_script.js"></script>

</body>

</html>