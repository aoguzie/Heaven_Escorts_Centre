<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['faq_question'],$_POST['faq_answer'],$_POST['faq_status'],$_POST['mode'],$_POST['_token'])){
            if(Token::check($_POST['_token'])){

                $faq_question = addslashes($_POST['faq_question']);
                $faq_answer = addslashes($_POST['faq_answer']);
                $faq_status = $_POST['faq_status'];
                $mode = $_POST['mode'];

                if($mode === "add"){

                    $sqlFaqs = "INSERT INTO `lc_faqs` (`id`, `question`, `answer`, `status`)
                    VALUES (NULL, '".$faq_question."', '".$faq_answer."', '".$faq_status."');";
                    $quFaqs = mysqli_query($conn,$sqlFaqs);
                    $faqs_id = mysqli_insert_id($conn);

                    header("Location:../faqs.php?action=success");
                    
                }else if($mode === "update"){
                    
                    $faqs_id = decode($_POST['faqs_id'],LIAM_COINS_KEY);

                    @mysqli_query($conn,"UPDATE `lc_faqs` SET `question` = '".$faq_question."', `answer` = '".$faq_answer."', `status` = '".$faq_status."' WHERE `id` = ".$faqs_id.";");

                    header("Location:../faqs.php?action=success");

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
?>