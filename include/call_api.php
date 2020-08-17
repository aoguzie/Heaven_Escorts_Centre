<?php
    include_once("include_app.php");

    if(!empty($_POST)){
        if($_POST['action'] === "addToCart"){

            $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : "";

            if (!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
                $_SESSION['qty'][] = array();
            }
        
            if(in_array($itemId, $_SESSION['cart'])){
                $key = array_search($itemId, $_SESSION['cart']);
                $_SESSION['qty'][$key] = $_SESSION['qty'][$key] + 1;
               // header('location:../index.php?a=exists');
            }else{
                array_push($_SESSION['cart'], $itemId);
                $key = array_search($itemId, $_SESSION['cart']);
                $_SESSION['qty'][$key] = 1;
                //header('location:../index.php?a=add');
            }
        }
    }else{
        die();
    }
?>