<?php
function encode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $hash = '';
    $j = 0;
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}

function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $hash = '';
    $j = 0;
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}

function get_category_name($conn,$cat_id){

    if(!empty($cat_id)){
        $quCat = mysqli_query($conn, "SELECT * FROM `lc_category` WHERE `id`=".$cat_id);
        $rowCat = mysqli_fetch_array($quCat, MYSQLI_ASSOC);
        return $rowCat['name'];
    }else{
        return "All Categories";
    }
    
}

function get_category_sub_name($conn,$cat_id){

    if(!empty($cat_id)){
        $quCat = mysqli_query($conn, "SELECT * FROM `lc_category_sub` WHERE `id`=".$cat_id);
        $rowCat = mysqli_fetch_array($quCat, MYSQLI_ASSOC);
        return $rowCat['name'];
    }else{
        return "All Sub Categories";
    }
    
}

function get_redirect_product($conn,$cat_id){
    $sqlCatSubFide = "SELECT * FROM `lc_category_sub` WHERE `category` = '".$cat_id."' ORDER BY id ASC";
    $quCatSubFide = mysqli_query($conn,$sqlCatSubFide);
    $rowCatSubFide = mysqli_fetch_array($quCatSubFide, MYSQLI_ASSOC);
    return $rowCatSubFide['id'];
}

function page_navi($total_item, $cur_page, $per_page=10, $query_str="", $min_page=5){

    $total_page = ceil($total_item/$per_page);
    $cur_page = (isset($cur_page))?$cur_page:1;
    $diff_page = NULL;
    if($cur_page>$min_page){
        $diff_page = $total_page-$cur_page;
    }
    $limit_page = $min_page;
    $f_num_page = ($cur_page<=$min_page)?1:(floor($cur_page/$min_page)*$min_page)+1;
    if($diff_page>$min_page){
        $limit_page = ($min_page + $f_num_page)-1;
    }else{
        if(isset($diff_page)){
            $limit_page = $total_page;
        }else{
            $limit_page = $min_page;
        }
    }
    $show_page = ($total_page<=$min_page)?$total_page:$limit_page;
    $l_num_page = 1;
    $prev_page = $cur_page-1;
    $next_page = $cur_page+1;
    // $temp_query_str = $query_str;
    // $query_str = "";
    // if($temp_query_str && is_array($temp_query_str) && count($temp_query_str)>0){
    //     echo count($temp_query_str);
    //     array_pop($temp_query_str);
    //     $query_str = http_build_query($temp_query_str);
    //     if($query_str != ""){
    //         $query_str = "?".$query_str;    
    //     }
    // }
    $mark_char = ($query_str != "") ? "&":"?";
 
    echo '<nav>
      <ul class="pagination justify-content-center">
        <li class="page-item">
        <a class="page-link" href="'.$query_str.$mark_char.'page=1"> <<</a>
        </li>
        ';
    echo '
        <li class="page-item '.(($cur_page==1)?"disabled":"").'">
          <a class="page-link"  href="'.$query_str.$mark_char.'page='.$prev_page.'"> <</a> 
        </li> 
    ';  
    for($i = $f_num_page; $i<=$show_page;$i++){
    echo '     
        <li class="page-item '.(($i==$cur_page)?"active":"").'"> 
          <a class="page-link" href="'.$query_str.$mark_char.'page='.$i.'"> '.$i.' </a> 
        </li>     
    ';
    }
    echo '
        <li class="page-item '.(($next_page>$total_page)?"disabled":"").'"> 
            <a class="page-link"  href="'.$query_str.$mark_char.'page='.$next_page.'"> ></a> 
        </li>     
    ';  
    // echo '
    //     <li class="page-item">
    //       <input type="number" class="form-control" min="1" max="'.$total_page.'"
    //               style="width:80px;" onClick="this.select()" onchange="window.location=\''.$query_str.$mark_char.'page=\'+this.value"  value="'.$cur_page.'" />
    //     </li> 
    // ';
    echo '
        <li class="page-item"> 
            <a class="page-link"  href="'.$query_str.$mark_char.'page='.$total_page.'"> >></a> 
        </li>     
      </ul>
    </nav>        
    ';      
}

function get_page($conn,$page_id){
    $sqlPage = "SELECT * FROM `lc_page` WHERE `id` = '".$page_id."' ORDER BY id ASC LIMIT 1 ";
    $quPage = mysqli_query($conn,$sqlPage);
    $rowPage = mysqli_fetch_array($quPage, MYSQLI_ASSOC);
    return stripslashes($rowPage['detail']);
}

function getTokenLogin($conn,$cus_id){
    $sqlCus = "SELECT * FROM `lc_customer` WHERE `id` = '".$cus_id."' ORDER BY id ASC LIMIT 1 ";
    $quCus = mysqli_query($conn,$sqlCus);
    $rowCus = mysqli_fetch_array($quCus, MYSQLI_ASSOC);
    return $rowCus['login_token'];
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function login_process($conn,$cus_email,$cus_passwordT){

    $sqlCustomer = "SELECT * FROM `lc_customer` WHERE 1 AND (`cus_email` = '".$cus_email."' OR `cus_username` = '".$cus_email."')  AND `cus_password` = '".$cus_passwordT."' AND `status` = '1' LIMIT 1";
    $quCustomer = mysqli_query($conn,$sqlCustomer);
    $rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);
    
    if($rowCustomer['id'] != ""){
        
        $_SESSION['cus_id'] = $rowCustomer['id'];
        
        $cus_token = TokenLogin::generate();
        $sqlCusUpdate= "UPDATE `lc_customer` SET `login_token` = '".$cus_token."' WHERE `id` = ".$rowCustomer['id'].";";
        mysqli_query($conn,$sqlCusUpdate);

        $cus_ip = get_client_ip();

        $sqlLogLogin = "INSERT INTO `lc_login` (`id`, `cus_id`, `ip`, `date_login`, `token`) VALUES (NULL, '".$rowCustomer['id']."', '".$cus_ip."', current_timestamp(), '".$cus_token."');";
        mysqli_query($conn,$sqlLogLogin);

        mysqli_query($conn,"DELETE FROM `lc_login_lock` WHERE `cus_id` = '".$rowCustomer['id']."'");
    
        if(isset($_POST['redirect'])){
            header("Location:../".$_POST['redirect']."?action=success");
        }else{
            header("Location:../my-account.php");
        }
        
    }else{

        $sqlCustomer = "SELECT * FROM `lc_customer` WHERE 1 AND (`cus_email` = '".$cus_email."' OR `cus_username` = '".$cus_email."')  LIMIT 1";
        $quCustomer = mysqli_query($conn,$sqlCustomer);
        $rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);

        mysqli_query($conn,"INSERT INTO `lc_login_lock` (`id`, `cus_id`, `cus_account`, `datetime`) VALUES (NULL, '".$rowCustomer['id']."', '".$rowCustomer['cus_username']."', current_timestamp());");
        
        if(isset($_POST['redirect'])){
            header("Location:../".$_POST['redirect']."?action=failure&error=&error=wrong");
        }else{
            header("Location:../login.php?action=failure&error=wrong");
        }
    }
}

?>