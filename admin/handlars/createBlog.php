<?php
    session_start();
    require('../includes/connection.php');
    require('methods/index.php');
    extract($_POST);
    
    $title = handleStringInputs($title);
    $description = handleStringInputs($description);
    $admin_id = $_SESSION['admin']['id'];  //الادمن ايدي بس بعرفه من السشن عشان اعرف مين الادمن الي ضاف هاي البلوك بالتالي بقدر اجيب اسم هاد الادمن 


    $errors = [];

    // name
    if(empty($title)){
        $errors[]='name is required';
    }elseif(!is_string($title)){
        $errors[]='name must be a string';
    }elseif( strlen($title) <=2 || strlen($title) > 40 ){
        $errors[]='name must be between 2 - 40 chars';
    }
      // name
    if(empty($description)){
        $errors[]='name is required';
    }

    // image
    if($_FILES['image']['name'] == ''){
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
        $sql = "INSERT INTO `blogs`(`title`,`description`,`image` ,`admin_id` ) VALUES ('$title' , '$description', '$newName', '$admin_id' )";

        if( mysqli_query($conn , $sql) ){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName , "../upload/blogs/$newName" );
            }

            $_SESSION['success'] = "Blog Created Successfully";
            header('location: ../blogs.php');
            
        }else{
            header('location: ../add-blog.php');

            $_SESSION['errors'] = ['Something went wrong'];
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-blog.php');
        $_SESSION['errors'] = ['Something went wrong'];
    }
?>