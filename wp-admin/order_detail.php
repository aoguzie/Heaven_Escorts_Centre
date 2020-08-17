<?php 
  include_once("include/include_app.php");

  $order_id = '';

  if(isset($_GET['order_id']) && $_GET['order_id'] != ""){

    $order_id = decode($_GET['order_id'],LIAM_COINS_KEY);
    
    $sqlProE = "SELECT * FROM `lc_order` WHERE `id` = '".$order_id."' LIMIT 1";
    $quProE = mysqli_query($conn,$sqlProE);
    $rowProE = mysqli_fetch_array($quProE, MYSQLI_ASSOC);

  }else{
    header("Location:orders.php");
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
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Orders</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders Info</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Order Number</th>
                  <th>Date</th>
                  <th>Total</th>
                  <th>Payment Method</th>
                  <th>Payment Status</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td class="center"><center><?php echo $rowProE['order_number'];?></center></td>
                  <td class="center"><center><?php echo $rowProE['order_date'];?></center></td>
                  <td class="center"><center><?php echo number_format($rowProE['order_total'],2);?></center></td>
                  <td class="center"><center><?php echo "Paypal";?></center></td>
                  <td class="center"><center><?php echo $rowProE['payment_status'];?></center></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products info</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Images</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $total_price = 0;
                $num = 0;
                $sqlOrderDetail = "SELECT * FROM `lc_order_detail` WHERE `order_id` = '".$rowProE['id']."' ORDER BY `id` ASC";
                $qyOrderDetail = mysqli_query($conn,$sqlOrderDetail);
                while ($rowOrderDetail = mysqli_fetch_assoc($qyOrderDetail)){

                  $total_price = ((float)$total_price + ((float)$rowOrderDetail['pro_price']*(float)$rowOrderDetail['pro_qty']));
										
                  $proImages = '';
                  if(!empty($rowOrderDetail['pro_img'])){
                    $proImages = '../uploads/product/'.$rowOrderDetail['pro_img'];
                  }else{
                    $proImages = '../uploads/product/none.jpg';
                  }
                ?>
                <tr class="odd gradeX">
                  <td class="center" style="vertical-align: middle;"><center><img src="<?php echo $proImages;?>" alt="<?php echo $rowOrderDetail['pro_name'];?>" width="60">
												</td></center></td>
                  <td class="center" style="vertical-align: middle;"><?php echo $rowOrderDetail['pro_name'];?></td>
                  <td class="center" style="vertical-align: middle;"><center><?php echo number_format($rowOrderDetail['pro_price'],2);?></center></td>
                  <td class="center" style="vertical-align: middle;"><center><?php echo $rowOrderDetail['pro_qty'];?></center></td>
                  <td class="center" style="vertical-align: middle;"><center><?php echo (float)$rowOrderDetail['pro_price']*(float)$rowOrderDetail['pro_qty'];?></center></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Address Info</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>BILLING ADDRESS</th>
                  <th>SHIPPING ADDRESS</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td class="center">
                  <?php if($rowProE['bill_fname'] != ""){?><p><strong>Full Name :</strong> <?php echo $rowProE['bill_fname'].' '.$rowProE['bill_lname'];?></p><?php }?>
												<?php if($rowProE['bill_company'] != ""){?><p><strong>Company Name :</strong> <?php echo $rowProE['bill_company'];?></p><?php }?>
												<?php if($rowProE['bill_address1'] != ""){?><p><strong>Address :</strong> <?php echo $rowProE['bill_address1'].' '.$rowProE['bill_address2'];?></p><?php }?>
												<?php if($rowProE['bill_city'] != ""){?><p><strong>City :</strong> <?php echo $rowProE['bill_city'];?></p><?php }?>
												<?php if($rowProE['bill_country'] != ""){?><p><strong>State / Country :</strong> <?php echo $rowProE['bill_country'];?></p><?php }?>
												<?php if($rowProE['bill_zipcode'] != ""){?><p><strong>Postcode :</strong> <?php echo $rowProE['bill_zipcode'];?></p><?php }?>
												<?php if($rowProE['bill_phone'] != ""){?><p><strong>Phone :</strong> <?php echo $rowProE['bill_phone'];?></p><?php }?>
												<?php if($rowProE['bill_email'] != ""){?><p><strong>Email :</strong> <?php echo $rowProE['bill_email'];?></p><?php }?>
                  </td>
                  <td class="center">
                        <?php if($rowProE['ship_fname'] != ""){?><p><strong>Full Name :</strong> <?php echo $rowProE['ship_fname'].' '.$rowProE['ship_lname'];?></p><?php }?>
												<?php if($rowProE['ship_company'] != ""){?><p><strong>Company Name :</strong> <?php echo $rowProE['ship_company'];?></p><?php }?>
												<?php if($rowProE['ship_address1'] != ""){?><p><strong>Address :</strong> <?php echo $rowProE['ship_address1'].' '.$rowProE['ship_address2'];?></p><?php }?>
												<?php if($rowProE['ship_city'] != ""){?><p><strong>City :</strong> <?php echo $rowProE['ship_city'];?></p><?php }?>
												<?php if($rowProE['ship_country'] != ""){?><p><strong>State / Country :</strong> <?php echo $rowProE['ship_country'];?></p><?php }?>
												<?php if($rowProE['ship_zipcode'] != ""){?><p><strong>Postcode :</strong> <?php echo $rowProE['ship_zipcode'];?></p><?php }?>
												<?php if($rowProE['ship_phone'] != ""){?><p><strong>Phone :</strong> <?php echo $rowProE['ship_phone'];?></p><?php }?>
												<?php if($rowProE['ship_email'] != ""){?><p><strong>Email :</strong> <?php echo $rowProE['ship_email'];?></p><?php }?>
                  </td>
                </tr>
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
