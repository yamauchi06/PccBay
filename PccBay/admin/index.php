<?php
	include_once('../includes/php/commonFunctions.php');	
	if(isset($_SESSION['user_id'])){
		header('Location: /admin/html/');
	}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php print domain('title'). ' | Admin Login'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/animate.css">
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/iCheck/skins/flat/_all.css">
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/vendor/css/dataTables.bootstrap.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="/admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/themes.css">
</head>

<body class="flat-blue login-page">
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                    <div class="col-sm-12 text-center login-header">
                        <i class="login-logo fa fa-connectdevelop fa-5x"></i>
                        <h4 class="login-title">Flat Admin V2</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="login-body">
                            <div class="progress hidden" id="login-progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    Log In...
                                </div>
                            </div>
                            <form>
                                <div class="control">
                                    <input type="text" class="form-control" placeholder="email" />
                                </div>
                                <div class="control">
                                    <input type="password" class="form-control" placeholder="password" />
                                </div>
                                <div class="login-button text-center">
                                    <input type="submit" class="btn btn-primary" value="Login">
                                </div>
                            </form>
                        </div>
                        <div class="login-footer">
                            <span class="text-right"><a href="#" class="color-white">Forgot password?</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript Libs -->
    <script type="text/javascript" src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin/bower_components/chartjs/Chart.min.js"></script>
    <script type="text/javascript" src="/admin/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="/admin/bower_components/iCheck/icheck.min.js"></script>
    <script type="text/javascript" src="/admin/bower_components/matchHeight/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
            
    <script type="text/javascript" src="/admin/vendor/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="/admin/vendor/js/ace/ace.js"></script>
    <script type="text/javascript" src="/admin/vendor/js/ace/mode-html.js"></script>
    <script type="text/javascript" src="/admin/vendor/js/ace/theme-github.js"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="/admin/js/app.js"></script>
</body>

</html>
