<?php
session_start();
require('../includes/connection.php');
require('./methods/index.php');


extract($_POST);
//handel string inputs
$name=handleStringInputs($name);
$email=handleStringInputs($email);

$sql="SELECT * FROM `admins` where `id`=$admin_id";
$query=Mysqli_query($conn,$sql);
$admin=Mysqli_fetch_assoc($query);
$oldImage=$admin['image'];//الصورة القديمة خزنتها عشان لما اعمل تعديل على البيانات وما ادخل صورة يحطلي الصورة القديمة كدفلت

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
   //$newName=$oldImage اذا ما كان في صورة خلي 
   $newName=$oldImage;
}


//INSERT INTO :عشان يضيف على الداتا بيس القيم الي دخلتها بالفورم بعد ما اعملها فالديشن
if(empty($erros))
{
   $sql="UPDATE `admins` SET `name`='$name',`email`='$email',`image`='$newName',`is_active`='$is_active'";
   if(Mysqli_query($conn,$sql)){
      //اذا تنفذت جملة الاستعلام ارفعلي الصورة على الداتا بيس
      if($_FILES['image']['name']){
         move_uploaded_file($tempName,"../upload/$newName");
         if($oldImage != 'default.png'){
            unlink("../upload/$oldImage");// عشان احذف الصورة القديمة من الفجول
         }
        
      }
      $_SESSION['success']="Admin Updated Successfuly";
      header('location: ../admins.php');
   }else{
    $_SESSION['errors']=['Somthing went wrong'];
      header('location: ../add-admin.php');
    
   }
}else{// اذا كان في ايرور بادخال الانبت بالفورم
   $_SESSION['errors']=$erros;//add-adminعشان انقل الايرور من هاي الصفحة لصفحة
   header('location: ../add-admin.php');
  
}

?>