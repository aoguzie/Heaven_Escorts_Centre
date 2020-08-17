<?php
    include_once("../include/include_app.php");

    if(isset($_GET['itemId'])){

        $itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
 
        if (!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
            $_SESSION['qty'][] = array();
        }
        
        $key = array_search(decode($itemId,LIAM_COINS_KEY), $_SESSION['cart']);
        $_SESSION['qty'][$key] = "0";
        
        $_SESSION['cart'] = array_diff($_SESSION['cart'], array($itemId));

        header('location:../shoping-cart.php?a=remove');
        
    }else{
        die();
    }

    

?>