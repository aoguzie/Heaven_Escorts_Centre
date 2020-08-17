<?php
     include_once("../include/include_app.php");
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['_token'])){
            if(Token::check($_POST['_token'])){
                
            }else{
                die();
            }
        }else{
            die();
        }
    }else{
        die();
    }
?>

