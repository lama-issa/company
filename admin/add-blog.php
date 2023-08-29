<!DOCTYPE html>
<html lang="en">
<?php
    require('includes/head.php');
?>

<body>
    <?php
        require('./includes/nav.php')
    ?>


    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Blog</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="./handlars/createBlog.php" method="post" enctype="multipart/form-data">
                            <!-- alerts -->
                            <?php require('./includes/alerts.php')?>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary">Submit</button>
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