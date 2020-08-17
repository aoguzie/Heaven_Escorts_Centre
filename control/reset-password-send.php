<?php
    include_once("../include/include_app.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['_token2'],$_POST['_token'])){

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

                    $decodeLink = decode($_POST['_token2'],LIAM_COINS_KEY);
                    $valLink = explode('|',$decodeLink);
                    $resetID = $valLink[0];
                    $resetToken = $valLink[1];
                    $cus_email = $valLink[2];

                    $activeReset = decode($resetID,LIAM_COINS_KEY);

                    $sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND `cus_token` = '".$resetToken."' LIMIT 1";
                    $quChkReset = mysqli_query($conn,$sqlChkReset);
                    $rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

                    $to_time=strtotime(date("Y-m-d H:i:s"));
                    $from_time=strtotime($rowReset['datetime']); 
                    $checkTime = (int)round(abs($to_time - $from_time) / 60,2);
                    
                    if($checkTime <= 20 && $rowReset['reset_pass'] == 0){

                        if($rowReset['id'] != ""){

                            mysqli_query($conn,"UPDATE `lc_reset_password` SET `send_email` = `send_email`+'1' WHERE `id` = ".$resetID.";");
                            
                            $sqlChkCus = "SELECT * FROM `lc_customer` WHERE `cus_email`= '".$cus_email."' LIMIT 1";
                            $quChkCus = mysqli_query($conn,$sqlChkCus);
                            $rowCustomer = mysqli_fetch_array($quChkCus, MYSQLI_ASSOC);
    
                            // Multiple recipients
                            $toEmail = $rowCustomer['cus_email']; // note the comma
    
                            $emailDate = date("F d, Y");
    
                            // Subject
                            $subjectEmail = 'Confirm it\'s you to access your LiamCoins account - '.$emailDate;
    
                            // Message
                            $messageEmail = 'Please confirm your identity to access your LiamCoins account
                            
                            <br/><br/>
    
                            Hi '.$rowCustomer['cus_fname'].',<br/><br/>
    
                            It looks like you\'re having trouble signing into your account.<br/><br/>
    
                            Please select the \'confirm\' button to verify your identity and access your account. (It\'s only good for 24 hours.)<br/><br/>
    
                            If you don\'t recognize this activity, please <a href="'.DOMAIN_SITE.'/contact-us-form.php" target="_blank">contact us.</a><br/><br/>
    
                            <a href="'.DOMAIN_SITE.'/reset-password-confirm.php?id='.$_POST['_token2'].'"><p style="background-color: rgb(0, 121, 188);padding:10px;color: #ffffff;width: 250px;text-align: center;font-weight: bold;">Confirm</p></a><br/><br/>
    
                            Kind regards,<br/><br/>
    
                            Your LiamCoins- team';
    
                            // To send HTML mail, the Content-type header must be set
                            $headersEmail[] = 'MIME-Version: 1.0';
                            $headersEmail[] = 'Content-type: text/html; charset=iso-8859-1';
    
                            // Additional headers
                            $headersEmail[] = 'To: '.$rowCustomer['cus_fname'].' '.$rowCustomer['cus_lname'].' <'.$rowCustomer['cus_email'].'>';
                            $headersEmail[] = 'From: LiamCoins <no-reply@liamcoins.uk>';
    
                            // Mail it
                            @mail($toEmail, $subjectEmail, $messageEmail, implode("\r\n", $headersEmail));
                            
                            header("Location:../reset-password-email.php?id=".$_POST['_token2']);
    
                        }else{
                            die();
                        }
                    }else{
                        header("Location:../reset-password-pass.php?action=failure&id=".$_POST['_token2']);
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