<?php
     include_once("../include/include_app.php");
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['_token'])){
            if(Token::check($_POST['_token'])){

                $sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND `cus_id` = '".$_SESSION['cus_id']."' ORDER BY `id` DESC LIMIT 1";
                $quChkReset = mysqli_query($conn,$sqlChkReset);
                $rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

                if($rowReset['id'] != ""){
                    $to_time=strtotime(date("Y-m-d H:i:s"));
                    $from_time=strtotime($rowReset['datetime']); 
                    $checkTime = (int)round(abs($to_time - $from_time) / 60,2);

                    if($checkTime <= 1440){
                        header("Location:../my-address.php?action=failure&error=1");
                        die();
                    }
                }

                $bill_fname = mysqli_real_escape_string($conn,$_POST['bill_fname']);
                $bill_lname = mysqli_real_escape_string($conn,$_POST['bill_lname']);
                $bill_company_name = mysqli_real_escape_string($conn,$_POST['bill_company_name']);
                $bill_address1 = mysqli_real_escape_string($conn,$_POST['bill_address1']);
                $bill_address2 = mysqli_real_escape_string($conn,$_POST['bill_address2']);
                $bill_city = mysqli_real_escape_string($conn,$_POST['bill_city']);
                $bill_state = mysqli_real_escape_string($conn,$_POST['bill_state']);
                $bill_poscode = mysqli_real_escape_string($conn,$_POST['bill_poscode']);
                $bill_phone = mysqli_real_escape_string($conn,$_POST['bill_phone']);
                $bill_email = mysqli_real_escape_string($conn,$_POST['bill_email']);
                $type_add = mysqli_real_escape_string($conn,$_POST['type_add']);

                $tableDB = '';
                if($type_add === 'bill'){
                    $tableDB = 'lc_bill_addres';
                }else if($type_add === 'ship'){
                    $tableDB = 'lc_ship_addres';
                }

                $sqlCustomerAdd = "SELECT * FROM `".$tableDB."` WHERE `cus_id` = '".$_SESSION['cus_id']."' LIMIT 1";
                $quCustomerAdd = mysqli_query($conn,$sqlCustomerAdd);
                $rowCustomerAdd = mysqli_fetch_array($quCustomerAdd, MYSQLI_ASSOC);

                if($rowCustomerAdd['id']){
                    $sqlAddress = "UPDATE `".$tableDB."` SET `fname` = '".$bill_fname."', `lname` = '".$bill_lname."', `company` = '".$bill_company_name."', `address1` = '".$bill_address1."', `address2` = '".$bill_address2."', `city` = '".$bill_city."', `country` = '".$bill_state."', `zipcode` = '".$bill_poscode."', `phone` = '".$bill_phone."', `email` = '".$bill_email."' WHERE `id` = '".$rowCustomerAdd['id']."';";
                    mysqli_query($conn,$sqlAddress);
                }else{
                    $sqlAddress = "INSERT INTO `".$tableDB."` (`id`, `cus_id`, `fname`, `lname`, `company`, `address1`, `address2`, `city`, `country`, `zipcode`, `phone`, `email`) 
                    VALUES (NULL, '".$_SESSION['cus_id']."', '".$bill_fname."', '".$bill_lname."', '".$bill_company_name."', '".$bill_address1."', '".$bill_address2."', '".$bill_city."', '".$bill_state."', '".$bill_poscode."', '".$bill_phone."', '".$bill_email."');";
                    mysqli_query($conn,$sqlAddress);
                }

                header("Location:../my-address.php?action=success");

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