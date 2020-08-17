<?php
     include_once("../include/include_app.php");
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['cus_email'],$_POST['cus_password'],$_POST['_token'])){
            
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
                        $cus_passwordT = mysqli_real_escape_string($conn,encode($_POST['cus_password'],LIAM_COINS_KEY));

                        $sqlChkLock = "SELECT * FROM `lc_login_lock` WHERE 1 AND `cus_account`= '".$cus_email."' ORDER BY `id` DESC";
                        $quChkLock = mysqli_query($conn,$sqlChkLock);
                        $chkLockCount = mysqli_num_rows($quChkLock);
                        $rowChkLock = mysqli_fetch_array($quChkLock, MYSQLI_ASSOC);

                        if($chkLockCount <= 4){
                            login_process($conn,$cus_email,$cus_passwordT);
                        }else{

                            $to_time=strtotime(date("Y-m-d H:i:s"));
                            $from_time=strtotime($rowChkLock['datetime']); 
                            $checkTime = (int)round(abs($to_time - $from_time) / 60,2);
                            
                            if($checkTime >= 30){
                                login_process($conn,$cus_email,$cus_passwordT);
                            }else{
                                $sqlCusUpdate= "UPDATE `lc_customer` SET `cus_lock` = '1' WHERE (`cus_email` = '".$cus_email."' OR `cus_username` = '".$cus_email."');";
                                mysqli_query($conn,$sqlCusUpdate);
                                header("Location:../login.php?action=failure&error=cus_lock");
                            }
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