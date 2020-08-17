<?php
 include_once("../include/include_app.php");

 if(isset($_GET['item_number']) && $_GET['item_number'] != ""){

     $orderID = $_GET['item_number'];

     $sqlCusOrder = "SELECT * FROM `lc_order` WHERE `order_number` = '".$orderID."' LIMIT 1";
     $quCusOrder = mysqli_query($conn,$sqlCusOrder);
     $rowCusOrder = mysqli_fetch_array($quCusOrder, MYSQLI_ASSOC);

     if($rowCusOrder['id'] !== ""){
         unset($_SESSION['cart']);
         unset($_SESSION['qty']);
         header("Location:../order-summary.php?orderID=".encode($rowCusOrder['order_number'],LIAM_COINS_KEY));
     }else{
        header("Location:../index.php");
     }

 }else{
     header("Location:../index.php");
 }

?>