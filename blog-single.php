<!DOCTYPE html>
<html lang="en">

<?php
// ويعرض بيانات هاد البلوك بهاي الصفحةblog-single.phpلما اكبس على ريد مور الي بصفحة البلوك رح يوديني على صفحة
    require('includes/head.php')
?>

<body>

    <!-- ======= Header ======= -->
    <?php
    require('includes/header.php');
    $blog_id = $_GET['blog_id'];//وهو رقم البلوك الي كبست عليهurlالايدي الجاي من 
    // WHERE blogs.id = $blog_id;":عشان اجيب بيانات البلوك الي كبست عليه 
    $sql = "SELECT blogs.id , blogs.title , blogs.description , blogs.image ,blogs.created_at , admins.name FROM `blogs` JOIN admins ON admins.id = blogs.admin_id  WHERE blogs.id = $blog_id;";
    $query = mysqli_query($conn, $sql);
    $blog=  mysqli_fetch_assoc($query);

    if(isset($_SESSION['userId']))
    {//عشان نجيب بيانات المستخدم الي مسجل دخوله عشان بعدها نجيب الستيتس تاعته اذا كانت اكتف يعني =1  اذن بقدر يكتب كومنت اذا مش اكتف =0 اذن رح نخفي عنه كتابة الكومنت
        $user_id = $_SESSION['userId'];
        $sql = "SELECT * FROM `users` WHERE id = $user_id;";
        $query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($query);
    }
?>
    <!-- End Header -->
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Blog</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Blog</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <article class="entry entry-single" data-aos="fade-up">

                            <div class="entry-img">
                                <img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
                            </div>
<!--بدي اعرض البيانات الخاصة بالبلوك الي كبست عليه بصفحة السنجل-->
                            <h2 class="entry-title">
                                <a href="blog-single.html"><?= $blog['title']?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                            href="blog-single.php?blog_id=<?= $blog['id']?>"><?= $blog['name']?></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                            href="blog-single.php?blog_id=<?= $blog['id']?>"><time
                                                datetime="2020-01-01"><?= $blog['created_at']?></time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a
                                            href="blog-single.php?blog_id=<?= $blog['id']?>">12 Comments</a></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    <?= $blog['description']?>
                                </p>

                            </div>
                        </article><!-- End blog entry -->

                        <div class="blog-comments" data-aos="fade-up">

                            <h4 class="comments-count">8 Comments</h4>
                            <?php
                                    $sql = "SELECT users.name , comments.content ,comments.created_at from comments JOIN users on users.id = comments.user_id WHERE blog_id = $blog_id;";
                                    $query = mysqli_query($conn, $sql);
                                    $comments = mysqli_fetch_all($query , MYSQLI_ASSOC);
                                    foreach($comments as $comment) :
                                ?>
                            <div id="comment-1" class="comment clearfix">
                                <img src="assets/img/comments-1.jpg" class="comment-img  float-left" alt="">
                                <h5><a href=""><?= $comment['name']?></a> <a href="#" class="reply"><i
                                            class="icofont-reply"></i> Reply</a></h5>
                                <time datetime="2020-01-01"><?= $comment['created_at']?></time>
                                <p>
                                    <?= $comment['content']?>
                                </p>
                            </div><!-- End comment #1 -->
                            <?php endforeach;?>

                            <?php if(isset($_SESSION['userId']) && $user['status']==1 ):?><!---اذا المستخدم مسجل دخوله والستيتس اله ==1 هيك بقدلر يكتب كومنت-->
                            <div class="reply-form">
                                <h4>Leave a Reply</h4>
                                <p>Your email address will not be published. Required fields are marked * </p>
                                <form action="handel/postComment.php" method="post">
                                    <div class="row">
                                        <div class="col form-group">
                                            <textarea name="content" class="form-control"
                                                placeholder="Your Comment*"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="blog_id" value="<?= $blog['id']?>">
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>

                            </div>
                            <?php endif;?>
                        </div><!-- End blog comments -->

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar" data-aos="fade-left">

                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="">
                                    <input type="text">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>

                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    <li><a href="#">General <span>(25)</span></a></li>
                                    <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                    <li><a href="#">Travel <span>(5)</span></a></li>
                                    <li><a href="#">Design <span>(22)</span></a></li>
                                    <li><a href="#">Creative <span>(8)</span></a></li>
                                    <li><a href="#">Educaion <span>(14)</span></a></li>
                                </ul>

                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts">
                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-1.jpg" alt="">
                                    <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-2.jpg" alt="">
                                    <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-3.jpg" alt="">
                                    <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a>
                                    </h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-4.jpg" alt="">
                                    <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-5.jpg" alt="">
                                    <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                            </div><!-- End sidebar recent posts-->

                            <h3 class="sidebar-title">Tags</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    <li><a href="#">App</a></li>
                                    <li><a href="#">IT</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Mac</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Office</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Studio</a></li>
                                    <li><a href="#">Smart</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>

                            </div><!-- End sidebar tags-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <!-- footer -->
    <?php
    require('includes/footer.php')
  ?>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>