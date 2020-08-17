<?php
     include_once("../include/include_app.php");
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['cus_email'],$_POST['cus_msg'],$_POST['_token'])){
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
                        $cus_msg =  nl2br(addslashes(mysqli_real_escape_string($conn,$_POST['cus_msg'])));

                        $sqlChkCus = "SELECT * FROM `lc_customer` WHERE `cus_email`= '".$cus_email."' LIMIT 1";
                        $quChkCus = mysqli_query($conn,$sqlChkCus);
                        $rowCustomer = mysqli_fetch_array($quChkCus, MYSQLI_ASSOC);

                        // Multiple recipients
                        $toEmail = LIAM_COINS_EMAIL_CS; // note the comma

                        $emailDate = date("F d, Y");

                        // Subject
                        $subjectEmail = 'Confirming your identity - '.$emailDate;

                        // Message
                        $messageEmail = 'Please confirm your identity to access your LiamCoins account
                        
                        <br/><br/>

                        Hi LiamCoins Customer Service,<br/><br/>

                        Email : '.$cus_email.'<br/><br/>

                        Description : '.$cus_msg .'<br/><br/>

                        Kind regards,<br/><br/>

                        Your LiamCoins- team';

                        // To send HTML mail, the Content-type header must be set
                        $headersEmail[] = 'MIME-Version: 1.0';
                        $headersEmail[] = 'Content-type: text/html; charset=iso-8859-1';

                        // Additional headers
                        $headersEmail[] = 'To: LiamCoins Customer Service <'.LIAM_COINS_EMAIL_CS.'>';
                        $headersEmail[] = 'From: '.$rowCustomer['cus_fname']." ".$rowCustomer['cus_lname'].' <'.$rowCustomer['cus_fname'].'>';

                        // Mail it
                        @mail($toEmail, $subjectEmail, $messageEmail, implode("\r\n", $headersEmail));
                        
                        header("Location:../contact-us-congratulations.php");

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