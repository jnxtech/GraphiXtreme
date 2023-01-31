<?php
include '../include/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};


if(isset($_POST['add_brand'])){


   $name = mysqli_real_escape_string($conn, $_POST['name']);
   

   $select_product_brand_name = mysqli_query($conn, "SELECT name FROM `brand` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_brand_name) > 0){
      echo 'Already Have This Brand';
   }else{
      $add_brand_query = mysqli_query($conn, "INSERT INTO `brand`(name) VALUES('$name')") or die('query failed');

      
         echo'Brand Has Been Added!';
      }
   
}



if(isset($_GET['delete'])){
//ตัวแปร $delete_id ถูกตั้งค่าเป็นค่าของพารามิเตอร์delete  ค่านี้จะเป็น ID ของผลิตภัณฑ์ที่จะลบในฐานข้อมูล
$delete_id = $_GET['delete'];

//เรียกใช้SQLเพื่อลบสินค้าออกจากฐานข้อมูล ใช้ตัวแปร $delete_id เพื่อระบุสินค้าที่จะลบ
mysqli_query($conn, "DELETE FROM `brand` WHERE brand_id = '$delete_id'") or die('query failed');
   
header('location:admin_brand.php');
}








if(isset($_POST['update_brand'])){

   $update_b_id = $_POST['update_b_id'];
   $update_name = $_POST['update_brand_product_name'];
   

   mysqli_query($conn, "UPDATE `brand` SET name = '$update_name' WHERE brand_id = '$update_b_id'") or die('query failed');

  echo'อัดเดตแบรนด์เรียบร้อย';

   header('location:admin_brand.php');

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>brand</title>

<!-- font cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- css -->
<link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
   

<?php include 'admin_header.php'; ?>





<section class="add-products">

<h1 class="title">brand</h1>


<form action="" method="post" enctype="multipart/form-data">
  <h3>add brand</h3>
   
   <input type="text" name="name" class="box" placeholder="enter product brand name" required>
   
   <input type="submit" value="add brand" name="add_brand" class="btn">
   
   </form>


</section>





<section class="show-products">

<div class="box-container">



<?php
 $select_brand = mysqli_query($conn, "SELECT * FROM `brand`") or die('query failed');
    if(mysqli_num_rows($select_brand) > 0){
      while($fetch_brand = mysqli_fetch_assoc($select_brand)){
?>
<div class="box">


<div class="name"><?php echo $fetch_brand['name']; ?></div>

<a href="admin_brand.php?update=<?php echo $fetch_brand['brand_id']; ?>" class="option-btn">update</a>
<a href="admin_brand.php?delete=<?php echo $fetch_brand['brand_id']; ?>" class="delete-btn" onclick="return confirm('delete this brand?');">delete</a>
</div>
<?php
}
}else{
   echo 'ยังไม่มีแบรนด์!';
   }
?>
</div>
</section>




<section class="edit-brand-form">



<?php
if(isset($_GET['update'])){
$update_id = $_GET['update'];
$update_query = mysqli_query($conn, "SELECT * FROM `brand` WHERE brand_id = '$update_id'") or die('query failed');
if(mysqli_num_rows($update_query) > 0){
//ดึงข้อมูลแต่ละแถวจากชุดผลลัพธ์เป็นอาร์เรย์ที่เชื่อมโยง ซึ่งสามารถเข้าถึงได้โดยใช้ชื่อฟิลด์เป็นคีย์
while($fetch_update = mysqli_fetch_assoc($update_query)){
?>

<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="update_b_id" value="<?php echo $fetch_update['brand_id']; ?>">

<input type="text" name="update_brand_product_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">


      
<input type="submit" value="update" name="update_brand" class="btn">
<a href="admin_brand.php" class="delete-btn">Cancel</a>
</form>
<?php
}



}





}else{
echo '<script>document.querySelector(".edit-brand-form").style.display = "none";</script>';
}
?>

</section>




<!-- js -->
<script src="../js/admin_script.js"></script>

</body>
</html>