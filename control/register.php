<?php
     include_once("../include/include_app.php");

     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['_token'])){
            if(Token::check($_POST['_token'])){
                
                $cus_username = mysqli_real_escape_string($conn,$_POST['cus_username']);
                $cus_password = mysqli_real_escape_string($conn,encode($_POST['cus_password'],LIAM_COINS_KEY));

                $cus_company = mysqli_real_escape_string($conn,$_POST['cus_company']);
                $cus_title = mysqli_real_escape_string($conn,$_POST['cus_title']);
                $cus_fname = mysqli_real_escape_string($conn,$_POST['cus_fname']);
                $cus_lname = mysqli_real_escape_string($conn,$_POST['cus_lname']);
                $cus_address1 = mysqli_real_escape_string($conn,$_POST['cus_address1']);
                $cus_address2 = mysqli_real_escape_string($conn,$_POST['cus_address2']);
                $cus_zipcode = mysqli_real_escape_string($conn,$_POST['cus_zipcode']);
                $cus_city = mysqli_real_escape_string($conn,$_POST['cus_city']);
                $cus_country = mysqli_real_escape_string($conn,$_POST['cus_country']);
                $cus_phone = mysqli_real_escape_string($conn,$_POST['cus_phone']);
                $cus_email = mysqli_real_escape_string($conn,$_POST['cus_email']);
                $cus_references = mysqli_real_escape_string($conn,addslashes($_POST['cus_references']));
                
                $sqlCustomer = "SELECT * FROM `lc_customer` WHERE `cus_email` = '".$cus_email."' OR `cus_username` = '".$cus_username."' LIMIT 1";
                $quCustomer = mysqli_query($conn,$sqlCustomer);
                $rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);
                
                $activeLink = encode($cus_username.$cus_password.$cus_email,LIAM_COINS_KEY);

                if(empty($rowCustomer['id'])){

                    $sqlCus = "INSERT INTO `lc_customer` (`id`, `cus_company`, `cus_title`, `cus_fname`, `cus_lname`, `cus_phone`, `cus_email`, `cus_username`, `cus_password`, `cus_references`, `status`, `register_date`, `confirm_email`, `active_link`, `cus_lock`) 
                    VALUES (NULL, '".$cus_company."', '".$cus_title."', '".$cus_fname."', '".$cus_lname."', '".$cus_phone."', '".$cus_email."', '".$cus_username."', '".$cus_password."', '".$cus_references."', 0, current_timestamp(), 0, '".$activeLink."', 0);";
                    @mysqli_query($conn,$sqlCus);
                    $cusID = mysqli_insert_id($conn);

                    $sqlBillAdd = "INSERT INTO `lc_bill_addres` (`id`, `cus_id`, `fname`, `lname`, `company`, `address1`, `address2`, `city`, `country`, `zipcode`, `phone`, `email`) 
                    VALUES (NULL, '".$cusID."', '".$cus_fname."', '".$cus_lname."', '".$cus_company."', '".$cus_address1."', '".$cus_address2."', '".$cus_city."', '".$cus_country."', '".$cus_zipcode."', '".$cus_phone."', '".$cus_email."');";
                    @mysqli_query($conn,$sqlBillAdd);

                    $sqlShipAdd = "INSERT INTO `lc_ship_addres` (`id`, `cus_id`, `fname`, `lname`, `company`, `address1`, `address2`, `city`, `country`, `zipcode`, `phone`, `email`) 
                    VALUES (NULL, '".$cusID."', '".$cus_fname."', '".$cus_lname."', '".$cus_company."', '".$cus_address1."', '".$cus_address2."', '".$cus_city."', '".$cus_country."', '".$cus_zipcode."', '".$cus_phone."', '".$cus_email."');";
                    @mysqli_query($conn,$sqlShipAdd);
                    
                    // Multiple recipients
                    $toEmail = $cus_email; // note the comma

                    // Subject
                    $subjectEmail = 'Registration for Heaven Escorts Centre';

                    // Message
                    $messageEmail = 'Dear '.$cus_title.'. '.$cus_fname.' '.$cus_lname.',<br/><br/>

                    thank you for your registration at Heaven Escorts Centre.<br/><br/>
                    
                    To complete your registration and to verify your email address, please click on the link below:<br/><br/>
                    
                    Activation link: <a href="'.DOMAIN_SITE.'/register_confirmation.php?key='.$activeLink.'">'.DOMAIN_SITE.'/register_confirmation.php?key='.$activeLink.'</a><br/>
                    If the link does not work, please copy the complete URL into your browser.<br/><br/>

                    Kind regards,<br/><br/>

                    Your Heaven Escorts Centre- team';

                    // To send HTML mail, the Content-type header must be set
                    $headersEmail[] = 'MIME-Version: 1.0';
                    $headersEmail[] = 'Content-type: text/html; charset=iso-8859-1';

                    // Additional headers
                    $headersEmail[] = 'To: '.$cus_fname.' '.$cus_lname.' <'.$cus_email.'>';
                    $headersEmail[] = 'From: Heaven Escorts Centre <no-reply@heavenescortscentre.uk>';

                    // Mail it
                    @mail($toEmail, $subjectEmail, $messageEmail, implode("\r\n", $headersEmail));


                    header("Location:../register_success.php?key=".encode($cus_email,LIAM_COINS_KEY));
                }else{
                    if($rowCustomer['cus_username'] === $cus_username){
                        header("Location:../register.php?action=failure&error=username&val=".$cus_username);
                    }else if($rowCustomer['cus_email'] === $cus_email){
                        header("Location:../register.php?action=failure&error=email&val=".$cus_email);
                    }else{
                        header("Location:../register.php?action=failure");
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
?>