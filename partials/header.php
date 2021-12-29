<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link bootstrap file -->
    <link rel="stylesheet" href="<?php echo $ROOT ?>css/bootstrap.min.css">
    <!-- date picker css -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- link custom css file -->
    <link rel="stylesheet" href="<?php echo $ROOT ?>css/styles.css">
    <title>EHR</title>
</head>
<body>
    <?php 
        require_once __DIR__.'/../config.php'; 
        // start session
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 

        
    ?>