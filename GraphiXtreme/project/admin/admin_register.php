<?php

include '../include/connect.php';
session_start();

if(isset($_POST['submit'])){

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$number = mysqli_real_escape_string($conn, $_POST['number']);
$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
$address = mysqli_real_escape_string($conn, $_POST['address']);

$user_type = $_POST['user_type'];

$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

if(mysqli_num_rows($select_users) > 0){
echo 'This user already exists!';
}else{
if($pass != $cpass){
echo'Passwords do not match!';
}else{
mysqli_query($conn, "INSERT INTO `users`(name, email, number, password, user_type) VALUES('$name', '$email', '$number', '$cpass', '$user_type')") or die('query failed');
echo 'Successfully registered!';

header('admin_users.php');
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

   <!--font -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- css-->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>



   
<div class="form-container">

   <form action="control/form.php" method="post">
   <h3>Add Member</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="number" name="number" placeholder="enter your phone number" required class="box">
      <input type="text" name="address" placeholder="enter your address" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">

      
      <select name="user_type" class="box">
         
         <option value="admin">admin</option>
         
      </select>
      <a href="admin_users.php" class="delete-btn">Cancel</a>
      <input type="submit" name="btn_register" value="Register Now" class="btn">
      
   </form>

</div>

</body>
</html>