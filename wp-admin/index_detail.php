<?php 
  include_once("include/include_app.php");
  
  $typeMode = '';
  $mode = '';
  $banner_id = '';

  if(isset($_GET['mode']) && $_GET['mode'] === "update"){
    if(isset($_GET['banner_id']) && $_GET['banner_id'] != ""){

      $typeMode = 'Update';
      $mode = 'update';
      $banner_id = decode($_GET['banner_id'],LIAM_COINS_KEY);
      
      $sqlProE = "SELECT * FROM `lc_banner` WHERE `id` = '".$banner_id."' LIMIT 1";
      $quProE = mysqli_query($conn,$sqlProE);
      $rowProE = mysqli_fetch_array($quProE, MYSQLI_ASSOC);

    }else{
      header("Location:index.php");
    }
  }else if(isset($_GET['mode']) && $_GET['mode'] === "add"){
    $typeMode = 'Add';
    $mode = 'add';
  }else{
    header("Location:index.php");
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
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="index.php" class="tip-bottom">Banners</a> <a href="#" class="current"><?php echo $typeMode;?> Banners</a> </div>
  <h1><?php echo $typeMode;?> Banners</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Banners Info</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" name="frm1" id="frm1" method="post" action="control/banner.php" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Banner Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="banner_name" placeholder="Banner Name" value="<?php if(isset($rowProE['name'])){echo $rowProE['name'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Banner Detail :</label>
              <div class="controls">
                <input type="text" class="span11" name="banner_detail" placeholder="Banner Detail" value="<?php if(isset($rowProE['detail'])){echo $rowProE['detail'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Banners Images</label>
              <div class="controls">
                <input type="file" name="banner_images"/>
                <?php 
                if(isset($rowProE['images'])){
                  $proIMG = "";
                  if(!empty($rowProE['images'])){
                    $proIMG = $rowProE['images'];
                    ?>
                    <br><br><img src="../uploads/banner/<?php echo $proIMG;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="banner_images_old" value="<?php echo $proIMG;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Banners Link</label>
              <div class="controls">
                <input type="text" class="span11" name="banner_link" placeholder="Banner Link" value="<?php if(isset($rowProE['link'])){echo $rowProE['link'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Link Taget</label>
              <div class="controls">
                <select name="banner_target">
                  <option value="1" <?php if(isset($rowProE['target']) && $rowProE['target'] == '1'){echo 'selected';}?>>Opens the linked in a new window </option>
                  <option value="0" <?php if(isset($rowProE['target']) && $rowProE['target'] == '0'){echo 'selected';}?>>Opens the linked in the parent frame </option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Banners Status</label>
              <div class="controls">
                <select name="banner_status">
                  <option value="1" <?php if(isset($rowProE['status']) && $rowProE['status'] == '1'){echo 'selected';}?>>Enable</option>
                  <option value="0" <?php if(isset($rowProE['status']) && $rowProE['status'] == '0'){echo 'selected';}?>>Disable</option>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <input type="hidden" name="_token" value="<?php echo Token::generate();?>"/>
              <input type="hidden" name="mode" value="<?php echo $mode;?>"/>
              <input type="hidden" name="banner_id" value="<?php if($banner_id != ""){echo encode($banner_id,LIAM_COINS_KEY);}?>"/>
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
