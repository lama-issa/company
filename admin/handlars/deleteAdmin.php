<?php
//$_GET['id']: urlعشان اوخذ الايدي من 
session_start();
require('../includes/connection.php');

if(isset($_GET['id'])){//بدي افحص اذا الايدي انبعث ولا لا
$id=$_GET['id'];//هاد الايدي تبع الادمن الي بدي احذفه الي كبست عليه 
$sql="SELECT * FROM `admins` where `id`=$id";
$query=Mysqli_query($conn,$sql);

if(mysqli_num_rows($query)>0){//هل يوجد ادمن اله هاد الايدي ؟ اذا موجود جبلي هاد الادمن واحذفه
    $admin=Mysqli_fetch_assoc($query);//fetchعشان اجيب البيانات من الدتا بيس بعمل 
    //fetch_assoc: لاني بفتش على عنصر واحد
    $image=$admin['image'];//جبت الصورة تبعت الادمن الي بدي احذفه من الداتا بيس
    $sql="DELETE FROM `admins` where `id`=$id";

    if(Mysqli_query($conn,$sql)){
        if($image != "default.png"){//عشان ما حذف الصورة الافتراضية الي حطيتها من الفجول
            unlink("../upload/$image");//عشان نحذف الصورة من الفيجول لما نحذف الادمن الي اله هاي الصورة
        }
        $_SESSION['success']="Admin Deleted Successfuly";
        header('location: ../admins.php');
    }
}else{//اذا الايدي مش موجود بالداتا بيس
    $_SESSION['errors']=['Admin Not Found'];
    header('location: ../admins.php');
}




}

