<?php
    session_start();
    require('../includes/connection.php');
    require('methods/index.php');
    extract($_POST);
    
    $heading = handleStringInputs($heading);
    $description = handleStringInputs($description);


    $errors = [];

    // name
    if(empty($heading)){
        $errors[]='name is required';
    }elseif(!is_string($heading)){
        $errors[]='name must be a string';
    }elseif( strlen($heading) <=2 || strlen($heading) > 40 ){
        $errors[]='name must be between 2 - 40 chars';
    }
      // name
    if(empty($description)){
        $errors[]='name is required';
    }

    // image
    if($_FILES['image']['name'] == ''){//اذا ما اخترت صورة وعملت سبمت ما رح يضيف اشي رح يخليني بصفحة addSlider وببعث رسالة خطا
        $errors[] = 'image is required';
    }


    $img = $_FILES['image'];
    $imgName = $img['name'];
    $tmpName = $img['tmp_name'];
    $sizeMb = $img['size']/(1024*1024);

    $ext = pathinfo($imgName, PATHINFO_EXTENSION);
    $newName = uniqid().'.'.$ext;

    if($sizeMb > 5){
        $errors[] = "image must be less than 5mb";
    }

    if(empty($errors)){
        $sql = "INSERT INTO `sliders`(`heading`,`description`,`image` ) VALUES ('$heading' , '$description', '$newName' )";

        if( mysqli_query($conn , $sql) ){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName , "../upload/sliders/$newName" );//newName ارفع الصورة على الابلود جوا مجلد اسمه سلايدرز وخزن فيه 
            }

            $_SESSION['success'] = "Slider Created Successfully";
            header('location: ../sliders.php');
            
        }else{
            header('location: ../add-slider.php');

            $_SESSION['errors'] = ['Something went wrong'];
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-slider.php');
        $_SESSION['errors'] = ['Something went wrong'];
    }
?>