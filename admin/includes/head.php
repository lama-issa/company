<?php
    session_start();
    $lang = 'en';
    if(isset($_SESSION['lang'])){
        $lang = $_SESSION['lang'];
    }

    require_once("messages_$lang.php");
?>
<!DOCTYPE html>
<html lang="<?= $lang?>" dir="<?= $lang =='ar' ? 'rtl' : 'ltr' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techstore | Dashboard</title>
    
    <?php if($lang == 'en'):?>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <?php else:?>
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <?php endif;?>
    <link rel="stylesheet" href="assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
</head>