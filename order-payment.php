<?php 
    include_once("include/include_app.php");

    if(isset($_GET['orderID']) && $_GET['orderID'] != ""){

		$orderID = decode($_GET['orderID'],LIAM_COINS_KEY);

		$sqlCusOrder = "SELECT * FROM `lc_order` WHERE `order_number` = '".$orderID."' LIMIT 1";
		$quCusOrder = mysqli_query($conn,$sqlCusOrder);
		$rowCusOrder = mysqli_fetch_array($quCusOrder, MYSQLI_ASSOC);

		if($rowCusOrder['id'] === ""){
			header("Location:index.php");
		}

	}else{
		header("Location:index.php");
	}

    // unset($_SESSION['cart']);
    // unset($_SESSION['qty']);

    // header("Location:order-summary.php?orderID=".$_GET['orderID']);
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Paypal Test</title>
<style>
html, body
{
    height: 100%;
    margin:0;
    padding:0;
}

div {
    position:relative;
    height: 100%;
    width:100%;
}

div img {
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    margin:auto;
}
</style>
</head>
<body onload="document.frm1.submit()">
<body>

<form action="<?php echo LIAM_COINS_PAYPAL_ACCOUNT_URL;?>" method="post" name="frm1">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="<?php echo LIAM_COINS_PAYPAL_ACCOUNT;?>">
  <input type="hidden" name="item_name" value="LiamCoins">
  <input type="hidden" name="item_number" value="<?php echo $rowCusOrder['order_number'];?>">
  <input type="hidden" name="amount" value="<?php echo $rowCusOrder['order_total'];?>"><br>
  <input type="hidden" name="tax" value="0">
  <input type="hidden" name="quantity" value="1">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="invoice" value="<?php echo $rowCusOrder['order_number'];?>">
  <input type="hidden" name="return" value="<?php echo DOMAIN_SITE;?>/paypal/paypal_return.php" />
  <input type="hidden" name="cancel_return" value="<?php echo DOMAIN_SITE;?>/shoping-cart.php" />
  <input type="hidden" name="cbt" value="Return to Liam Coins">
  
</form>

<div><img src="images/paypal_loadding.gif"></div>

</body>
</html>
