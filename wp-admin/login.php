<?php include_once("include/include_app.php");?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title><?php echo LIAM_COINS_TITLE;?></title><meta charset="UTF-8" />
        <?php include_once('header_meta.php');?>
        <link rel="stylesheet" href="css/matrix-login.css" />
    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="control/login.php" method="post">
				 <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                
                <div class="form-actions text-center">
                    <input type="hidden" name="_token" value="<?php echo Token::generate();?>" />
                    <button class="btn btn-success"> Login </button>
                </div>
            </form>
        </div>
        
        <script src="js/jquery.min.js?version=<?php echo date("YmdHis");?>"></script>  
        <script src="js/matrix.login.js?version=<?php echo date("YmdHis");?>"></script> 
    </body>

</html>
