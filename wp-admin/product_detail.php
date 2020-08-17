<?php 
  include_once("include/include_app.php");
  
  $typeMode = '';
  $mode = '';
  $pro_id = '';

  if(isset($_GET['mode']) && $_GET['mode'] === "update"){
    if(isset($_GET['pro_id']) && $_GET['pro_id'] != ""){

      $typeMode = 'Update';
      $mode = 'update';
      $pro_id = decode($_GET['pro_id'],LIAM_COINS_KEY);
      
      $sqlProE = "SELECT * FROM `lc_product` WHERE `id` = '".$pro_id."' LIMIT 1";
      $quProE = mysqli_query($conn,$sqlProE);
      $rowProE = mysqli_fetch_array($quProE, MYSQLI_ASSOC);

    }else{
      header("Location:products.php");
    }
  }else if(isset($_GET['mode']) && $_GET['mode'] === "add"){
    $typeMode = 'Add';
    $mode = 'add';
  }else{
    header("Location:products.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo LIAM_COINS_TITLE;?></title>
<meta charset="UTF-8" />
<?php include_once('header_meta.php');?>

<script>
function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
      return false;

  return true;
}
function getCatsub(){

  var pro_category = document.getElementById("pro_category").value;

  $.post("include/call_api.php",
  {
    action: "get_subcategory",
    catid: pro_category
  },
  function(data, status){
   // alert("Data: " + data + "\nStatus: " + status);
   if(status === "success"){
      var dataSet = data.split("|");
      document.getElementById('pro_category_sub').innerHTML= dataSet[1];
      $("#pro_category_sub").val('').trigger('change')
   }

  });
}
</script>

</head>
<body>

<?php include_once('header.php');?>
<?php include_once('header_menu.php');?>
<?php include_once('sidebar_menu.php');?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="products.php" class="tip-bottom">Model</a> <a href="#" class="current"><?php echo $typeMode;?> Model</a> </div>
  <h1><?php echo $typeMode;?> Model</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Model Info</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" name="frm1" id="frm1" method="post" action="control/products.php" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_name" placeholder="Product Name" value="<?php if(isset($rowProE['name'])){echo $rowProE['name'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Age :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_age" placeholder="" onkeypress="return isNumberKey(event)" value="<?php if(isset($rowProE['age'])){echo $rowProE['age'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Description :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_description" placeholder="" value="<?php if(isset($rowProE['description'])){echo $rowProE['description'];}?>">
              </div>
            </div>
            <!-- <div class="control-group">
              <label class="control-label">Product Description:</label>
              <div class="controls">
                <textarea class="span11" name="pro_description"><?php if(isset($rowProE['description'])){echo strip_tags(stripslashes($rowProE['description']));}?></textarea>
              </div>
            </div> -->
            <div class="control-group">
              <label class="control-label">Category</label>
              <div class="controls">
                <select name="pro_category" id="pro_category" onchange="getCatsub()">
                  <?php 
                  $quCat = mysqli_query($conn,"SELECT * FROM `lc_category` ORDER BY id ASC");
                  while($rowCat = mysqli_fetch_array($quCat, MYSQLI_ASSOC)){
                  ?>
                  <option value="<?php echo $rowCat['id'];?>" <?php if(isset($rowProE['category']) && $rowProE['category'] == $rowCat['id']){echo 'selected';}?>><?php echo $rowCat['name'];?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="control-group hide">
              <label class="control-label">Sub Category</label>
              <div class="controls">
                <select name="pro_category_sub" id="pro_category_sub">
                  <?php
                    if(isset($rowProE['category']) && $rowProE['category'] != ""){
                      $quCatSub = mysqli_query($conn,"SELECT * FROM `lc_category_sub` WHERE `category` = '".$rowProE['category']."' ORDER BY id ASC");
                      while($rowCatSub = mysqli_fetch_array($quCatSub, MYSQLI_ASSOC)){
                        ?>
                        <option value="<?php echo $rowCatSub['id'];?>" <?php if(isset($rowProE['category_sub']) && $rowProE['category_sub'] == $rowCatSub['id']){echo 'selected';}?>><?php echo $rowCatSub['name'];?></option>
                        <?php
                      }
                    }else{
                      $quCatSub = mysqli_query($conn,"SELECT * FROM `lc_category_sub` WHERE `category` = '1' ORDER BY id ASC");
                      while($rowCatSub = mysqli_fetch_array($quCatSub, MYSQLI_ASSOC)){
                        ?>
                        <option value="<?php echo $rowCatSub['id'];?>"><?php echo $rowCatSub['name'];?></option>
                        <?php
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Images</label>
              <div class="controls">
                <input type="file" name="pro_images"/>
                <?php 
                if(isset($rowProE['images'])){
                  $proIMG = "";
                  if(!empty($rowProE['images'])){
                    $proIMG = $rowProE['images'];
                    ?>
                    <br><br><img src="../uploads/product/<?php echo $proIMG;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="pro_images_old" value="<?php echo $proIMG;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group hide">
              <label class="control-label">Detail :</label>
              <div class="controls">
                <textarea class="textarea_editor span11" rows="6" name="pro_detail" placeholder="Enter text ..."><?php if(isset($rowProE['detail'])){echo strip_tags(stripslashes($rowProE['detail']));}?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="pro_status">
                  <option value="1" <?php if(isset($rowProE['status']) && $rowProE['status'] == '1'){echo 'selected';}?>>Enable</option>
                  <option value="0" <?php if(isset($rowProE['status']) && $rowProE['status'] == '0'){echo 'selected';}?>>Disable</option>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <input type="hidden" name="_token" value="<?php echo Token::generate();?>"/>
              <input type="hidden" name="mode" value="<?php echo $mode;?>"/>
              <input type="hidden" name="pro_id" value="<?php if($pro_id != ""){echo encode($pro_id,LIAM_COINS_KEY);}?>"/>
              <a href="products.php"><button type="button" class="btn btn-danger">Cancel</button></a>
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
