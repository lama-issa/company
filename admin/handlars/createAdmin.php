<!--هون رح تيجي البيانات الي دخلتها بالفورم الموجود في add-admin.php -->
<!--extract : بتحول الكي ل فاريبل -->
<!--extract: key ---- variable ----- $name...>
<!extract($_POST);:بترجع كل اشي دخلته بالفورم على شكل فاريبل $-->
<!--handleStringInputs():ميثود انا عرفته من عندي وحطيته بصفحة بملف اسمه ميثود وجواه حطيت ملف اندكس حطيت فيه هاد الميثود-->
<?php
session_start();
require('../includes/connection.php');
require('./methods/index.php');


extract($_POST);
//handel string inputs
$name=handleStringInputs($name);
$email=handleStringInputs($email);
$password=handleStringInputs($password);

//validation:
$erros=[];
 //name
 if(empty($name)){
    $erros[]='name is requried';
 }elseif(!is_string($name)){
    $erros[]='name must be string';
 }elseif(strlen($name) <=2 || strlen($name) > 40){
    $erros[]='name must between 2 and 40';
 }
 


 //email
 if(empty($email)){
    $erros[]='email is requried';
 }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $erros[]='email is not valid';
 }elseif(strlen($email) <=8 || strlen($email) > 60){
    $erros[]='email size error';
 }

 //password
 if(empty($password)){
    $erros[]='password is requried';
 }   elseif (strlen($password) <= '8') {
    $erros[] = "Your Password Must Contain At Least 8 Characters!";
}
elseif(!preg_match("#[0-9]+#",$password)) {
    $erros[] = "Your Password Must Contain At Least 1 Number!";
}
elseif(!preg_match("#[A-Z]+#",$password)) {
    $erros[] = "Your Password Must Contain At Least 1 Capital Letter!";
}
elseif(!preg_match("#[a-z]+#",$password)) {
    $erros[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
}

//image
if($_FILES['image']['name']){
   //$newName=uniqid().$name.'.'.$ext; اذا كان في صورة خلي 
   $img=$_FILES['image'];
   $imgeName=$img['name'];
   $tempName=$img['tmp_name'];
   $sizeMb=$img['size']/(1024*1024);
   $ext=pathinfo($imgeName,PATHINFO_EXTENSION);
   $newName=uniqid().$name.'.'.$ext;// k#ly.Lama.jpg
   if($sizeMb>5){
      $erros[] ="image size must be less than 5mb";
   }
}else{
   //$newName='default.png' اذا ما كان في صورة خلي 
   $newName='default.png';
}


//INSERT INTO :عشان يضيف على الداتا بيس القيم الي دخلتها بالفورم بعد ما اعملها فالديشن
if(empty($erros))
{
   $password=password_hash($password,PASSWORD_DEFAULT);//لتشفير الباسورد
   $sql="INSERT INTO `admins` (`name`,`email`,`password`,`image`,`is_active`) VALUES ('$name','$email','$password','$newName','$is_active')";
   if(Mysqli_query($conn,$sql)){
      //اذا تنفذت جملة الاستعلام ارفعلي الصورة على الداتا بيس
      if($_FILES['image']['name']){
         move_uploaded_file($tempName,"../upload/$newName");
      }
      $_SESSION['success']="Admin Created Successfuly";
      header('location: ../admins.php');
   }else{
      header('location: ../add-admin.php');
       echo "not ok";
   }
}else{// اذا كان في ايرور بادخال الانبت بالفورم
   $_SESSION['errors']=$erros;//add-adminعشان انقل الايرور من هاي الصفحة لصفحة
   header('location: ../add-admin.php');
   echo "something went wrong";
}

?>