<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        
        if(isset($_POST['pro_name'],$_POST['pro_detail'],$_POST['pro_category'],$_POST['pro_description'],$_POST['pro_status'],$_POST['mode'],$_POST['_token'])){
            

            if(Token::check($_POST['_token'])){

               

                $pro_name = addslashes($_POST['pro_name']);
                $pro_age = $_POST['pro_age'];
                $pro_detail = addslashes($_POST['pro_detail']);
                $pro_category = $_POST['pro_category'];
                //$pro_category_sub = $_POST['pro_category_sub'];
                $pro_description = addslashes($_POST['pro_description']);
                $pro_status = $_POST['pro_status'];
                $mode = $_POST['mode'];

                $pro_height = $_POST['pro_height'];
                $pro_eyecolour = $_POST['pro_eyecolour'];
                $pro_bust = $_POST['pro_bust'];
                $pro_dresssize = $_POST['pro_dresssize'];
                $pro_tattoos = $_POST['pro_tattoos'];
                $pro_piercings = $_POST['pro_piercings'];
                $pro_smoker = $_POST['pro_smoker'];
                $pro_nationality = $_POST['pro_nationality'];
                $pro_languages = $_POST['pro_languages'];
                $pro_orientation = $_POST['pro_orientation'];

                $pro_1hour = $_POST['pro_1hour'];
                $pro_15hour = $_POST['pro_15hour'];
                $pro_2hour = $_POST['pro_2hour'];
                $pro_dinnerhour = $_POST['pro_dinnerhour'];
                $pro_3hour = $_POST['pro_3hour'];
                $pro_4hour = $_POST['pro_4hour'];
                $pro_5hour = $_POST['pro_5hour'];
                $pro_10hour = $_POST['pro_10hour'];
                $pro_12hour = $_POST['pro_12hour'];

                $pro_mon = $_POST['pro_mon'];
                $pro_mon2 = $_POST['pro_mon2'];
                $pro_tue = $_POST['pro_tue'];
                $pro_tue2 = $_POST['pro_tue2'];
                $pro_wed = $_POST['pro_wed'];
                $pro_wed2 = $_POST['pro_wed2'];
                $pro_thu = $_POST['pro_thu'];
                $pro_thu2 = $_POST['pro_thu2'];
                $pro_fri = $_POST['pro_fri'];
                $pro_fri2 = $_POST['pro_fri2'];
                $pro_sat = $_POST['pro_sat'];
                $pro_sat2 = $_POST['pro_sat2'];
                $pro_sun = $_POST['pro_sun'];
                $pro_sun2 = $_POST['pro_sun2'];

                if($mode === "add"){

                    $sqlPro = "INSERT INTO `lc_product` (`id`, `name`, `age`, `detail`, `description`, `category`, `status`, `pro_height`, `pro_eyecolour`, `pro_bust`, `pro_dresssize`, `pro_tattoos`, `pro_piercings`, `pro_smoker`, `pro_nationality`, `pro_languages`, `pro_orientation`, 
                    `pro_1hour`, `pro_15hour`, `pro_2hour`,`pro_dinnerhour`,`pro_3hour`,`pro_4hour`,`pro_5hour`,`pro_10hour`,`pro_12hour`,`pro_mon`,`pro_mon2`,`pro_tue`,`pro_tue2`,`pro_wed`,`pro_wed2`,`pro_thu`,`pro_thu2`,`pro_fri`,`pro_fri2`,`pro_sat`,`pro_sat2`,`pro_sun`,`pro_sun2`) 
                    VALUES (NULL, '".$pro_name."', '".$pro_age."', '".$pro_detail."', '".$pro_description."', '".$pro_category."', '".$pro_status."',
                    '".$pro_height."', '".$pro_eyecolour."', '".$pro_bust."', '".$pro_dresssize."', '".$pro_tattoos."'
                    , '".$pro_piercings."', '".$pro_smoker."', '".$pro_nationality."', '".$pro_languages."', '".$pro_orientation."'
                    , '".$pro_1hour."', '".$pro_15hour."', '".$pro_2hour."', '".$pro_dinnerhour."', '".$pro_3hour."'
                    , '".$pro_4hour."', '".$pro_5hour."', '".$pro_10hour."', '".$pro_12hour."', '".$pro_mon."', '".$pro_mon2."', '".$pro_tue."', '".$pro_tue2."', '".$pro_wed."', '".$pro_wed2."', '".$pro_thu."', '".$pro_thu2."', '".$pro_fri."', '".$pro_fri2."', '".$pro_sat."', '".$pro_sat2."', '".$pro_sun."', '".$pro_sun2."'
                    );";
                    $quPro = mysqli_query($conn,$sqlPro);
                    $pro_id = mysqli_insert_id($conn);

                    if ($_FILES['pro_images']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images2']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images2']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images2"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images2"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images2` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images3']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images3']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images3"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images3"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images3` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images4']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images4']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images4"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images4"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images4` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images5']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images5']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images5"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images5"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images5` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images6']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images6']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images6"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images6"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images6` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    header("Location:../products.php?action=success");
                    
                }else if($mode === "update"){
                    
                    $pro_id = decode($_POST['pro_id'],LIAM_COINS_KEY);
                 
                    @mysqli_query($conn,"UPDATE `lc_product` SET `name` = '".$pro_name."', `age` = '".$pro_age."', `detail` = '".$pro_detail."', `description` = '".$pro_description."', `category` = '".$pro_category."', `status` = '".$pro_status."' , `pro_height` = '".$pro_height."', `pro_eyecolour` = '".$pro_eyecolour."', `pro_bust` = '".$pro_bust."', `pro_dresssize` = '".$pro_dresssize."', `pro_tattoos` = '".$pro_tattoos."', `pro_piercings` = '".$pro_piercings."', `pro_smoker` = '".$pro_smoker."', `pro_nationality` = '".$pro_nationality."', `pro_languages` = '".$pro_languages."', `pro_orientation` = '".$pro_orientation."', `pro_1hour` =  '".$pro_1hour."', `pro_15hour` = '".$pro_15hour."', `pro_2hour` = '".$pro_2hour."', `pro_dinnerhour` = '".$pro_dinnerhour."', `pro_3hour` = '".$pro_3hour."', `pro_4hour` = '".$pro_4hour."', `pro_5hour` = '".$pro_5hour."', `pro_10hour` = '".$pro_10hour."', `pro_12hour` = '".$pro_12hour."'
                    , `pro_mon` = '".$pro_mon."', `pro_mon2` = '".$pro_mon2."', `pro_tue` = '".$pro_tue."', `pro_tue2` = '".$pro_tue2."'
                    , `pro_wed` = '".$pro_wed."', `pro_wed2` = '".$pro_wed2."', `pro_thu` = '".$pro_thu."', `pro_thu2` = '".$pro_thu2."'
                    , `pro_fri` = '".$pro_fri."', `pro_fri2` = '".$pro_fri2."', `pro_sat` = '".$pro_sat."', `pro_sat2` = '".$pro_sat2."'
                    , `pro_sun` = '".$pro_sun."', `pro_sun2` = '".$pro_sun2."'
                    WHERE `id` = ".$pro_id.";");

                    if ($_FILES['pro_images']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images2']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old2']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images2']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images2"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images2"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images2` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images3']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old3']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images3']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images3"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images3"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images3` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images4']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old4']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images4']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images4"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images4"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images4` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images5']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old5']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images5']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images5"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images5"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images5` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images6']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old6']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images6']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images6"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images6"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images6` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    header("Location:../products.php?action=success");

                }else{
                    die();
                }
            }else{
                die();
            }
        }else{
            die();
        }
    }else{
        die();
    }
?>