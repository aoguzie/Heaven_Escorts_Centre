<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['page_description'],$_POST['mode'],$_POST['_token'])){

            if(Token::check($_POST['_token'])){

                $page_description = addslashes($_POST['page_description']);
                $mode = $_POST['mode'];
                $page_id = decode($_POST['page_id'],LIAM_COINS_KEY);

                if($mode === "update"){

                    $sqlPage = "UPDATE `lc_page` SET `detail` = '".$page_description."' WHERE `id` = '".$page_id."';";
                    $quPage = mysqli_query($conn,$sqlPage);

                    header("Location:../pages.php?action=success");
                }else{
                    die();
                }
                
            }else{
                die();
            }
        }else{
            die();
        }
    }else{
        die();
    }