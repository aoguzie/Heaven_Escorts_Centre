<?php
    session_start();
    ini_set('expose_php', 'Off');
    include_once('config.php');
    include_once('con_db.php');
    include_once('function.php');
    include_once('class_inc.php');

    if(isset($_GET['action']) && $_GET['action'] === "searchPro"){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['proSearch']) && $_POST['proSearch'] != ""){
                echo "<script>window.location='product_search.php?keyword=".$_POST['proSearch']."';</script>";
                exit();
            }
        }
    }
?>