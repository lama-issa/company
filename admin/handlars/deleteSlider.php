<?php 
session_start();
require('../includes/connection.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `sliders` where `id` = $id";
    $query = mysqli_query($conn , $sql);
    if(mysqli_num_rows($query) > 0 ){
        $slider = mysqli_fetch_assoc($query);
        $image = $slider['image'];
        $sql ="DELETE FROM `sliders` where `id`=$id";
        
        if(mysqli_query($conn , $sql)){
            if($image != "default.png"){
                unlink("../upload/sliders/$image");
            }
            $_SESSION['success'] = "SLider deleted Successfully";
            header('location: ../sliders.php');
        }
    }else{
        $_SESSION['errors'] = ['no admin found'];
        header('location: ../sliders.php');
    }
}