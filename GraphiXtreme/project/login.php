<?php

include 'include/connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!--  css  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>


   <div class="form-container">
      <form action="control/form.php" method="post">
         <h3>login</h3>
         <input type="email" name="email" placeholder="enter your email" required class="box">
         <input type="password" name="password" placeholder="enter your password" required class="box">
         <input type="submit" name="btn_login" value="login now" class="btn">
         <p>don't have an account? <a href="register.php">register now</a></p>
      </form>

   </div>

</body>

</html>