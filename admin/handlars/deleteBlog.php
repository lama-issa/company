<?php 
session_start();
require('../includes/connection.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `blogs` where `id` = $id";
    $query = mysqli_query($conn , $sql);
    if(mysqli_num_rows($query) > 0 ){
        $blog = mysqli_fetch_assoc($query);
        $image = $blog['image'];
        $sql ="DELETE FROM `blogs` where `id`=$id";
        
        if(mysqli_query($conn , $sql)){
            if($image != "default.png"){
                unlink("../upload/blogs/$image");
            }
            $_SESSION['success'] = "Blog deleted Successfully";
            header('location: ../blogs.php');
        }
    }else{
        $_SESSION['errors'] = ['no admin found'];
        header('location: ../blogs.php');
    }
}