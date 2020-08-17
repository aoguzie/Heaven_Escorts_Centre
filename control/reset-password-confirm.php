<?php
    include_once("../include/include_app.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['_token2'],$_POST['_token'],$_POST['cus_password'])){

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
                    $cus_pass = encode($_POST['cus_password'],LIAM_COINS_KEY);
                    $valLink = explode('|',$decodeLink);
                    $resetID = $valLink[0];
                    $resetToken = $valLink[1];
                    $cus_email = $valLink[2];

                    $sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND `cus_token` = '".$resetToken."' LIMIT 1";
                    $quChkReset = mysqli_query($conn,$sqlChkReset);
                    $rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

                    if($rowReset['id'] != ""){

                        $sqlChkCus = "SELECT * FROM `lc_customer` WHERE `cus_email`= '".$cus_email."' LIMIT 1";
                        $quChkCus = mysqli_query($conn,$sqlChkCus);
                        $rowCustomer = mysqli_fetch_array($quChkCus, MYSQLI_ASSOC);

                        mysqli_query($conn,"UPDATE `lc_customer` SET `cus_password` = '".$cus_pass."' WHERE `id` = ".$rowCustomer['id'].";");

                        // Multiple recipients
                        $toEmail = $rowCustomer['cus_email']; // note the comma

                        $emailDate = date("F d, Y");

                        // Subject
                        $subjectEmail = 'You reset your password - '.$emailDate;

                        // Message
                        $messageEmail = 'That was you, wasn\'t it, '.$rowCustomer['cus_fname'].'?
                        
                        <br/><br/>
                         
                        Hi '.$rowCustomer['cus_fname'].',<br/><br/>

                        LiamCoins password changed.
                       
                        <br/><br/>

                        When your password is changed, we\'ll let you know.<br/><br/>

                        If you didn\'t make this change, you should <a href="'.DOMAIN_SITE.'/contact-us-form.php" target="_blank">contact customer service</a> or <a href="'.DOMAIN_SITE.'/reset-password.php" target="_blank">reset your password.</a>

                        <br/><br/>

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

                        mysqli_query($conn,"UPDATE `lc_reset_password` SET `reset_pass` = '1' WHERE `id` = ".$resetID.";");

                        $_SESSION['cus_id'] = $rowCustomer['id'];
        
                        $cus_token = TokenLogin::generate();
                        $sqlCusUpdate= "UPDATE `lc_customer` SET `login_token` = '".$cus_token."' WHERE `id` = ".$rowCustomer['id'].";";
                        mysqli_query($conn,$sqlCusUpdate);

                        $cus_ip = get_client_ip();

                        $sqlLogLogin = "INSERT INTO `lc_login` (`id`, `cus_id`, `ip`, `date_login`, `token`) VALUES (NULL, '".$rowCustomer['id']."', '".$cus_ip."', current_timestamp(), '".$cus_token."');";
                        mysqli_query($conn,$sqlLogLogin);

                        mysqli_query($conn,"DELETE FROM `lc_login_lock` WHERE `cus_id` = '".$rowCustomer['id']."'");
                        
                        header("Location:../reset-password-congratulations.php");

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
    }else{
        die();
    }
?>