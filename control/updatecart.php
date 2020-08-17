<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['qty'],$_POST['_token'])){
            if(Token::check($_POST['_token'])){
                
                for ($i = 0; $i < count($_POST['qty']); $i++){
                    $key = $_POST['arr_key_' . $i];
                    $_SESSION['qty'][$key] = $_POST['qty'][$i];
                    //echo count($_POST['qty']).$key." ".$_POST['qty'][$i]."<br>";
                }
                header('location:../shoping-cart.php');
            }else{
                die();
            }
        }else{
            die();
        }
    }
    
    // else{

    //     $itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";

    //     if (!isset($_SESSION['cart'])){
    //         $_SESSION['cart'] = array();
    //         $_SESSION['qty'][] = array();
    //     }
    
    //     if(in_array($itemId, $_SESSION['cart'])){
    //         $key = array_search($itemId, $_SESSION['cart']);
    //         $_SESSION['qty'][$key] = $_SESSION['qty'][$key] + 1;
    //         header('location:../index.php?a=exists');
    //     }else{
    //         array_push($_SESSION['cart'], $itemId);
    //         $key = array_search($itemId, $_SESSION['cart']);
    //         $_SESSION['qty'][$key] = 1;
    //         header('location:../index.php?a=add');
    //     }

    // }
?>