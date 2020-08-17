<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['mode'],$_POST['_token'])){
            if(Token::check($_POST['_token'])){

                $cus_username = $_POST['cus_username'];
                $cus_company = $_POST['cus_company'];
                $cus_title = $_POST['cus_title'];
                $cus_fname = $_POST['cus_fname'];
                $cus_lname = $_POST['cus_lname'];
                $cus_phone = $_POST['cus_phone'];
                $cus_email = $_POST['cus_email'];
                $cus_references = $_POST['cus_references'];
                $cus_password = encode($_POST['cus_password'],LIAM_COINS_KEY);
                $cus_status = $_POST['cus_status'];
                $confirm_email = $_POST['confirm_email'];
                $cus_lock = $_POST['cus_lock'];
                $mode = $_POST['mode'];
                $cus_id = decode($_POST['cus_id'],LIAM_COINS_KEY);

                $rowChkUser = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `lc_customer` WHERE `cus_username` = '".$cus_username."' AND `id` != ".$cus_id."  LIMIT 1"),MYSQLI_ASSOC);
                $rowChkEmail = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `lc_customer` WHERE `cus_email` = '".$cus_email."' AND `id` != ".$cus_id." LIMIT 1"),MYSQLI_ASSOC);

                if($mode === "update"){

                    if($rowChkUser['id'] != ""){
                        header("Location:../customer_edit.php?cus_id=".$_POST['cus_id']."&mode=update&error=username&val=".$cus_username);
                        exit();
                    }

                    if($rowChkEmail['id'] != ""){
                        header("Location:../customer_edit.php?cus_id=".$_POST['cus_id']."&mode=update&error=email&val=".$cus_email);
                        exit();
                    }

                    @mysqli_query($conn,"UPDATE `lc_customer` SET `cus_company` = '".$cus_company."', `cus_title` = '".$cus_title."', `cus_fname` = '".$cus_fname."', `cus_lname` = '".$cus_lname."', `cus_phone` = '".$cus_phone."', `cus_email` = '".$cus_email."', `cus_username` = '".$cus_username."', `cus_references` = '".$cus_references."', `status` = '".$cus_status."', `confirm_email` = '".$confirm_email."', `cus_lock` = '".$cus_lock."' WHERE `id` = ".$cus_id.";");

                    if($cus_lock == 0){
                        @mysqli_query($conn,"DELETE FROM `lc_login_lock` WHERE `cus_account` = '".$cus_username."'");
                    }

                    if($_POST['cus_password'] != ""){
                        @mysqli_query($conn,"UPDATE `lc_customer` SET `cus_password` = '".$cus_password."' WHERE `id` = ".$cus_id.";");
                    }

                    header("Location:../customers.php?action=success");

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