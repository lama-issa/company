<?php
    session_start();
    require('../admin/includes/connection.php');
    require('../admin/handlars/methods/index.php');
    extract($_POST);
    
    $name = handleStringInputs($name);
    $email = handleStringInputs($email);
    $password = handleStringInputs($password);


    $errors = [];

    // name
    if(empty($name)){
        $errors[]='name is required';
    }elseif(!is_string($name)){
        $errors[]='name must be a string';
    }elseif( strlen($name) <=2 || strlen($name) > 40 ){
        $errors[]='name must be between 2 - 40 chars';
    }

    // email
    if(empty($email)){
        $errors[]='email is required';
    }elseif( !filter_var($email , FILTER_VALIDATE_EMAIL) ){
        $errors[]='email is not valid';
    }elseif( strlen($email) <=8 || strlen($email) > 60 ){
        $errors[]='email size error';
    }

    // password
    if(empty($password)){
        $errors[]='password is required';
    }elseif (strlen($password) <= '8') {
        $errors[] = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }




    if(empty($errors)){
        $password = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(`name`,`email`,`password`) VALUES ('$name' , '$email', '$password' )";

        if( mysqli_query($conn , $sql)){//اذا سجل دخوله اعملي سشن فيها رقم المستخدم الي انضاف جديد
            //mysqli_insert_id($conn):برجع رقم اخر مستخدم انضاف فهيك بقدر احصل على بيانات المستخدم الي سجل دخوله
            $_SESSION['userId'] = mysqli_insert_id($conn);
            $_SESSION['success'] = "User Created Successfully";
            header('location: ../index.php');
            
        }else{
            header('location: ../add-admin.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../index.php');
        echo "Something went wrong";
    }
?>