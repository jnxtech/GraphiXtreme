<?php

include '../include/connect.php';

session_start();

if (isset($_SESSION['admin_id'])) {
   $user_id = $_SESSION['admin_id'];
} elseif (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
}

$select_user = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
$row_user = mysqli_fetch_array($select_user);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--font -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- css-->
   <link rel="stylesheet" href="../css/style.css">

</head>

<body>


   <div class="form-container">

      <form action="control/form.php" method="post">
         <h3>Edit Information</h3>
         <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert">
               <h2><?= $_SESSION['success'] ?></h2>
            </div>
         <?php unset($_SESSION['success']);
         } ?>

         <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert-danger">
               <h2><?= $_SESSION['error'] ?></h2>
            </div>
         <?php unset($_SESSION['error']);
         } ?>

         <input type="text" name="name" value="<?= $row_user['name'] ?>" required class="box">
         <input type="text" name="email" value="<?= $row_user['email'] ?>" required class="box">
         <input type="number" name="number" value="<?= $row_user['number'] ?>" required class="box">
         <input type="text" name="address" value="<?= $row_user['address'] ?> " required class="box">
         <input type="password" name="cpassword" placeholder="confirm your password" required class="box">

         </select>
         <input type="submit" name="btn_admineditpf" value="ตกลง" class="btn">
         <a href="admin_users.php" class="delete-btn">Cancel</a>
      </form>

   </div>

</body>

</html>