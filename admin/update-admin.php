<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require('includes/head.php');
require('./includes/connection.php');

if(isset($_GET['id'])){//بدي افحص اذا الايدي انبعث ولا لا
  $id=$_GET['id'];//هاد الايدي تبع الادمن الي بدي اعدله الي كبست عليه 
  $sql="SELECT * FROM `admins` where `id`=$id";
  $query=Mysqli_query($conn,$sql);
  
  if(mysqli_num_rows($query)>0){ 
      $admin=Mysqli_fetch_assoc($query);
     
  }else{
    $_SESSION['errors']=['Admin Not Found'];
    header('location: ./admins.php');
  }
}else{
  $_SESSION['errors']=['somthing went wrong'];
  header('location: ./admins.php');
}




?>
<body>
    
<?php
require('includes/nav.php');
if($_SESSION['admin']['role'] == 'admin'){ 
  header('location: ./index.php');
}
?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Update Admin</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form Action="./handlars/updateAdmin.php" method="post" enctype="multipart/form-data">
                        <!-- Alerts errors-->
                        
                        <?php require('./includes/alerts.php');?>
<!--رح اطبع ب value الاشي الي بدي اعدل عليه عشان يكون ظاهر قدامي الاشياء الي كنت كاتبها وبدي اعدل عليها-->
<!--valueبدي اعرض الداتا القديمة بكل حقل عن طريق -->
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" class="form-control" name="name" value="<?= $admin['name']?>"><!--value الدتا الي بكتبها بالانبت رح تتخزن في -->

                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" name="email" value="<?= $admin['email']?>">
                            </div>
                            
                            <div class="form-group">
                              <label>Status</label>
                             <select name="is_active" class="form-control">
                              <!--عشان اعدل على is_active-->
                              <option value="1" <?= $admin['is_active'] == 1 ? 'selected' : '' ?> >active<option>
                              <option value="0" <?= $admin['is_active'] == 0 ? 'selected' : '' ?> >not active<option>
                             </select>
                            </div>
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" class="form-control" name="image">
                              <!--valueعشان اعرض الصورة الي كنت مختارها بالفورم لما اجي اعدل عليه لانه الصورة ما بتوخذ -->
                              <img src="upload/<?= $admin['image']?>" alt="" style="width:300px ; height:300px;">
                            </div>

                            <input type="hidden" name="admin_id" value="<?= $admin['id']?>"><!--عشان يعرف هاي الداتا الي وصلت لاي ادمن-->

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
require('includes/script.php');
?>
</body>
</html>