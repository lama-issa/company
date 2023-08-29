<?php
//بدنا نفحص اذا الشخص الي سجل دخول هو الادمن يعني موجود بالداتا بيس اسمه انه ادمن فرح يدخله على صفحة اندكس خاصة بالادمن واذا مش ادمن ما رح يدخله على صفحة الادمن
    session_start();
    require('methods/index.php');
    require('../includes/connection.php');



if($_SERVER['REQUEST_METHOD'] == "POST"){
    extract($_POST);//بترجع البيانات الي دخلتها بالفورم
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
        $sql = "SELECT * FROM admins WHERE email = '$email'";
        $query = mysqli_query($conn , $sql);
        if(mysqli_num_rows($query) > 0){//نفحص اذا في عندي ادمن عنده نفس هاد الايميل
            $admin = mysqli_fetch_assoc($query);//بجيب جميع بيانات هاد الادمن
            $adminPassword = $admin['password'];//الباسورد الي بالداتا بيس للشخص الي اله هاد الايميل

            if(password_verify($password , $adminPassword) ){//   الايميل والباسورد صح
                $_SESSION['admin'] = $admin;//خزن بالسيشن بيانات الادمن 
                // $_SESSION['admin'] = $admin;: بشيك بكل الصفحات اذا في عندي سشن اسمه ادمن ..اذا موجود معناها بكون مسجل دخوله فبدخله على صفحة الاندكس تبعت الادمن
                // $_SESSION['isLogedIn'] = true;
                // $_SESSION['adminId'] = $admin['id'];
                header("location: ../index.php");
            }else{//اذا كان الباسورد غلط 
                $_SESSION['errors'] = ['password is not correct'];
                header("location: ../login.php");
            }

            
        }else{//اذا كان الايميل غلط
            $_SESSION['errors'] = ['email is not correct'];
            header("location: ../login.php");
        }
    }else{//اذا عمل سبمت وكان في ايرور 
        $_SESSION['errors'] = $errors;
        header("location: ../login.php");
    }
    
}
else{
    echo "no";
}
?>