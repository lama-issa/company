
<?php
//$_GETبستقبله من خلالurlاي اشي ببثه من خلال 
//الفاريبل الي رح ينبعث على هاي الصفحة لازم نخزنه بالسيشن
//الفاريبل :lang
//value:en or ar
//بجين urlالفاليو والفاريبل من :"handlers/change_lang.php?lang=ar"
    session_start();
    if(isset($_GET['lang'])){
        // $_SESSION['lang'] = $_GET['lang'];
        if($_GET['lang'] == 'ar'){
            $_SESSION['lang'] = 'ar';
        }else{
            $_SESSION['lang'] = 'en';
        }
    }else{
        $_SESSION['lang'] = 'en';
    }

    header("location:".$_SERVER['HTTP_REFERER']);//(بس يخزن كل اشي برجعني على الصفحة الي اجا منها (على الصفحة الي كنت فيها

    echo $_SESSION['lang'];
?>
