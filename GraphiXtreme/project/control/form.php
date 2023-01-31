<?php

include '../include/connect.php';
session_start();

if (isset($_POST['btn_login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $chk_user = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if (mysqli_num_rows($chk_user) != 0) {
        $row_user = $chk_user->fetch_array();
        if ($row_user['user_type'] == "admin") {
            $_SESSION['admin_id'] = $row_user['id'];
            header("location: ../admin/admin_page.php");
        } elseif ($row_user['user_type'] == "user") {
            $_SESSION['user_id'] = $row_user['id'];
            header("location: ../home.php");
        }
    } else {
        echo "<script>alert('Error email or password incorrect!!');window.location.href= '../login.php';</script>";
    }
}

if (isset($_POST['btn_register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_type = "user";

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        echo "<script>alert('This User Already Exists.');window.location.href= '../register.php';</script>";
    } else {
        if ($pass != $cpass) {
            echo "<script>alert('Passwords Do Not Match!');window.location.href= '../register.php';</script>";
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, number, password, user_type, address) VALUES('$name', '$email', '$number', '$cpass', '$user_type', '$address')") or die('query failed');
            echo "<script>alert('Successfully Registered!');window.location.href= '../login.php';</script>";
        }
    }
}

if (isset($_POST['btn_usereditpf'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $cpassword = md5($_POST['cpassword']);

    $select_user = $conn->query("SELECT password FROM users WHERE id = '$user_id'");
    $row_user = $select_user->fetch_array();
    if ($cpassword == $row_user['password']) {
        $sql = "UPDATE users set name='$name', number='$number', email='$email', address='$address' WHERE id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Data Has Been Edited!. ✅";
            header("location: ../user_editprofile.php");
        } else {
            echo "<script>alert('Cannot Edit The Data!');window.location.href= '../user_editprofile.php';</script>";
        }
    } else {
        $_SESSION['error'] = "Passwords Do Not Match!";
        header("location: ../user_editprofile.php");
    }
    mysqli_close($conn);
}
