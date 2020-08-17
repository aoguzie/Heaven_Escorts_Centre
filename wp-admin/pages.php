<?php 
  include_once("include/include_app.php");

  if(!isset($_SESSION['staff_id'])){
    header("Location:login.php");
  }else{
    if(!Login::check($_SESSION['staff_id'])){
      header("Location:login.php");
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
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pages</a> </div>
    <h1>Pages</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Pages List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Page Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sqlPageList = "SELECT * FROM `lc_page` WHERE 1 ORDER BY `name` ASC";
                $quPageList = @mysqli_query($conn, $sqlPageList);
                $numPage = 1;
                
                while($rowPageList = mysqli_fetch_array($quPageList, MYSQLI_ASSOC)){

                ?>
                <tr class="gradeX">
                  <td style="vertical-align: middle;"><center><?php echo sprintf("%04d",$numPage++)?></center></td>
                  <td style="vertical-align: middle;"><?php echo $rowPageList['name'];?></td>
                  <td style="vertical-align: middle;">
                    <center>
                      <a href="page_detail.php?page_id=<?php echo encode($rowPageList['id'],LIAM_COINS_KEY);?>&mode=update"><button type="button" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button></a> 
                    </center>
                  </td>
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
