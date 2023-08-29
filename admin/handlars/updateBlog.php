<?php
    session_start();
    require('../includes/connection.php');
    require('methods/index.php');

    extract($_POST);
    
    $title = handleStringInputs($title);
    $dsecription = handleStringInputs($dsecription);

    $sql = "SELECT * FROM  `blogs` where `id` = $blog_id";
    $query = mysqli_query($conn , $sql);
    $blog = mysqli_fetch_assoc($query);
    $oldImage = $blog['image'];

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
        $sql = "UPDATE `blogs` set `title`='$title' , `description`='$description' ,`image` = '$newName' WHERE `id` = $blog_id ";

        if( mysqli_query($conn , $sql) ){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName , "../upload/blogs/$newName" );
                unlink("../upload/blogs/$oldImage");
            }

            $_SESSION['success'] = "Blog updated Successfully";
            header('location: ../blogs.php');
            
        }else{
            $_SESSION['errors'] = ['Something went wrong'];

            header('location: ../add-blog.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-blog.php');
    }
?>