<?php include_once("include/include_app.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<?php include_once('head_meta.php');?>
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		<?php include_once("header.php");?>

		<?php include_once("header_mobile.php");?>

		<?php include_once("nav_menu_mobile.php");?>

		<?php include_once("modal_search.php");?>

		<script>
			function check_password(){

				var pwdChk = $('#cus_password').val();

				var Atleast8 = new RegExp("^(?=.{8,})");
				var specialCharac = new RegExp("^(?=.*[!@#\$%\^&\*])");
				var numRegex = new RegExp("^(?=.*[0-9])");
				
				if(Atleast8.test(pwdChk)){
					$('#p1f').addClass('hide');
					$('#p1s').removeClass('hide');
				}else{
					$('#p1f').removeClass('hide');
					$('#p1s').addClass('hide');
				}

				if(specialCharac.test(pwdChk)){
					$('#p2f').addClass('hide');
					$('#p2s').removeClass('hide');
				}else{
					$('#p2f').removeClass('hide');
					$('#p2s').addClass('hide');
				}

				if(numRegex.test(pwdChk)){
					$('#p3f').addClass('hide');
					$('#p3s').removeClass('hide');
				}else{
					$('#p3f').removeClass('hide');
					$('#p3s').addClass('hide');
				}
			}

			function check_confirmpassword(){

				var pwdChk = $('#cus_password').val();
				var pwdChk2 = $('#cus_repeatpassword').val();

				if(pwdChk != pwdChk2){
					$('#cus_repeatpassword').focus();
					$('#p4f').removeClass('hide');
					$('#p4s').addClass('hide');
					$('#chkPwd').removeClass('hide');
				}else{
					$('#p4f').addClass('hide');
					$('#p4s').removeClass('hide');
					$('#chkPwd').addClass('hide');
				}

				if(pwdChk2 == ""){
					$('#p4f').removeClass('hide');
					$('#p4s').addClass('hide');
				}
				
			}

			function check_confirmemail(){

				var emChk = $('#cus_email').val();
				var emChk2 = $('#cus_confirm_email').val();

				if(emChk != emChk2){
					$('#cus_confirm_email').focus();
					$('#chkEmail').removeClass('hide');
				}else{
					$('#chkEmail').addClass('hide');
				}

			}

			

			function validateForm(){

				var passwordRegex = new RegExp("^(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
				var pwdChk = $('#cus_password').val();
				var pwdChk2 = $('#cus_repeatpassword').val();

				var cus_email = $('#cus_email').val();
				var cus_confirm_email = $('#cus_confirm_email').val();
		
				if(!passwordRegex.test(pwdChk)){
					$('#cus_password').focus();
					return false;
				}
				
				if(pwdChk != pwdChk2){
					$('#cus_repeatpassword').focus();
					$('#chkPwd').removeClass('hide');
					return false;
				}else{
					$('#chkPwd').addClass('hide');
				}

				if(cus_email != cus_confirm_email){
					$('#cus_confirm_email').focus();
					$('#chkEmail').removeClass('hide');
					return false;
				}else{
					$('#chkEmail').addClass('hide');
				}
				
				if(!$('#cus_chkterm').prop('checked')){
					$('#cus_chkterm').focus();
					return false;
				}

			}
		</script>

	</header>

	<?php include_once('cart.php');?>


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
		<div class="flex-w flex-tr">
				<div class="size-215 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
					<form name="frmregister" id="frmregister" method="post" action="control/register.php" onsubmit="return validateForm()">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							REGISTER
						</h4>

						<?php
							if(isset($_GET['action']) && $_GET['action'] != ""){
								if($_GET['action'] === "failure"){
									$errorMSG = '';
									if($_GET['error'] === "username"){
										$errorMSG = 'This Username : '.$_GET['val'].' already exists';
									}else if($_GET['error'] === "email"){
										$errorMSG = 'This Email : '.$_GET['val'].' already exists';
									}
									?>
									<ul class="msg-error" role="alert" style="margin-bottom: 20px;">
										<li><strong><?php echo ERROR;?>:</strong> <?php echo $errorMSG;?></li>
									</ul>
									<?php
								}
							}
						?>

						<div class="row">
							<div class="col-12 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_username" placeholder="User name" required>
							</div>
							<div class="col-12 p-b-20">
								<p class="p-b-10">Choose a password meeting the following criteria</p>
								<p><span id="p1f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p1s" class="hide"><img src="images/icon_check.jpg" width="18"></span> Your input was to short (at least 8 characters).</p>
								<p><span id="p2f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p2s" class="hide"><img src="images/icon_check.jpg" width="18"></span> At least one or more special characters included.</p>
								<p><span id="p3f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p3s" class="hide"><img src="images/icon_check.jpg" width="18"></span> At least one or more numbers included.</p>
								<p><span id="p4f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p4s" class="hide"><img src="images/icon_check.jpg" width="18"></span> Confirmed repeat password.</p>
							</div>
							<div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="password" id="cus_password" name="cus_password" placeholder="Password" maxlength="20" required onkeyup="check_password();">
							</div>
							<div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="password" id="cus_repeatpassword" name="cus_repeatpassword" placeholder="Repeat Password" maxlength="20" required onkeyup="check_confirmpassword();">
								<small class="p-l-30 hide" id="chkPwd" style="color: red;font-weight: bold;">Passwords do not match.</small>
							</div>
							<!-- <div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_company" placeholder="Company">
							</div> -->
							<div class="col-12 p-b-20">
								<select class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="background: none;
	border: 1px solid #dddddd;" name="cus_title" id="cus_title" required>
									<option value="Mr">Mr</option>
									<option value="Mrs">Ms</option>
									<option value="Dr">Dr</option>
									<option value="Prof">Prof</option>
									<option value="Prof. Dr">Prof. Dr</option>
								</select>
							</div>
							<div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_fname" placeholder="First name" required>
							</div>
							<div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_lname" placeholder="Last name" required>
							</div>
							<!-- <div class="col-12 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_address1" placeholder="Street address" required>
							</div>
							<div class="col-12 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_address2" placeholder="Street address line 2">
							</div>
							<div class="col-12 col-md-4 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_zipcode" placeholder="Postal Code / Zip" required>
							</div>
							<div class="col-12 col-md-8 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="text" name="cus_city" placeholder="City" required>
							</div> -->
							<div class="col-12 p-b-20 hide">
								<select style="background: none;
    border: 1px solid #dddddd;" required="required" class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30"  name="cus_country" id="cus_country">
									<?php 
										$sqlCountry = "SELECT * FROM `lc_countries`";
										$qucountry = mysqli_query($conn,$sqlCountry);
										while($rowCountry = mysqli_fetch_array($qucountry, MYSQLI_ASSOC)){
									?>
										<option value="<?php echo $rowCountry['country_name'];?>" <?php if($rowCountry['country_name'] === 'Germany'){echo 'selected';}?>><?php echo $rowCountry['country_name'];?></option>
									<?php }?>
									</select>
							</div>
							<!-- <div class="col-12 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="tel" name="cus_phone" placeholder="Phone number" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
							</div> -->
							<div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="email" name="cus_email" id="cus_email" placeholder="Email address" required>
							</div>
							<div class="col-12 col-md-6 p-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="margin-bottom: 0px;" type="email" name="cus_confirm_email" id="cus_confirm_email" placeholder="Confirm your email address" required onkeyup="check_confirmemail();">
								<small class="p-l-30 hide" id="chkEmail" style="color: red;font-weight: bold;">Email do not match.</small>
							</div>
							<!-- <div class="col-12 p-b-20">
								<textarea class="stext-111 cl2 plh3 size-124 p-lr-30 p-tb-15" name="cus_references" placeholder="References"></textarea>
							</div> -->
							<div class="col-12 p-b-20 text-center">
								<input type="checkbox" style="display: inline-block;" class="form-check-input" id="cus_chkterm" name="cus_chkterm" required>
								<label style="display: inline-block;" class="form-check-label" for="exampleCheck1">I have read and understood the Terms of Use and <a href="terms-and-condition.php" target="_blank" class="hov-cl1">privacy policy</a> and agree to them.</label>
							</div>
						</div>

						<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
						<div class="text-center">
							<button type="submit" class="stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
								Register
							</button>
						</div>
						<!-- <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Submit
						</button> -->
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