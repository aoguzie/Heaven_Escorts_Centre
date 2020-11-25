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
              <label class="control-label">Images Model<br><small>Size : 1200px X 1486px</small></label>
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
            <div class="control-group">
              <label class="control-label">Images 02<br><small>Size : 1200px X 1486px</small></label>
              <div class="controls">
                <input type="file" name="pro_images2"/>
                <?php 
                if(isset($rowProE['images2'])){
                  $proIMG2 = "";
                  if(!empty($rowProE['images2'])){
                    $proIMG2 = $rowProE['images2'];
                    ?>
                    <br><br><img src="../uploads/product/<?php echo $proIMG2;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="pro_images_old2" value="<?php echo $proIMG2;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Images 03<br><small>Size : 1200px X 1486px</small></label>
              <div class="controls">
                <input type="file" name="pro_images3"/>
                <?php 
                if(isset($rowProE['images3'])){
                  $proIMG3 = "";
                  if(!empty($rowProE['images3'])){
                    $proIMG3 = $rowProE['images3'];
                    ?>
                    <br><br><img src="../uploads/product/<?php echo $proIMG3;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="pro_images_old3" value="<?php echo $proIMG3;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Images 04<br><small>Size : 1200px X 1486px</small></label>
              <div class="controls">
                <input type="file" name="pro_images4"/>
                <?php 
                if(isset($rowProE['images4'])){
                  $proIMG4 = "";
                  if(!empty($rowProE['images4'])){
                    $proIMG4 = $rowProE['images4'];
                    ?>
                    <br><br><img src="../uploads/product/<?php echo $proIMG4;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="pro_images_old4" value="<?php echo $proIMG4;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Images 05<br><small>Size : 1200px X 1486px</small></label>
              <div class="controls">
                <input type="file" name="pro_images5"/>
                <?php 
                if(isset($rowProE['images5'])){
                  $proIMG5 = "";
                  if(!empty($rowProE['images5'])){
                    $proIMG5 = $rowProE['images5'];
                    ?>
                    <br><br><img src="../uploads/product/<?php echo $proIMG5;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="pro_images_old5" value="<?php echo $proIMG5;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Images 06<br><small>Size : 1200px X 1486px</small></label>
              <div class="controls">
                <input type="file" name="pro_images6"/>
                <?php 
                if(isset($rowProE['images6'])){
                  $proIMG6 = "";
                  if(!empty($rowProE['images6'])){
                    $proIMG6 = $rowProE['images6'];
                    ?>
                    <br><br><img src="../uploads/product/<?php echo $proIMG6;?>" style="height: 150px;"/>
                    <?php
                  }
                  ?>
                  <input type="hidden" name="pro_images_old6" value="<?php echo $proIMG6;?>">
                  <?php
                }
                ?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><strong>Statistics</strong></label>
              <div class="controls">
                <hr>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Height :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_height" placeholder="" value="<?php if(isset($rowProE['pro_height'])){echo $rowProE['pro_height'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Eye Colour :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_eyecolour" placeholder="" value="<?php if(isset($rowProE['pro_eyecolour'])){echo $rowProE['pro_eyecolour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Bust :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_bust" placeholder="" value="<?php if(isset($rowProE['pro_bust'])){echo $rowProE['pro_bust'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Dress Size :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_dresssize" placeholder="" value="<?php if(isset($rowProE['pro_dresssize'])){echo $rowProE['pro_dresssize'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tattoos :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_tattoos" placeholder="" value="<?php if(isset($rowProE['pro_tattoos'])){echo $rowProE['pro_tattoos'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Piercings :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_piercings" placeholder="" value="<?php if(isset($rowProE['pro_piercings'])){echo $rowProE['pro_piercings'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Smoker :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_smoker" placeholder="" value="<?php if(isset($rowProE['pro_smoker'])){echo $rowProE['pro_smoker'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nationality :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_nationality" placeholder="" value="<?php if(isset($rowProE['pro_nationality'])){echo $rowProE['pro_nationality'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Languages :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_languages" placeholder="" value="<?php if(isset($rowProE['pro_languages'])){echo $rowProE['pro_languages'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Orientation :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_orientation" placeholder="" value="<?php if(isset($rowProE['pro_orientation'])){echo $rowProE['pro_orientation'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><strong>Rates</strong></label>
              <div class="controls">
                <hr>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">1 Hour :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_1hour" placeholder="" value="<?php if(isset($rowProE['pro_1hour'])){echo $rowProE['pro_1hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">1.5 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_15hour" placeholder="" value="<?php if(isset($rowProE['pro_15hour'])){echo $rowProE['pro_15hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">2 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_2hour" placeholder="" value="<?php if(isset($rowProE['pro_2hour'])){echo $rowProE['pro_2hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Dinner Date :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_dinnerhour" placeholder="" value="<?php if(isset($rowProE['pro_dinnerhour'])){echo $rowProE['pro_dinnerhour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">3 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_3hour" placeholder="" value="<?php if(isset($rowProE['pro_3hour'])){echo $rowProE['pro_3hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">4 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_4hour" placeholder="" value="<?php if(isset($rowProE['pro_4hour'])){echo $rowProE['pro_4hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">5 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_5hour" placeholder="" value="<?php if(isset($rowProE['pro_5hour'])){echo $rowProE['pro_5hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Overnight 10 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_10hour" placeholder="" value="<?php if(isset($rowProE['pro_10hour'])){echo $rowProE['pro_10hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Overnight 12 Hours :</label>
              <div class="controls">
                <input type="text" class="span11" name="pro_12hour" placeholder="" value="<?php if(isset($rowProE['pro_12hour'])){echo $rowProE['pro_12hour'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label"><strong>Availability</strong></label>
              <div class="controls">
                <hr>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Mon :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_mon" placeholder="" value="<?php if(isset($rowProE['pro_mon'])){echo $rowProE['pro_mon'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_mon2" placeholder="" value="<?php if(isset($rowProE['pro_mon2'])){echo $rowProE['pro_mon2'];}?>" style="width: 43%;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tue :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_tue" placeholder="" value="<?php if(isset($rowProE['pro_tue'])){echo $rowProE['pro_tue'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_tue2" placeholder="" value="<?php if(isset($rowProE['pro_tue2'])){echo $rowProE['pro_tue2'];}?>" style="width: 43%;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Wed :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_wed" placeholder="" value="<?php if(isset($rowProE['pro_wed'])){echo $rowProE['pro_wed'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_wed2" placeholder="" value="<?php if(isset($rowProE['pro_wed2'])){echo $rowProE['pro_wed2'];}?>" style="width: 43%;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Thu :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_thu" placeholder="" value="<?php if(isset($rowProE['pro_thu'])){echo $rowProE['pro_thu'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_thu2" placeholder="" value="<?php if(isset($rowProE['pro_thu2'])){echo $rowProE['pro_thu2'];}?>" style="width: 43%;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fri :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_fri" placeholder="" value="<?php if(isset($rowProE['pro_fri'])){echo $rowProE['pro_fri'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_fri2" placeholder="" value="<?php if(isset($rowProE['pro_fri2'])){echo $rowProE['pro_fri2'];}?>" style="width: 43%;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sat :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_sat" placeholder="" value="<?php if(isset($rowProE['pro_sat'])){echo $rowProE['pro_sat'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_sat2" placeholder="" value="<?php if(isset($rowProE['pro_sat2'])){echo $rowProE['pro_sat2'];}?>" style="width: 43%;">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sun :</label>
              <div class="controls">
                <input type="time" class="span11" name="pro_sun" placeholder="" value="<?php if(isset($rowProE['pro_sun'])){echo $rowProE['pro_sun'];}?>" style="width: 43%;"> <strong>TO</strong> <input type="time" class="span11" name="pro_sun2" placeholder="" value="<?php if(isset($rowProE['pro_sun2'])){echo $rowProE['pro_sun2'];}?>" style="width: 43%;">
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
