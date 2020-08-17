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

?>