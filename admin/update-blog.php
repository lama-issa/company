<!DOCTYPE html>
<html lang="en">
<?php
    require('includes/head.php');
    require('./includes/connection.php');
?>

<body>
    <?php
        require('./includes/nav.php');
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM `blogs` where `id` = $id";
            $query = mysqli_query($conn , $sql);
            if(mysqli_num_rows($query) > 0 ){
                $blog = mysqli_fetch_assoc($query);
            }else{
                $_SESSION['errors'] = ['no blog found'];
                header('location: ./blogs.php');
            }
        }else{
            $_SESSION['errors'] = ['Something went wrong'];
            header('location: ./blogs.php');
        }
    ?>


    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Update Blog</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="./handlars/updateBlog.php" method="post" enctype="multipart/form-data">
                            <!-- alerts -->
                            <?php require('./includes/alerts.php')?>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="<?= $blog['title']?>">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" value="<?= $blog['description']?>">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <img src="upload/blogs/<?= $blog['image']?>" alt="" style="width: 200px; height: 200px; border-radius: 50%;" >
                            </div>
                            <input type="hidden" name="blog_id" value="<?= $blog['id']?>">

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