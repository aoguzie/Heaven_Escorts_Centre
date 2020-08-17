<?php 

include_once("../include/include_app.php");

$kfield = $kvalue = "";

reset($_POST);
while (list($key, $value) = each($_POST)) {
    //echo "Key: $key; Value: $value<br />\n";
	$kfield .= ", " .'`'.$key.'`';
	$kvalue .= ", " ."'".$value."'";
}

$sqlPaypal = "insert into `lc_paypal_datafeed` ( " . substr($kfield,2) . ")  values (". substr($kvalue,2) . ");";

$resultfile = fopen("paypal_datafeed.txt", "a") or die("Unable to open file!");
	
$txt = date("Y-m-d H:i:s")." => ".$sqlPaypal."\r\n";
					
fwrite($resultfile, $txt);
					
fclose($resultfile);

$quPaypal = mysqli_query($conn,$sqlPaypal);
$rowPaypal = mysqli_fetch_array($quPaypal, MYSQLI_ASSOC);

$sqlOrder = "UPDATE `lc_order` SET `payment_status` = '".$_POST['payment_status']."' WHERE `order_number` = '".$_POST['invoice']."';";
$quPaypal = mysqli_query($conn,$sqlOrder);
$rowPaypal = mysqli_fetch_array($quPaypal, MYSQLI_ASSOC);

?>