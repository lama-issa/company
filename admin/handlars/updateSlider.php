<?php
    session_start();
    require('../includes/connection.php');
    require('methods/index.php');

    extract($_POST);
    
    $heading = handleStringInputs($heading);
    $dsecription = handleStringInputs($dsecription);

    $sql = "SELECT * FROM  `sliders` where `id` = $slider_id";
    $query = mysqli_query($conn , $sql);
    $slider = mysqli_fetch_assoc($query);
    $oldImage = $slider['image'];

    $errors = [];

    // image
    if($_FILES['image']['name']){
        $img = $_FILES['image'];
        $imgName = $img['name'];
        $tmpName = $img['tmp_name'];
        $sizeMb = $img['size']/(1024*1024);

        $ext = pathinfo($imgName, PATHINFO_EXTENSION);
        $newName = uniqid().'.'.$ext;

        if($sizeMb > 5){
            $errors[] = "image must be less than 5mb";
        }
    }else{
        $newName = $oldImage;
    }



    if(empty($errors)){
        $sql = "UPDATE `sliders` set `heading`='$heading' , `description`='$description' ,`image` = '$newName' WHERE `id` = $slider_id ";

        if( mysqli_query($conn , $sql) ){
            if($_FILES['image']['name']){//اذا اخترت صورة
                move_uploaded_file($tmpName , "../upload/sliders/$newName" );//اعمل ابلود للصورة الجديدة 
                unlink("../upload/sliders/$oldImage");//واحذف الصورة القديمة 
            }

            $_SESSION['success'] = "Slider updated Successfully";
            header('location: ../sliders.php');
            
        }else{
            $_SESSION['errors'] = ['Something went wrong'];

            header('location: ../add-slider.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-slider.php');
    }
?>