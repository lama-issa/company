<?php

/*echo '<pre>';
print_r($_SESSION);// بlogin بطبع كل بيانات الادمن الي سجل دخوله 
//بترجع:Array(
  [admin]=> Array
  (
    [id] => ---
    [name] => ---
    ....
  )
)
echo '</pre>';*/

// $_SESSION['admin']['name']:عشان اجيب اسم الادمن الي سجل دخول

if(!isset($_SESSION['admin'])){//الادمن مسجل دخوله 
  //اذا ما لقي هاي السشن معناها انه الادمن مش مسجل دخوله فما رح يدخلني على صفحة الاندكس الخاصة بالادمن رح يخليني بصفحة اللوج ان
  //يعني اذا اي شخص حاول يدخل على صفحة الانكس تبعت الادمن من خلال يوارل ما رح يخله عليها فقط بدخل الادمن على هاي الصفحة بعد ما يعمل لوج ان وبعد ما يتم التاكد انه هاد الحساب للادمن فبدخله هناك غير هيك رح يخليه بصفحة اللوج ان
  header("location: login.php");
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TechStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="add-services.php">Add Services</a>
                  </li>

                <li class="nav-item active">
                    
                  <a class="nav-link" href="./sliders.php">Sliders</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./blogs.php">Blogs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Orders</a>
                </li>
                <?php if($_SESSION['admin']['role'] == 'super_admin'):?><!--  Adminsواذا كان الرول اله ادمن عادي ما رح يظهرلة كبسة Adminsالادمن الي مسجل دخول اذا كانت الرول اله سوبر ادمن فرح يظهرله اللينك-->
                <li class="nav-item">
                    <a class="nav-link" href="./admins.php">Admins</a>
                </li>
                <?php endif;?>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">

                    <li class="nav-item">
                        <a class="nav-link" href="handlars/change_lang.php?lang=ar">عربي</a><!--?lang=ar: change_lang.phpفي صفحة $_GET عشان اعرف شو اللغة الي بعثتها وبستقبله من خلال-->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="handlars/change_lang.php?lang=en">en</a>
                    </li>

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['admin']['name']?> <!--عشان يطبعلي اسم الادمن الي سجل دخول اسمه بالناف بار-->
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Profile</a>
                      <a class="dropdown-item" href="handlars/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>