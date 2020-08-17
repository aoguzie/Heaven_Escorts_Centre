<?php 
  include_once("include/include_app.php");

  if(!isset($_SESSION['staff_id'])){
    header("Location:login.php");
  }else{
    if(!Login::check($_SESSION['staff_id'])){
      header("Location:login.php");
    }
  }


  if(isset($_GET['mode'],$_GET['pro_id'])){
    if($_GET['mode'] === "delete" && $_GET['pro_id'] != ""){
      if($_GET['images'] !== 'none.jpg'){
        @unlink("../uploads/product/".$_GET['images']);
      }
      $pro_id = decode($_GET['pro_id'],LIAM_COINS_KEY);
      @mysqli_query($conn,"DELETE FROM `lc_product` WHERE `id` = '".$pro_id."'");
      header("Location:products.php");
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo LIAM_COINS_TITLE;?></title>
<?php include_once('header_meta.php');?>
</head>
<body>
<?php include_once('header.php');?>
<?php include_once('header_menu.php');?>
<?php include_once('sidebar_menu.php');?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Model</a> </div>
    <h1>Model</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="">
      <div class="btn-group">
        <a href="product_detail.php?mode=add"><button class="btn btn-success">Add Model</button></a>
      </div>
      <div class="btn-group">
        <button class="btn btn-primary"><?php if(isset($_GET['cat_id']) && $_GET['cat_id'] != ""){echo get_category_name($conn,decode($_GET['cat_id'],LIAM_COINS_KEY));}else{echo "All Categories";}?></button>
        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
        <ul class="dropdown-menu">
        <!-- <li><a href="products.php">New Arrivals</a></li> -->
        <?php 
          
          $quCat = mysqli_query($conn,"SELECT * FROM `lc_category` WHERE 1 ORDER BY id ASC");
          while($rowCat = mysqli_fetch_array($quCat, MYSQLI_ASSOC)){
          ?>
          <li><a href="products.php?cat_id=<?php echo encode($rowCat['id'],LIAM_COINS_KEY);?>"><?php echo $rowCat['name'];?></a></li>
          <?php }?>
        </ul>
      </div>
      <div class="btn-group hide">
        <button class="btn btn-warning"><?php if(isset($_GET['catsub_id']) && $_GET['catsub_id'] != ""){echo get_category_sub_name($conn,decode($_GET['catsub_id'],LIAM_COINS_KEY));}else{echo "New Arrivals";}?></button>
        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle"><span class="caret"></span></button>
        <ul class="dropdown-menu">
        
          <?php
            if(isset($_GET['cat_id']) && $_GET['cat_id'] != ""){
              ?>
              <li><a href="products.php?cat_id=<?php echo $_GET['cat_id'];?>">New Arrivals</a></li>
              <?php

              $cat_idD = decode($_GET['cat_id'],LIAM_COINS_KEY);
              $quCatSub = mysqli_query($conn,"SELECT * FROM `lc_category_sub` WHERE 1 AND `category` = '".$cat_idD."' ORDER BY id ASC");
              while($rowCatSub = mysqli_fetch_array($quCatSub, MYSQLI_ASSOC)){
                ?>
                <li><a href="products.php?cat_id=<?php echo $_GET['cat_id'];?>&catsub_id=<?php echo encode($rowCatSub['id'],LIAM_COINS_KEY);?>"><?php echo $rowCatSub['name'];?></a></li>
                <?php
              }
            }else{
              ?>
              <li><a href="products.php">New Arrivals</a></li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Model List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Images</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sqlCondition = "";

                if(isset($_GET['cat_id']) && $_GET['cat_id'] != ""){
                  $cat_idD = decode($_GET['cat_id'],LIAM_COINS_KEY);
                  $sqlCondition .= " AND category = '".$cat_idD."'";
                }

                if(isset($_GET['catsub_id']) && $_GET['catsub_id'] != ""){
                  $catsub_idD = decode($_GET['catsub_id'],LIAM_COINS_KEY);
                  $sqlCondition .= " AND category_sub = '".$catsub_idD."'";
                }

                $sqlProList = "SELECT * FROM `lc_product` WHERE 1 ".$sqlCondition." ORDER BY id DESC";
                $quProList = @mysqli_query($conn, $sqlProList);
                $numPro = 1;
                
                while($rowProList = mysqli_fetch_array($quProList, MYSQLI_ASSOC)){

                  $proIMG = '';
                  if(!empty($rowProList['images'])){
                    $proIMG = $rowProList['images'];
                  }else{
                    $proIMG = 'none.jpg';
                  }

                ?>
                <tr class="gradeX">
                  <td style="vertical-align: middle;"><center><?php echo sprintf("%04d",$numPro++)?></center></td>
                  <td style="vertical-align: middle;"><center><img src="../uploads/product/<?php echo $proIMG;?>" style="height: 120px;"/></center></td>
                  <td style="vertical-align: middle;"><?php echo $rowProList['name'];?></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowProList['age'];?></center></td>
                  <td style="vertical-align: middle;"><center><?php if($rowProList['status'] == '1'){?><span class="label label-success">Enable</span><?php }else{?><span class="label label-important">Disable</span><?php }?></center></td>
                  <td style="vertical-align: middle;">
                    <center>
                      <a href="product_detail.php?pro_id=<?php echo encode($rowProList['id'],LIAM_COINS_KEY);?>&mode=update"><button type="button" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button></a> 
                      <a href="products.php?pro_id=<?php echo encode($rowProList['id'],LIAM_COINS_KEY);?>&mode=delete&images=<?php echo $proIMG;?>" onclick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger btn-mini"><i class="icon-remove"></i></button></a>
                    </center></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('footer.php');?>

<script src="js/jquery.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.ui.custom.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.uniform.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/select2.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.dataTables.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.tables.js?version=<?php echo date("YmdHis");?>"></script>
</body>
</html>
