<!DOCTYPE html>
<html lang="en">
<?php
    require('includes/head.php');
    require('includes/connection.php');
    

    if(isset($_GET['page'])){
        $page = $_GET['page'];//urlبتجيب رقم الصفحة من 
        // if the page is less than 1 make an action
        if($page < 1){
            header("location: sliders.php?page=1");
        }
    }else{
        $page = 1;
    }

    //pagination : عشان ما احط كل المحتوي بصفحة وحدة بقسم بصفحات عشان ما تعلق
    $limit = 2;//:بحط بكل صفحة 2 من الاضافات 
    $offset = ($page - 1) * $limit;//بالصفحة الاولى بجيب اول 2 اضافات بالصفحة الثانية بفشق عن اول ثنتين وبجيب الي بعدهم وهكذا
    $sql = "SELECT * FROM `sliders` limit $limit offset $offset ";
    $query = mysqli_query($conn ,$sql);
    if( mysqli_num_rows($query) > 0 ){
        $sliders = mysqli_fetch_all($query , MYSQLI_ASSOC);  
    }

    // get pagesCount
    $sql = "SELECT count(id) as slidersCount from sliders";// وبتحط فيه عدد السلايدات الي عندي بالداتا بيس مثلا 4 سلايداتslidersCount بتجيب جدول اسمه 
    $query = mysqli_query($conn ,$sql);
    $count = mysqli_fetch_assoc($query)['slidersCount']; 
    $numberOfPages = ceil($count/$limit) ;//لحساب عدد الصفحات الي فيها سلايدرز عشان اتحكم بعدد الكبسات الي بكون فيها ارقام للتنقل بين الصفحات يعني لو كان عندي 4 سلايدرز والليمت 2 فان عدد الصحات 2 بالتالي لازم يكون عنا 2 كبسات للتنقل بين هذول الصفحتين 1و2
    if($numberOfPages == 0){
        $numberOfPages = 1;
    }
    if($page > $numberOfPages){// رقم مش من ضمن عدد الصفحات الي عناurlاذا حطيت ب 
        header("location: sliders.php?page=1");
    }

    /*$count = mysqli_fetch_assoc($query);:بترجع 
    Array(
        [slidersCount]=> 4
    )

   */ 

   //  $count = mysqli_fetch_assoc($query)['slidersCount']; بترجع 4
   //ceil: بتكبر الرقم لاكبر عدد صحيح يعني 5/2 بترجع 3
?>

<body>


    <?php
        require('./includes/nav.php')
    ?>

    <div class="container-fluid py-5">
        <div class="row">
            <!-- alerts -->
            <?php require('./includes/alerts.php')?>

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All SLiders</h3>
                    <a href="./add-slider.php" class="btn btn-secondary">
                        Add New SLider
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        if(isset($sliders)):
                        foreach($sliders as $index => $slider): ?>
                        <tr>
                            <th scope="row"><?= $index+1?></th>
                            <td><?=  $slider['heading']?> </td>
                            <td> <?= $slider['description']?> </td>
                            <td>
                                <img src="./upload/sliders/<?= $slider['image']?>" alt="slider" style="width: 120px;"><!--لطباعة الصورة الي اخترتها داخل الجدول-->
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="./update-slider.php?id=<?= $slider['id']?>">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- way 1 delete-->
                                <!-- <form action="handlers/deleteAdmin.php" method="post">
                                    <input type="hidden" name="id" value="<?= $admin['id']?>">
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> -->
                                <!-- way 2 delete-->
                                <a class="btn btn-sm btn-danger"
                                    href="handlars/deleteSlider.php?id=<?= $slider['id']?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                        endforeach;
                    else: 
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">No Sliders found</td>
                        </tr>
                        <?php
                            endif;
                        ?>
                    </tbody>
                </table>
                <!--عشان نتنقل بين الصفحات لانه عملنا باجينيش يعني بكل صفحة بضيف شغلتين فقط-->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
<!--disabled:ما بقدر اكبس عليها -->
                        <li class="page-item <?= $page==1 ? 'disabled' : ''?> "><!--  تبطل تشتغل Previousلما توصل لاول صفحة خلي -->
                            <a class="page-link" href="sliders.php?page=<?= $page-1 ?>">Previous</a>
                        </li>

                        <?php for($i = 1 ; $i <= $numberOfPages ; $i++): ?>
                        <li class="page-item">
                            <a class="page-link" href="sliders.php?page=<?=$i?>"><?= $i?></a>
                        </li>
                        <?php endfor;?>

                        <li class="page-item <?= $page == $numberOfPages ?  'disabled' : '' ?> "><!-- تبطل تشتغل غير هيك خليها تشتغلnext لما توصل لاخر صفحة خلي next-->
                            <a class="page-link" href="sliders.php?page=<?= $page+1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
    <?php
        require('includes/script.php')
    ?>
</body>

</html>