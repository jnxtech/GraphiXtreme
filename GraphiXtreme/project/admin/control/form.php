<?php
include '../../include/connect.php';
session_start();

if (isset($_POST['btn_admineditpf'])) {
    $admin_id = $_SESSION['admin_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $cpassword = md5($_POST['cpassword']);

    $select_user = $conn->query("SELECT password FROM users WHERE id = '$admin_id'");
    $row_user = $select_user->fetch_array();
    if ($cpassword == $row_user['password']) {
        $sql = "UPDATE users set name='$name', number='$number', email='$email', address='$address' WHERE id = '$admin_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Data Has Been Edited ✅";
            header("location: ../admin_editprofile.php");
        } else {
            echo "<script>alert('ไม่สมารถแก้ไขข้อมูลได้');window.location.href= '../admin_editprofile.php';</script>";
        }
    } else {
        $_SESSION['error'] = "Passwords Do Not Match!";
        header("location: ../admin_editprofile.php");
    }
    mysqli_close($conn);
}

if (isset($_POST['btn_register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_type = "admin";

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        echo "<script>alert('This user already exists');window.location.href= '../register.php';</script>";
    } else {
        if ($pass != $cpass) {
            echo "<script>alert('Passwords Do Not Match!');window.location.href= '../register.php';</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, number, password, user_type, address) VALUES('$name', '$email', '$number', '$cpass', '$user_type', '$address')") or die('query failed');
            echo "<script>alert('Successfully registered!');window.location.href= '../admin_users.php';</script>";
        }
    }
}