<?php
       include 'connect.php';
        $templ = "includes/templates/";
        $func = "includes/functions/";
        $css = "layout/css/";
        $js = "layout/js/";
        $lang = 'includes/languages/';
        

        include $lang . 'english.php';
     //   include $lang . 'arabic.php';
        include $func . 'functions.php';
        include $templ . 'header.php'; 
        if(!isset($nonavbar)) {
        include $templ . 'navbar.php'; 
        }

        
?>