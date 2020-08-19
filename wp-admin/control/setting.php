<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(Token::check($_POST['_token'])){

            $link_color = $_POST['link_color'];
            $link2_color = $_POST['link2_color'];
            $button_color = $_POST['button_color'];
            $button2_color = $_POST['button2_color'];
            $bgtopbar_color = $_POST['bgtopbar_color'];
            $bgtop_color = $_POST['bgtop_color'];
            $bgfooter_color = $_POST['bgfooter_color'];
            $mode = $_POST['mode'];

            $faqs_id = decode($_POST['faqs_id'],LIAM_COINS_KEY);

            @mysqli_query($conn,"UPDATE `lc_setting` SET `link_color` = '".$link_color."', `link2_color` = '".$link2_color."', `button_color` = '".$button_color."', `button2_color` = '".$button2_color."', `bgtopbar_color` = '".$bgtopbar_color."', `bgtop_color` = '".$bgtop_color."', `bgfooter_color` = '".$bgfooter_color."' WHERE `id` = 1;");

            header("Location:../setting.php?mode=update");
        }else{
            die();
        }
    }else{
        die();
    }
?>