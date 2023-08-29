<?php
//بدنا نضيف على جدول الكومنت
    session_start();
    require('../admin/includes/connection.php');
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_SESSION['userId'];//(صورته واسمه)عشان اعرف مين المستخدم الي كتب الكومنت واجيب بياناته 
        $blog_id = $_POST['blog_id'];//عشان اعرف الكومنت لاي بلوك مكتوب
        $content = $_POST['content'];//كومنت

//f.k :user-idنربط جدول الكومنتس مع جدول اليوزرز عشان نجيب بيانات اليوزر الي كتب الكومنت من خلال 
//f.k: blog_idوبنربط جدول الكومنت مع جدول البلوك عشان نجيب رقم البلوك الي انكتبله الكومنت من خلال
        $sql = "INSERT INTO `comments`(`user_id` , `blog_id` , `content`) VALUES ('$user_id' , '$blog_id' , '$content')";
        if (mysqli_query($conn , $sql)){
            header("location: ".$_SERVER['HTTP_REFERER']);
        }

    }else{
        header("location: ../index.php");
    }
?>