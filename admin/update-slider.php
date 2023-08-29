<!DOCTYPE html>
<html lang="en">
<?php
    require('includes/head.php');
    require('./includes/connection.php');
?>

<body>
    <?php
    // في نفس الصفحة اكثر من مرة فبستدهيها بالناف فقط  session_start();  ما بصير تكون
        require('./includes/nav.php');//من الناف رح يجيب session_start();
        //بدي اجيب بيانات السلايدر الي كابس عليه من خلال الايدي,الايدي بعثته من صفحة السلايدرز
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM `sliders` where `id` = $id";
            $query = mysqli_query($conn , $sql);
            if(mysqli_num_rows($query) > 0 ){
                $slider = mysqli_fetch_assoc($query);
            }else{
                $_SESSION['errors'] = ['no slider found'];
                header('location: ./sliders.php');
            }
        }else{
            $_SESSION['errors'] = ['Something went wrong'];
            header('location: ./sliders.php');
        }
    ?>


    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Update Slider</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="./handlars/updateSlider.php" method="post" enctype="multipart/form-data">
                            <!-- alerts -->
                            <?php require('./includes/alerts.php')?>
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" name="heading" class="form-control" value="<?= $slider['heading']?>">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" value="<?= $slider['description']?>">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <img src="upload/sliders/<?= $slider['image']?>" alt="" style="width: 200px; height: 200px; border-radius: 50%;" >
                            </div>
                            <input type="hidden" name="slider_id" value="<?= $slider['id']?>"><!--ببعث العنصر الي بدي اعمل عليه تعديل-->

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
    require('includes/script.php')
?>
</body>

</html>