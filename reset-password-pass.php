<?php 
	include_once("include/include_app.php");
	$keyrecaptcha = LIAM_COINS_KEY_GOOGLE;

	if(isset($_GET['id']) && $_GET['id'] != ""){
		$decodeLink = decode($_GET['id'],LIAM_COINS_KEY);
		$valLink = explode('|',$decodeLink);
		$resetID = $valLink[0];
		$resetToken = $valLink[1];
		$cus_email = $valLink[2];

		$sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND `cus_token` = '".$resetToken."' LIMIT 1";
		$quChkReset = mysqli_query($conn,$sqlChkReset);
		$rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

		if($rowReset['id'] != ""){
			$emailSub = explode('@',$rowReset['cus_email']);
			$emailSubF = substr($emailSub[0],0,1);
			$emailSubB = substr($emailSub[0],-1);
			$emailSubShow = $emailSubF.'***'.$emailSubB.'@'.$emailSub[1];
		}else{
			die();
		}

	}else{
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset Password</title>
	<?php include_once('head_meta.php');?>
	<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
	<script> 
		function makeaction(){
				document.getElementById('submit').disabled = false;  
		}
  	</script>
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


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
					<form name="frm" method="post" action="control/reset-password-send.php">
						<h4 class="mtext-105 cl2 txt-center p-b-20">
							Get help signing in
						</h4>
						<p class="text-center p-b-20">For your security, we need to make sure it's really you. How do you want us to contact you?</p>
						
						<?php
							if(isset($_GET['action']) && $_GET['action'] != ""){
								if($_GET['action'] === "failure"){
									?>
										<div class="p-b-20">
											<ul class="msg-error" role="alert">
												<li><strong><?php echo ERROR;?>:</strong> We ran into a problem. Please try again.</li>
											</ul>
										</div>
										<?php
								}
							}
						?>
								
						<div class="m-b-20 how-pos4-parent text-center">
							We'll email you at <strong><?php echo $emailSubShow;?></strong> with a link.
						</div>
						
						<div class="m-b-20 how-pos4-parent text-center">
							<div style="display: inline-block;" class="g-recaptcha" data-callback="makeaction" data-sitekey="<?php echo $keyrecaptcha; ?>"></div>
						</div>

						<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
						<input type="hidden" name="_token2" value="<?php echo $_GET['id'];?>">
						<button type="submit" id="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" disabled>
							Receive Email
						</button>

						<div class="m-b-20 m-t-20 how-pos4-parent text-center">
							<a href="contact-us.php">Contact Support</a>
						</div>

					</form>
					
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