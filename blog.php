<!DOCTYPE html>
<html lang="en">

<?php
  require('includes/head.php')
?>

<body>

    <!-- ======= Header ======= -->
    <?php
    require('includes/header.php')
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
                        <?php
                            $sql = "SELECT blogs.id , blogs.title , blogs.description , blogs.image ,blogs.created_at , admins.name FROM `blogs` JOIN admins ON admins.id = blogs.admin_id;";
                            $query = mysqli_query($conn, $sql);
                            $blogs=  mysqli_fetch_all($query , MYSQLI_ASSOC);
                            foreach($blogs as $blog) :
                        ?>

                        <article class="entry" data-aos="fade-up">

                            <div class="entry-img">
                                <img src="./admin/upload/blogs/<?= $blog['image']?>" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="blog-single.php?blog_id=<?= $blog['id']?>"><?= $blog['title']?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                            href="blog-single.php?blog_id=<?= $blog['id']?>"><?= $blog['name']?></a></li>
                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a
                                            href="blog-single.php?blog_id=<?= $blog['id']?>"><time datetime="2020-01-01"><?= $blog['created_at']?></time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a
                                            href="blog-single.php?blog_id=<?= $blog['id']?>">12 Comments</a></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    <?= $blog['description']?>
                                </p>
                                <div class="read-more">
                                    <!--ويعرض بيانات هاد البلوك بهاي الصفحةblog-single.phpلما اكبس على ريد مور  رح يوديني على صفحة-->
                                    <!-- $blog['id']:urlوبتحكم بالبلوك الي كبست عليه من خلال رقمة ب -->
                                    <a href="blog-single.php?blog_id=<?= $blog['id']?>">Read More</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->

                        <?php endforeach; ?>

                        <div class="blog-pagination">
                            <ul class="justify-content-center">
                                <li class="disabled"><i class="icofont-rounded-left"></i></li>
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
                            </ul>
                        </div>

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
                                    <h4><a href="blog-single.php?blog_id=<?= $blog['id']?>">Nihil blanditiis at in nihil autem</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-2.jpg" alt="">
                                    <h4><a href="blog-single.php?blog_id=<?= $blog['id']?>">Quidem autem et impedit</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-3.jpg" alt="">
                                    <h4><a href="blog-single.php?blog_id=<?= $blog['id']?>">Id quia et et ut maxime similique occaecati ut</a>
                                    </h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-4.jpg" alt="">
                                    <h4><a href="blog-single.php?blog_id=<?= $blog['id']?>">Laborum corporis quo dara net para</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="assets/img/blog-recent-posts-5.jpg" alt="">
                                    <h4><a href="blog-single.php?blog_id=<?= $blog['id']?>">Et dolores corrupti quae illo quod dolor</a></h4>
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