<?php
    include_once("../include/include_app.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['cus_email'],$_POST['_token'])){
        if(Token::check($_POST['_token'])){

            $secretkeyrecaptcha = "6Ld5EtMUAAAAAOH-xx6Vq-tyXF4aaWtirOWo7fO3";

            if(isset($_POST['g-recaptcha-response'])){

                $captcha = $_POST['g-recaptcha-response'];
                $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkeyrecaptcha."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
            
                // if(!$captcha){
                //     $missinginputsecret = ["The response parameter is missing."];
                //     print_r($missinginputsecret[0]);}        
                // }

                if($response['success'] == true){ 
                    
                    $cus_email = mysqli_real_escape_string($conn,$_POST['cus_email']);

                    $sqlChkCus = "SELECT * FROM `lc_customer` WHERE 1 AND (`cus_email`= '".$cus_email."' OR `cus_username`= '".$cus_email."') LIMIT 1";
                    $quChkCus = mysqli_query($conn,$sqlChkCus);
                    $chkCount = mysqli_num_rows($quChkCus);
                    $rowCustomer = mysqli_fetch_array($quChkCus, MYSQLI_ASSOC);

                    $sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND (`cus_account`= '".$cus_email."' OR `cus_email`= '".$cus_email."') ORDER BY `id` DESC LIMIT 1";
                    $quChkReset = mysqli_query($conn,$sqlChkReset);
                    $rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

                    if($rowReset['id'] != ""){
                        $to_time=strtotime(date("Y-m-d H:i:s"));
                        $from_time=strtotime($rowReset['datetime']); 
                        $checkTime = (int)round(abs($to_time - $from_time) / 60,2);

                        if($checkTime <= 2880){
                            header("Location:../reset-password.php?action=failure&error=2");
                            die();
                        }
                    }


                    if($chkCount >= 1){
                        
                        $reset_pass_token = TokenResetPass::generate();
                        mysqli_query($conn,"INSERT INTO `lc_reset_password` (`id`, `cus_id`, `cus_account`, `cus_email`, `cus_token`, `datetime`, `send_email`, `reset_pass`) VALUES (NULL, '".$rowCustomer['id']."', '".$rowCustomer['cus_username']."', '".$rowCustomer['cus_email']."', '".$reset_pass_token."', current_timestamp(), 0, 0);");
                        $resetID = mysqli_insert_id($conn);

                        $emailSend = encode($resetID.'|'.$reset_pass_token.'|'.$rowCustomer['cus_email'],LIAM_COINS_KEY);

                        header("Location:../reset-password-pass.php?id=".$emailSend);
                    }else{
                        header("Location:../reset-password.php?action=failure&error=1");
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
    }else{
        die();
    }
?>