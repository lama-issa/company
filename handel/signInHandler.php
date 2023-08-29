<?php
    session_start();
    require('../admin/includes/connection.php');
    require('../admin/handlars/methods/index.php');



if($_SERVER['REQUEST_METHOD'] == "POST"){
    extract($_POST);
    $email = handleStringInputs($email);
    $password = handleStringInputs($password);
    $errors = [];

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
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = mysqli_query($conn , $sql);

        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            $adminPassword = $user['password'];

            if( password_verify($password , $adminPassword) ){
                $_SESSION['userId'] = $user['id'];
                header("location: ../index.php");
            }else{
                $_SESSION['errors'] = ['password is not correct'];
                header("location: ../sign-in.php");
            }

            
        }else{
            $_SESSION['errors'] = ['email is not correct'];
            header("location: ../sign-in.php");
        }
    }else{
        $_SESSION['errors'] = $errors;
        header("location: ../sign-in.php");
    }
    
}
else{
    echo "no";
}
?>