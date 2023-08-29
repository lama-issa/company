
<?php

require('includes/head.php');
//لاحظار البيانات من الداتا بيس من جدول الادمن
require('includes/connection.php');
$query="select * from admins";
$getadmins=Mysqli_query($conn,$query);
if(mysqli_num_rows($getadmins)>0){
  $admins=Mysqli_fetch_all($getadmins,MYSQLI_ASSOC);
}

?>
<body>

<?php
        require('./includes/nav.php');
        if($_SESSION['admin']['role'] == 'admin'){//اذا كان الادمن مسجل دخوله وكان الرول اله ادمن عادي فما رح يدخله على صفحة الادمن الي فيها الحذف والتعديل رح يوديه على صفحة الاندكس
            header('location: ./index.php');
            //لكن اذا كان سوبر ادمن فرح يدخله على صفحة الادمن الي فيها حذف وتعديل واضافة
            //وهدول السطرين بضيفهم كمان بكل الصفحات الخاصة بالادمن add-admin . update-admin
            //عشان تكون الصلاحية للدخول على صفحة الادمن هو السوبر ادمن
        }
    ?>
    

    <div class="container-fluid py-5">
        <div class="row">
         <!-- Alerts success-->
         <?php require('./includes/alerts.php');?>

            <div class="col-md-10 offset-md-1">
<!--messages:لتحويل اللغة حسب شو بدي الترجمة-->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3><?= $messages['all_admins']?></h3>

                    <!--لما اكبس على هاي الكبسة رح يبعثني على صفحة add-admin.php-->
                    <a href="add-admin.php" class="btn btn-secondary">  <?=$messages['add_new_admin']?></a>
                </div>

                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"> <?= $messages['name']?></th>
                        <th scope="col"><?= $messages['email']?></th>
                        <th scope="col"><?= $messages['status']?></th>
                        <th scope="col"><?= $messages['created_at']?></th>
                        <th scope="col"> <?= $messages['actions']?></th>
                      </tr>
                    </thead>
     <tbody>
     
     <?php
      if(isset($admins))://اذا كان في ادمن بالداتا بيس
     foreach($admins as $index=> $admin) : ?>
    <tr>
      
      <th scope="row"><?= $index+1 ?></th><!--عشان الاندكس يبلش من1 -->
      <td><?= $admin['name'] ?></td>
      <td><?= $admin['email'] ?></td>
      <td>
        <?php if($admin['is_active']) :?>
          <i class="fas fa-check-circle text-success"></i>
          active
          <?php else :?>
            <i class="fas fa-times-circle  text-danger"></i>
            not active

            <?php endif ;?>
      </td>
      <td><?= $admin['created_at'] ?></td>
      <td>
      <a class="btn btn-sm btn-info" href="./update-admin.php?id=<?=$admin['id']?>">
          <i class="fas fa-edit"></i>
       </a>

<!--way 1 delete-->
       <!--الطريقة الاولى عشان ابعث الايدي تبع الادمن الي بدي احذفه-->
       <!--url هاي الطريقة عشان احمي الايدي, هون الايدي ما بنبعث فوق برابط -->
       <!--post فهاي الطريقة بتكون من خلال form-->
       <!--
<form action="handlars/deleteAdmin.php" method="post">
        <input type="hidden" name="id" value="<?=$admin['id']?>">
        <button type="button" class="btn btn-sm btn-danger">
        <i class="fas fa-trash"></i>
        </button>

          </form>
       -->

<!--way 2 delete-->
          <!--url الطريقة الثانية  عشان ابعث الايدي بس هون رح يكون الايدي ظاهر لاي حدا في رابط -->
          <!--بتكون من خلال get-->
       <a class="btn btn-sm btn-danger" href="handlars/deleteAdmin.php?id=<?=$admin['id']?>"> <!--urlببعث الايدي تبع الادمن الي بدي احذفه في رابط -->
         <i class="fas fa-trash"></i>
      </a>
     
      </td>
       </tr>

    <?php endforeach ;
    endif;
    ?>
                         
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php
require('includes/script.php');
?>
</body>
</html>