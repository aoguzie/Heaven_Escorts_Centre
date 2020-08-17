<?php
     include_once("../include/include_app.php");
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['_token'])){
            if(Token::check($_POST['_token'])){

                $sqlCustomer = "SELECT * FROM `lc_customer` WHERE `id` = '".$_SESSION['cus_id']."' LIMIT 1";
                $quCustomer = mysqli_query($conn,$sqlCustomer);
                $rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);

                $sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND `cus_id` = '".$_SESSION['cus_id']."' ORDER BY `id` DESC LIMIT 1";
                $quChkReset = mysqli_query($conn,$sqlChkReset);
                $rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

                if($rowReset['id'] != ""){
                    $to_time=strtotime(date("Y-m-d H:i:s"));
                    $from_time=strtotime($rowReset['datetime']); 
                    $checkTime = (int)round(abs($to_time - $from_time) / 60,2);

                    if($checkTime <= 1440){
                        header("Location:../my-account.php?action=failure&error=3");
                        die();
                    }
                }

                if($rowCustomer['id']){

                    $cus_fname = mysqli_real_escape_string($conn,$_POST['cus_fname']);
                    $cus_lname = mysqli_real_escape_string($conn,$_POST['cus_lname']);
                    $cus_company = mysqli_real_escape_string($conn,$_POST['cus_company']);
                    $cus_title = mysqli_real_escape_string($conn,$_POST['cus_title']);
                    $cus_phone = mysqli_real_escape_string($conn,$_POST['cus_phone']);
                    $cus_references = mysqli_real_escape_string($conn,addslashes($_POST['cus_references']));

                    $sqlCustomerU = "UPDATE `lc_customer` SET `cus_company` = '".$cus_company."', `cus_title` = '".$cus_title."', `cus_fname` = '".$cus_fname."', `cus_lname` = '".$cus_lname."', `cus_phone` = '".$cus_phone."', `cus_references` = '".$cus_references."' WHERE `id` = '".$rowCustomer['id']."'";
                    mysqli_query($conn,$sqlCustomerU);

                    if(isset($_POST['cus_password']) && $_POST['cus_password'] != ""){

                        $cus_password = mysqli_real_escape_string($conn,encode($_POST['cus_password'],LIAM_COINS_KEY));
                        $cus_password_new = mysqli_real_escape_string($conn,encode($_POST['cus_password_new'],LIAM_COINS_KEY));
                        $cus_password_confirm = mysqli_real_escape_string($conn,encode($_POST['cus_password_confirm'],LIAM_COINS_KEY));

                        if($cus_password === $rowCustomer['cus_password']){
                            if($cus_password_new === $cus_password_confirm){

                                $sqlCustomerU = "UPDATE `lc_customer` SET `cus_password` = '".$cus_password_new."' WHERE `id` = '".$rowCustomer['id']."'";
                                mysqli_query($conn,$sqlCustomerU);

                                header("Location:../my-account.php?action=success");
                            }else{
                                header("Location:../my-account.php?action=failure&error=2");
                            }
                        }else{
                            header("Location:../my-account.php?action=failure&error=1");
                        }
                    }else{
                        header("Location:../my-account.php?action=success");
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
    }else{
        die();
    }
?>