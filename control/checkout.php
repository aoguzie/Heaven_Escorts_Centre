<?php
     include_once("../include/include_app.php");
     if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['_token'])){
            if(Token::check($_POST['_token'])){

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

                $type_address = mysqli_real_escape_string($conn,$_POST['type_address']);

                if($type_address == 1){
                    $ship_fname = $bill_fname;
                    $ship_lname = $bill_lname;
                    $ship_company_name = $bill_company_name;
                    $ship_address1 = $bill_address1;
                    $ship_address2 = $bill_address2;
                    $ship_city = $bill_city;
                    $ship_state = $bill_state;
                    $ship_poscode = $bill_poscode;
                    $ship_phone = $bill_phone;
                    $ship_email = $bill_email;
                }else{
                    if(isset($_POST['ship_fname'])){
                        $ship_fname = mysqli_real_escape_string($conn,$_POST['ship_fname']);
                        $ship_lname = mysqli_real_escape_string($conn,$_POST['ship_lname']);
                        $ship_company_name = mysqli_real_escape_string($conn,$_POST['ship_company_name']);
                        $ship_address1 = mysqli_real_escape_string($conn,$_POST['ship_address1']);
                        $ship_address2 = mysqli_real_escape_string($conn,$_POST['ship_address2']);
                        $ship_city = mysqli_real_escape_string($conn,$_POST['ship_city']);
                        $ship_state = mysqli_real_escape_string($conn,$_POST['ship_state']);
                        $ship_poscode = mysqli_real_escape_string($conn,$_POST['ship_poscode']);
                        $ship_phone = mysqli_real_escape_string($conn,$_POST['ship_phone']);
                        $ship_email = mysqli_real_escape_string($conn,$_POST['ship_email']);
                    }
                }

                $orderTempo = date("YmdHis").rand(100,999);

                $cus_id = '0';

                if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){
                    $cus_id = $_SESSION['cus_id'];
                }else{
                    $cus_id = '0';
                }

                $itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

                if (isset($_SESSION['cart']) && $itemCount > 0) {

                    $itemIds = "";
                    foreach ($_SESSION['cart'] as $itemId) {
                        $itemIds = $itemIds . $itemId . ",";
                    }
            
                    $inputItems = rtrim($itemIds, ",");
                    $meSql = "SELECT * FROM `lc_product` WHERE `id` in ({$inputItems})";
                    $meQuery = mysqli_query($conn,$meSql);
                    $meQuery2 = mysqli_query($conn,$meSql);
                    $meCount = mysqli_num_rows($meQuery);
            
                }

                $total_price = 0;
                $num = 0;
                while ($meResult = mysqli_fetch_assoc($meQuery)){
                    $key = array_search($meResult['id'], $_SESSION['cart']);
                    $total_price = ((float)$total_price + ((float)$meResult['price'] * (float)$_SESSION['qty'][$key]));
                    $num++;
                }

                $paymeny_type = '0';

                // Payment Status 
                // 0 = Pending
                // 1 = Paid
                // 2 = Cancel

                $paymeny_status = "Pending";

                $sqlOrder = "INSERT INTO `lc_order` (`id`, `cus_id`, `order_number`, `order_date`, `order_total`, `payment_type`, `payment_status`, `type_address`, `bill_fname`, `bill_lname`, `bill_company`, `bill_address1`, `bill_address2`, `bill_city`, `bill_country`, `bill_zipcode`, `bill_phone`, `bill_email`, `ship_fname`, `ship_lname`, `ship_company`, `ship_address1`, `ship_address2`, `ship_city`, `ship_country`, `ship_zipcode`, `ship_phone`, `ship_email`) 
                VALUES (NULL, '".$cus_id."', '".$orderTempo."', current_timestamp(), '".$total_price."', '".$paymeny_type."', '".$paymeny_status."', '".$type_address."'
                , '".$bill_fname."', '".$bill_lname."', '".$bill_company_name."', '".$bill_address1."', '".$bill_address2."', '".$bill_city."', '".$bill_state."'
                , '".$bill_poscode."', '".$bill_phone."', '".$bill_email."', '".$ship_fname."', '".$ship_lname."', '".$ship_company_name."', '".$ship_address1."', '".$ship_address2."', '".$ship_city."', '".$ship_state."'
                , '".$ship_poscode."', '".$ship_phone."', '".$ship_email."');";
                $quOrder = mysqli_query($conn,$sqlOrder);
                $orderDB_id = mysqli_insert_id($conn);

                $numD = 0;
                while ($meResultd = mysqli_fetch_assoc($meQuery2)){

                    $keyD = array_search($meResultd['id'], $_SESSION['cart']);

                    if((float)$_SESSION['qty'][$keyD] > 0){
                        $sqlOrderDetail = "INSERT INTO `lc_order_detail` (`id`, `order_id`, `pro_id`, `pro_name`, `pro_img`, `pro_price`, `pro_qty`) 
                        VALUES (NULL, '".$orderDB_id."', '".$meResultd['id']."', '".$meResultd['name']."', '".$meResultd['images']."', '".$meResultd['price']."', '".$_SESSION['qty'][$keyD]."');";
                        $quOrderDetail = mysqli_query($conn,$sqlOrderDetail);
                    }
                    $numD++;
                }

                if($paymeny_type == '0'){
                    header("Location:../order-payment.php?orderID=".encode($orderTempo,LIAM_COINS_KEY));
                }else{
                    header("Location:../order-summary.php?orderID=".encode($orderTempo,LIAM_COINS_KEY));
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