<?php 
	include_once("include/include_app.php");
	$keyrecaptcha = LIAM_COINS_KEY_GOOGLE;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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
	
	<!-- breadcrumb -->
	<!-- <div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			
			<span class="stext-109 cl4">
				<?php echo REGISTER;?>
			</span>

		</div>
	</div> -->

	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
					<form name="frm" method="post" action="control/login.php">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							<?php echo LOGIN_MSG;?>
						</h4>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_email" placeholder="Username or Email address" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" style="margin-bottom: 0px;" type="password" name="cus_password" placeholder="Your Password" maxlength="20" required>
							<img class="how-pos4 pointer-none" src="images/icons/icon-password.png" alt="ICON">
						</div>

						<div class="m-b-20 how-pos4-parent text-center">
							<div style="display: inline-block;" class="g-recaptcha" data-callback="makeaction" data-sitekey="<?php echo $keyrecaptcha; ?>"></div>
						</div>

						<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
						<button type="submit" id="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" disabled>
							Submit
						</button>

						<div class="m-b-20 m-t-20 how-pos4-parent text-center">
							<a href="reset-password.php">Reset your password</a>
						</div>
					</form>
					<?php
					if(isset($_GET['action']) && $_GET['action'] != ""){
						if($_GET['action'] === "failure"){
							if($_GET['error'] === "cus_lock"){
								?>
								<ul class="msg-error" role="alert">
									<li><strong><?php echo ERROR;?>: Your username is suspended 30 minutes because you have entered the wrong password more than 5 times.</strong></li>
								</ul>
								<?php
							}else{
								?>
								<ul class="msg-error" role="alert">
									<li><strong><?php echo ERROR;?>:</strong> <?php echo LOGIN_ERROR_MSG;?></li>
								</ul>
								<?php
							}
						}
					}
				?>
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