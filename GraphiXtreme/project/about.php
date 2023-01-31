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
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'include/header.php'; ?>

   <div class="heading">
      <h3>about us</h3>
      <p> <a href="home.php">home</a> / about </p>
   </div>

   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/w3.jpg" alt="">
         </div>

         <div class="content">
            <h3>why choose us?</h3>
            <p>ชื่อร้านค้ารายละเอียดร้านค้า GraphiXtreme ร้านขายการ์จอคอมพิวเตอร์แบบครบวงจร รับประกันทุกชิ้น ตามความต้องการใช้งานของลูกค้า รับประกันสินค้าทุกชิ้น
               ศูนย์รวม การ์ดจอ ราคาถูก ส่งจริงได้จริง ศูนย์รวมการ์จอคอมพิวเตอร์คุณภาพดี ราคาประหยัดต้อง GraphiXtreme เท่านั้น ในการซื้อคอมพิวเตอร์นั้นผู้ซื้อควรจะต้องศึกษา
               และหาข้อมูลเกี่ยวกับสินค้าให้พอมีความรู้อยู่บ้างในเบื้องต้นก็ยังดี และก่อนที่จะตัดสินใจซื้อเครื่องคอมพิวเตอร์กับร้านไหนควรหาข้อมูลร้านค้าดีๆเสียก่อน เลือกร้านที่ไว้ใจได้
               และหากจะให้ดีควรเลือกร้านที่มีการบริการหลังการขายที่ดี อาจจะเลือกดูข้อมูลจากรีวิวต่างๆ หรือตามเว็บไซต์อื่นๆประกอบการตัดสินใจด้วย หากพูดถึงคอมพิวเตอร์แล้ว
               คนที่ไม่มีข้อมูลสินค้า ไม่มีข้อมูลร้านเลย ไม่มีความรู้ใดๆเลย การเลือกซื้อสินค้าคงเป็นไปได้ยาก หากไม่มีร้านที่ไว้ใจได้คอยให้การดูแล หากมีปัญหาเหล่านี้ มาปรึกษาเราได้ที่
               GraphiXtreme ได้เลย ยินดีให้คำปรึกษา รับประกันบริษัทเราเปิดขายมามากกว่า 8 ปี !!
               สำหรับใครที่กำลังมองหาการ์จอคอมพิวเตอร์คุณภาพดีแบบมือหนึ่งใหม่แกะกล่อง แวะเข้ามาชมหรือปรึกษากับทางร้านก่อนได้ ไม่ซื้อหาไม่ว่ากัน เข้ามาพูดคุยกันก่อน
               ทางร้านยินดีให้คำปรึกษาอย่างเต็มที่ ทั้งนี้ทางร้านยังมีบริการจัดสเปคคอมอีกด้วยเอาใจสาวกคอมประกอบ</p>
         </div>
      </div>

   </section>







   <?php include 'include/footer.php'; ?>

   <!-- js -->
   <script src="js/script.js"></script>

</body>

</html>