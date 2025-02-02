<?php
session_start();
require_once('../includes/config.php');
require_once('../includes/functions/func.admin.php');

if(isset($_SESSION['admin']['id'])){
    echo '<script>window.location="index.php"</script>';
}


$mysqli = db_connect($config);

if(isset($_POST['username']))
{
    $query = "SELECT id FROM `".$config['db']['pre']."admins` WHERE username='" . addslashes($_POST['username']) . "' AND password='" . addslashes(md5($_POST['password'])) . "' LIMIT 1";
    $query_result = mysqli_query($mysqli,$query);
    while ($info = mysqli_fetch_array($query_result))
    {
        $admin_id = $info['id'];
    }
    if(isset($admin_id))
    {
        $_SESSION['admin']['id'] = $admin_id;
        $_SESSION['admin']['username'] = $_POST['username'];
        echo '<script>window.location="index.php"</script>';
        exit;
    }
    else
    {
        $error = "Error: Username & Password do not match";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Quickad - Admin Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style-light.css" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (blue.css) for this starter
              page. However, you can choose any other skin from folder css / colors .
    -->
    <link href="css/colors/blue.css" id="theme"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" method="post" action="#">
                <h3 class="box-title m-b-20">Admin Panel</h3>
                <span style="color:#df6c6e;">
                    <?php
                    if(!empty($error)){
                        echo '<div class="byMsg byMsgError">! '.$error.'</div>';
                    }
                    ?>
                </span>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Username" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup"> Remember me </label>
                        </div>
                        <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right hidden"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="login" type="submit">Log In</button>
                    </div>
                </div>

            </form>
            <form class="form-horizontal" id="recoverform" action="login.php">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <h3>Recover Password</h3>
                        <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- jQuery -->
<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<!--<script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>-->
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<!--<script src="js/waves.js"></script>-->
<!-- Custom Theme JavaScript -->
<script src="js/custom.js"></script>
<!--Style Switcher -->
<script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<!--Style Switcher -->
</body>
</html>
