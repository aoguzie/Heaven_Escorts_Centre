<?php
    include_once("include_app.php");

    if(!empty($_POST)){
        if($_POST['action'] === "get_subcategory"){
            
            $sqlSubCat = "SELECT * FROM `lc_category_sub` WHERE `category` = '".$_POST['catid']."' ORDER BY id ASC";
            $quSubCat = @mysqli_query($conn, $sqlSubCat);

            $subCat = '';
            while($rowSubCat = mysqli_fetch_array($quSubCat, MYSQLI_ASSOC)){
                $subCat .= '<option value="'.$rowSubCat['id'].'">'.$rowSubCat['name'].'</option>';
            }
            echo "|".$subCat;
        }
    }else{
        die();
    }
?>