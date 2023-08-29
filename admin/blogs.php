<!DOCTYPE html>
<html lang="en">
<?php
    require('includes/head.php');
    require('includes/connection.php');
    

    if(isset($_GET['page'])){
        $page = $_GET['page'];
        // if the page is less than 1 make an action
        if($page < 1){
            header("location: blogs.php?page=1");
        }
    }else{
        $page = 1;
    }

    
    $limit = 2;
    $offset = ($page - 1) * $limit;
    $sql = "SELECT * FROM `blogs` limit $limit offset $offset ";
    $query = mysqli_query($conn ,$sql);
    if( mysqli_num_rows($query) > 0 ){
        $blogs = mysqli_fetch_all($query , MYSQLI_ASSOC);  
    }

    // get pagesCount
    $sql = "SELECT count(id) as blogsCount from blogs";
    $query = mysqli_query($conn ,$sql);
    $count = mysqli_fetch_assoc($query)['blogsCount'];
    $numberOfPages = ceil($count/$limit) ;

    if($numberOfPages == 0){
        $numberOfPages = 1;
    }
    if($page > $numberOfPages){
        header("location: blogs.php?page=1");
    }
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
                    <h3>All BLogs</h3>
                    <a href="./add-blog.php" class="btn btn-secondary">
                        Add New Blog
                    </a>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($blogs))://في داتا
                            foreach($blogs as $index => $blog): ?>
                            <tr>
                                <th scope="row"><?= $index+1?></th>
                                <td><?=  $blog['title']?> </td>
                                <td> <?= $blog['description']?> </td>
                                <td>
                                    <img src="./upload/blogs/<?= $blog['image']?>" alt="slider" style="width: 120px;">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="./update-blog.php?id=<?= $blog['id']?>">
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
                                        href="handlars/deleteBlog.php?id=<?= $blog['id']?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            endforeach;
                        else: 
                        ?>
                            <tr >
                                <td colspan="5" class="text-center">No Blogs found</td>
                            </tr>
                        <?php
                            
                            endif;
                        ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page==1 ? 'disabled' : ''?> ">
                            <a class="page-link" href="blogs.php?page=<?= $page-1 ?>">Previous</a>
                        </li>

                        <?php for($i = 1 ; $i <= $numberOfPages ; $i++): ?>
                        <li class="page-item">
                            <a class="page-link" href="blogs.php?page=<?=$i?>"><?= $i?></a>
                        </li>
                        <?php endfor;?>

                        <li class="page-item <?= $page == $numberOfPages ?  'disabled' : '' ?> ">
                            <a class="page-link" href="blogs.php?page=<?= $page+1 ?>">Next</a>
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