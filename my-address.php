<?php include_once("include/include_app.php");

if(!Login::check($_SESSION['cus_id'])){
	header("Location:login.php");
}else{
	if(isset($_SESSION['cus_token']) && $_SESSION['cus_token'] != ""){
		if(getTokenLogin($conn,$_SESSION['cus_id']) != $_SESSION['cus_token']){
			unset($_SESSION['cus_token']);
			header("Location:logout.php");
		}
	}
}

if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){
	$sqlCustomer = "SELECT * FROM `lc_customer` WHERE `id` = '".$_SESSION['cus_id']."' LIMIT 1";
	$quCustomer = mysqli_query($conn,$sqlCustomer);
	$rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);

	$sqlCusBillAdd = "SELECT * FROM `lc_bill_addres` WHERE `cus_id` = '".$rowCustomer['id']."' LIMIT 1";
	$quCusBillAdd = mysqli_query($conn,$sqlCusBillAdd);
	$rowCusBillAdd = mysqli_fetch_array($quCusBillAdd, MYSQLI_ASSOC);

	$sqlCusShipAdd = "SELECT * FROM `lc_ship_addres` WHERE `cus_id` = '".$rowCustomer['id']."' LIMIT 1";
	$quCusShipAdd = mysqli_query($conn,$sqlCusShipAdd);
	$rowCusShipAdd = mysqli_fetch_array($quCusShipAdd, MYSQLI_ASSOC);

	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo SHIP_ADDRESS;?></title>
	<?php include_once('head_meta.php');?>
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		<?php include_once("header.php");?>

		<?php include_once("header_mobile.php");?>

		<?php include_once("nav_menu_mobile.php");?>

		<?php include_once("modal_search.php");?>
	</header>

	<?php include_once('cart.php');?>
	
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-0 p-r-0 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?php echo SHIP_ADDRESS;?>
			</span>

		</div>
	</div>

	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="">
						<h3 class="mtext-111 cl2 p-b-16 text-center">
							<?php echo SHIP_ADDRESS;?>
						</h3>

						<?php
							if(isset($_GET['action']) && $_GET['action'] != ""){

								if($_GET['action'] === "failure"){
									$msgErrors = "";
									if(isset($_GET['error']) && $_GET['error'] != ""){
										if($_GET['error'] == 1){$msgErrors = ' After changing your password within 24 hours, your account will not be able to change anything.';}
										else{}
									}
									?>
									<ul class="msg-error" role="alert">
										<li><strong><?php echo ERROR;?>:</strong><?php echo $msgErrors;?></li>
									</ul>
									<?php
								}
							}
						?>

						<div class="row p-t-30">
							<div class="col-md-4 col-lg-3 p-b-80">
								<?php include_once('account_menu.php')?>
							</div>
							<div class="col-md-8 col-lg-9 p-b-80">
								<p class="p-b-20 stext-115">The following addresses will be used on the checkout page by default.</p>
								<h3 class="mtext-111 cl2 p-b-20 p-t-20">
									<span>Billing address <a href="my-address-edit.php?action=<?php echo encode("bill",LIAM_COINS_KEY);?>" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4" style="display: inline-block;
    float: right;">Edit</a></span>
								</h3>
								<?php if($rowCusBillAdd['fname'] != ""){?><p class="stext-115"><?php echo $rowCusBillAdd['fname']." ".$rowCusBillAdd['lname'];?></p><?php }?>
								<?php if($rowCusBillAdd['company'] != ""){?><p class="stext-115"><?php echo $rowCusBillAdd['company'];?></p><?php }?>
								<?php if($rowCusBillAdd['address1'] != ""){?><p class="stext-115"><?php echo $rowCusBillAdd['address1']." ".$rowCusBillAdd['address2'];?></p><?php }?>
								<?php if($rowCusBillAdd['city'] != ""){?><p class="stext-115"><?php echo $rowCusBillAdd['city'];?></p><?php }?>
								<?php if($rowCusBillAdd['country'] != ""){?><p class="stext-115"><?php echo $rowCusBillAdd['country'];?></p><?php }?>
								<?php if($rowCusBillAdd['zipcode'] != ""){?><p class="stext-115"><?php echo $rowCusBillAdd['zipcode'];?></p><?php }?>
								
								<h3 class="mtext-111 cl2 p-b-20 p-t-20">
									<span>Shipping address <a href="my-address-edit.php?action=<?php echo encode("ship",LIAM_COINS_KEY);?>" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4" style="display: inline-block;
    float: right;">Edit</a></span>
								</h3>
								<?php if($rowCusShipAdd['fname'] != ""){?><p class="stext-115"><?php echo $rowCusShipAdd['fname']." ".$rowCusShipAdd['lname'];?></p><?php }?>
								<?php if($rowCusShipAdd['company'] != ""){?><p class="stext-115"><?php echo $rowCusShipAdd['company'];?></p><?php }?>
								<?php if($rowCusShipAdd['address1'] != ""){?><p class="stext-115"><?php echo $rowCusShipAdd['address1']." ".$rowCusShipAdd['address2'];?></p><?php }?>
								<?php if($rowCusShipAdd['city'] != ""){?><p class="stext-115"><?php echo $rowCusShipAdd['city'];?></p><?php }?>
								<?php if($rowCusShipAdd['country'] != ""){?><p class="stext-115"><?php echo $rowCusShipAdd['country'];?></p><?php }?>
								<?php if($rowCusShipAdd['zipcode'] != ""){?><p class="stext-115"><?php echo $rowCusShipAdd['zipcode'];?></p><?php }?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>	
	
		

	<?php include_once('footer.php');?>

	<?php include_once('back_to_top.php');?>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js?version=<?php echo date("YmdHis");?>"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js?version=<?php echo date("YmdHis");?>"></script>
	
</body>
</html>