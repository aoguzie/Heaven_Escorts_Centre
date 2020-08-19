<?php 
  include_once("include/include_app.php");
  
  // $typeMode = '';
   $mode = '';
  // $setting_id = '';

  if(isset($_GET['mode']) && $_GET['mode'] === "update"){
    $mode = 'update';
    $sqlProE = "SELECT * FROM `lc_setting` WHERE 1 LIMIT 1";
    $quProE = mysqli_query($conn,$sqlProE);
    $rowProE = mysqli_fetch_array($quProE, MYSQLI_ASSOC);

  }else{
    $mode = 'add';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo LIAM_COINS_TITLE;?></title>
<meta charset="UTF-8" />
<?php include_once('header_meta.php');?>

</head>
<body>

<?php include_once('header.php');?>
<?php include_once('header_menu.php');?>
<?php include_once('sidebar_menu.php');?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="index.php" class="tip-bottom">Setting</a></div>
  <h1>Setting</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Website Color</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" name="frm1" id="frm1" method="post" action="control/setting.php" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Link :</label>
              <div class="controls">
                <input type="color" class="span11" name="link_color" value="<?php if(isset($rowProE['link_color'])){echo $rowProE['link_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Link Hover :</label>
              <div class="controls">
                <input type="color" class="span11" name="link2_color" value="<?php if(isset($rowProE['link2_color'])){echo $rowProE['link2_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Button :</label>
              <div class="controls">
                <input type="color" class="span11" name="button_color" value="<?php if(isset($rowProE['button_color'])){echo $rowProE['button_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Button Hover :</label>
              <div class="controls">
                <input type="color" class="span11" name="button2_color" value="<?php if(isset($rowProE['button2_color'])){echo $rowProE['button2_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Background Top Bar :</label>
              <div class="controls">
                <input type="color" class="span11" name="bgtopbar_color" value="<?php if(isset($rowProE['bgtopbar_color'])){echo $rowProE['bgtopbar_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Background Top :</label>
              <div class="controls">
                <input type="color" class="span11" name="bgtop_color" value="<?php if(isset($rowProE['bgtop_color'])){echo $rowProE['bgtop_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Background Footer :</label>
              <div class="controls">
                <input type="color" class="span11" name="bgfooter_color" value="<?php if(isset($rowProE['bgfooter_color'])){echo $rowProE['bgfooter_color'];}?>" style="width: 80px;">
              </div>
            </div>
            <div class="form-actions">
              <input type="hidden" name="_token" value="<?php echo Token::generate();?>"/>
              <input type="hidden" name="mode" value="<?php echo $mode;?>"/>
              <input type="hidden" name="setting_id" value="<?php if($setting_id != ""){echo encode($setting_id,LIAM_COINS_KEY);}?>"/>
              <a href="index.php"><button type="button" class="btn btn-danger">Cancel</button></a>
              <button type="submit" class="btn btn-success"> Save </button></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>

<?php include_once("footer.php");?>

<script src="js/jquery.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.ui.custom.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap-colorpicker.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap-datepicker.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.toggle.buttons.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/masked.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.uniform.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/select2.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.form_common.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/wysihtml5-0.3.0.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.peity.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap-wysihtml5.js?version=<?php echo date("YmdHis");?>"></script> 
<script>
	$('.textarea_editor').wysihtml5();
</script>
</body>
</html>
