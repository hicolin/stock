<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Common;
$this->title = Common::getSysInfo(5);
$banquan = Common::getSysInfo(14);
// var_dump($banquan);exit;
if(!yii::$app->session['__id']){
    $https = "http://".$_SERVER['SERVER_NAME'].'/xnn.php';
    header("Location:$https");
    exit;
}
$system_menus = Yii::$app->user->identity->getSystemMenus();
$system_rights = Yii::$app->user->identity->getSystemRights();
$route = $this->context->route;

$absoluteUrl = Yii::$app->request->absoluteUrl;

$funInfo = isset($system_rights[$this->context->route]) == true ? $system_rights[$route] : null;
$otherMenu = true;
//检查是否为主菜单，主菜单不需要添加返回上一层菜单
if(isset($funInfo) == true && $funInfo['entry_url'] != $this->context->route){
    $referrer = Yii::$app->request->referrer;
    if(empty($referrer) == false){
        $referrer = urldecode($referrer);
        $system_menus_current = isset(Yii::$app->session['system_menus_current']) == true ? Yii::$app->session['system_menus_current'] : [];
        //检查当前URL是否已经在导航菜单中
        $inCurrent = false;
        foreach($system_menus_current as $key=>$m){
            if($inCurrent == true){
                unset($system_menus_current[$key]);
            }
            else if($m['route'] == $route){
                $inCurrent = true;
            }
        }
        if($inCurrent == false){
            $funLast = count($system_menus_current) > 0 ? $system_menus_current[count($system_menus_current) - 1] : null;
            // 检查当前url是否和前一个相同，判断是否刷新
            if($funLast['route'] != $route){
                $system_menus_current[] = ['url'=>$absoluteUrl,'route'=>$route, 'right_name'=>$funInfo['right_name']];
            }
        }
        Yii::$app->session['system_menus_current'] = $system_menus_current;
    }
    else{
        $otherMenu = false;
    }
}
else{
    $otherMenu = false;
}
if($otherMenu == false){
    Yii::$app->session['system_menus_current'] = null;
}
?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?=$this->title?></title>


  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=Url::base()?>/frontend/web/xnn/layui/layui.css">
    <link rel="stylesheet" href="<?=Url::base()?>/frontend/web/xnn/layui/layer/default/layer.css">
  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/libs/font-awesome.min.css">

  <!-- Ionicons  -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/libs/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins

       folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/dist/css/skins/_all-skins.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/iCheck/flat/blue.css">

  <!-- Morris chart -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/morris/morris.css">

  <!-- jvectormap -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <!-- Date Picker -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/datepicker/datepicker3.css">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/daterangepicker/daterangepicker.css">

  <!-- bootstrap wysihtml5 - text editor -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- DataTables -->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/datatables/dataTables.bootstrap.css">

  <!--自己的样式-->

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/admin/css/style.css">

  <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/admin/css/calendar.css">

    <link rel="stylesheet" href="<?=Url::base()?>/backend/web/plugins/FileInput/css/fileinput.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

  <!-- jQuery 2.2.3 -->

    <script src="<?=Url::base()?>/backend/web/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/admin/js/Ecalendar.jquery.min.js"></script>

    <!--layDate时间插件-->

    <script src="<?=Url::base()?>/backend/web/dist/laydate/laydate.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/ueditor/ueditor.config.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/ueditor/ueditor.all.min.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/admin/js/public.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/layer/layer.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/FileInput/js/fileinput.js"></script>

    <script src="<?=Url::base()?>/backend/web/plugins/FileInput/js/fileinput_locale_zh.js"></script>
    <!--图标js-->
    <script src="<?=Url::base()?>/backend/web/dist/js/echarts.js"></script>

    <?php
        if(Yii::$app->controller->action->id=='view'):
    ?>
    <style>
        .form-control{
            border:none;
        }
        .control-label{
            text-align: inherit;
            border: 1px solid #f4f4f4;
        }
        .form-group{
            width: 50%;
        }
    </style>
    <?php endif;?>

    <style>
        #create_btn{
            width: 80px;
            height: 33px;
            line-height: 30px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #9ea2a9;
            border-color: #9ea2a9;
        }

        #data_table tr th{
            color: #fff;
            /*text-align: center;*/
            background-color: #797979;
            /*background-color: #7979798;*/
        }

        /*#data_table tr{
            color: #fff;
            background-color: #9ea2a9;
        }*/

        #data_table tr td{
            vertical-align: middle;
            /*//text-align: left;*/
        }

        .main-sidebar{background-color: #222d32}

        .main-sidebar p{color: #fff}

        .skin-blue-light .sidebar-menu>li>a{color: #b8c7ce}

        .skin-blue-light .sidebar-menu>li.header{    color: #4b646f;    background: #1a2226;}

        .skin-blue-light .sidebar-menu>li:hover>a, .skin-blue-light .sidebar-menu>li.active>a{    color: #fff; background: #1e282c;}

        .skin-blue-light .sidebar-menu>li>.treeview-menu{margin: 0 1px;    background: #2c3b41;}     

        .skin-blue-light .treeview-menu>li.active>a, .skin-blue-light .treeview-menu>li>a:hover{    color: #fff;}   



    </style>

  <script>

    $(function($){

        window.admin_tool = function(){

            return {

            	confirm : function(content, ok_fun){

            		$('#confirm_content').text(content);

          			$('#confirm_dialog_ok').click(function(){

          				ok_fun();

          				$('#confirm_dialog').modal('hide'); 

          			});

          			$('#confirm_dialog').modal('show');

          		},

          		alert : function(id, msg, type){

              		var alert_type = '';

              		switch(type){

              			case 'success':

              				alert_type = 'alert-success';

                  			break;

              			case 'warning':

              				alert_type = 'alert-warning';

                  			break;

              			case 'danger':

              				alert_type = 'alert-danger';

                  			break;

                  		default:

                  			alert_type = 'alert-info';

              		}

              		$('#' + id).html('<div class="alert ' + alert_type + ' alert-dismissable">'

                      		+ '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + msg + '</div>');

          		}

            };

        }();



        // 全选

        $('#data_table_check').click( function() {

            var b = this.checked;

        	$('#data_table tbody :checkbox').each(function(i){

        		this.checked = b;

        	});

        });

        

  	});

    </script>

  

<?php if(isset($this->blocks['header']) == true):?>

<?= $this->blocks['header'] ?>

<?php endif;?>

</head>

<body class="hold-transition skin-blue-light sidebar-mini">

<div class="modal fade" id="confirm_dialog" tabindex="-1" role="dialog"

	aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">×</button>

				<h3>请确认</h3>

			</div>

			<div id="confirm_content" class="modal-body">

                

            </div>

			<div class="modal-footer">

				<a id="confirm_dialog_cancel" href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a

					id="confirm_dialog_ok" href="#" class="btn btn-primary">确定</a>

			</div>

		</div>

	</div>

</div>





<div class="wrapper">



  <header class="main-header">

    <!-- Logo -->

    <a href="<?=Url::toRoute('site/index')?>" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>lision</b></span>

      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"><b><?=$this->title?></b></span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

        <span class="sr-only">lision</span>

      </a>

      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user-menu notifications-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">  -->

              <span class="glyphicon glyphicon-user" style="font-size: 16px" alt="User Image"></span>

              <span class="hidden-xs"><?php echo Yii::$app->user->identity->uname;?>&nbsp;&nbsp;</span>

              <span class="fa fa-caret-down"></span>

            </a>



              <ul class="dropdown-menu">

              <!-- User image -->

              <!-- Menu Body -->

              <li class="user-body">

              	<ul class="menu">

            		<li><a href="<?=Url::toRoute('site/psw')?>"><i class="fa fa-cog"></i> 修改密码</a></li>

                	<li><a href="<?=Url::toRoute('site/logout')?>" data-method="post"><i class="fa fa-sign-out"></i> 退出</a></li>

            	</ul>

            

            </ul>

              

          </li>

          <!-- Control Sidebar Toggle Button -->

          <li>

            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>

          </li>

        </ul>

      </div>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="">
                    <a target="_blank" href="javascript:;" onclick="clearcache()">
                        <span class="hidden-xs">清除缓存&nbsp;&nbsp;</span>
                    </a>
                </li>
                <?php if($_SERVER['HTTP_HOST']=='www.xinniuniu.cn' || $_SERVER['HTTP_HOST']=='xinniuniu.cn'):?>
                <li class="">
                    <a target="_blank" href="http://agent.xinniuniu.cn/xnn.php">
                        <span class="hidden-xs">代理后台&nbsp;&nbsp;</span>
                    </a>
                </li>
                <li class="">
                    <a target="_blank" href="/">
                        <span class="hidden-xs">网站前台&nbsp;&nbsp;</span>
                    </a>
                </li>
                <?php endif;?>

                <!-- Control Sidebar Toggle Button -->

            </ul>

        </div>

    </nav>

  </header>

  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

    

      <!-- Sidebar user panel -->

      

     <!--  <div class="user-panel">

        <div class="pull-left image">

          <span class="glyphicon glyphicon-users" style="font-size: 50px"></span>

        </div>

        

        <div class="pull-left info">

          <p><?php echo Yii::$app->user->identity->uname;?></p>

          <a href="<?=Url::toRoute('site/logout')?>"><i class="fa fa-circle text-success"></i>退出</a>

        </div>

      </div> -->

       

       <div class="user-panel">

        <div class="pull-left image">

          <img src="<?= Url::base() ?>/backend/web/images/adds.png" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p><?php echo Yii::$app->user->identity->uname;?></p>

          <a href="<?=Url::toRoute('site/logout')?>" style="color: #777"><i class="fa fa-circle text-success"></i>退出</a>

        </div>

      </div>  

    

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu">

        <li class="header">菜单项</li>



        <li <?=$route == 'site/index' ?  ' class="active" ' : ''?>>

        	<a href="<?=Url::to(['site/index'])?>">

        	<i class="fa fa-dashboard"></i> 

        	<span>首页</span>

        	</a>

        </li>

        <?php 

        

			foreach($system_menus as $menu){

			    $funcList = $menu['funcList'];

			    $isMenuActive = '';

			    $isTreeView = count($funcList) > 0 ? "treeview" : "";

			    $menuHtml = '<li class="#isMenuActive#'. $isTreeView .'">'; // active 

			    $menuHtml .= '   <a href="#">';

			    $menuHtml .= '   <i class="fa fa-table"></i> <span>'. $menu['label'] .'</span>';

			    $menuHtml .= '   <span class="pull-right-container">';

			    $menuHtml .= '       <i class="fa fa-angle-left pull-right"></i>';

			    $menuHtml .= '   </span>';

			    $menuHtml .= '   </a>';

			   // echo '   <ul class="treeview-menu">';

			   if($isTreeView != ""){

			       $menuHtml .= '<ul class="treeview-menu">';

			       foreach($funcList as $fun){

			           $isActive = $fun['url'] == $funInfo['entry_url'] ? 'class="active"' : ''; //'. $isActive .'

			           $menuHtml .= '<li '. $isActive .'><a href="'.Url::to([$fun['url']]).'"><i class="fa fa-circle-o"></i>'. $fun['label'] .'</a></li>';

			           if(empty($isMenuActive) == true && $isActive != ""){

			               $isMenuActive = 'active ';

			           }

			       }

			       $menuHtml .= '</ul>';

			   }

			    $menuHtml .= '</li>';

			    $menuHtml = str_replace('#isMenuActive#', $isMenuActive, $menuHtml);

			    echo $menuHtml;

			}

		?>

        

  

      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>



  <!-- Content Wrapper. Contains page content -->

  

  <div class="content-wrapper">

    <section class="content-header">

      <h1> <?=$funInfo['menu_name']?> <small>

      </small></h1>

      <ol class="breadcrumb breadcrumb-quirk">

        <li><a href="<?=Url::toRoute('site/index')?>"><i class="fa fa-dashboard"></i> 首页</a></li>

        <?php

        if(isset($funInfo['module_name']) == true && isset($funInfo['menu_name']) == true){

            echo '<li><a href="#">'.$funInfo['module_name'].'</a></li>';

            echo '<li><a href="'.Url::toRoute($funInfo['entry_url']).'">'.$funInfo['menu_name'].'</a></li>';

          

        }

        ?>

      </ol>

    </section>

    

      

   

    

    

  <?= $content ?>

  

  </div>

  <!-- /.content-wrapper -->

  <footer class="main-footer">

    <div class="pull-right hidden-xs">

      <b>Version</b> <?=Yii::$app->params['appVersion']?>

    </div>

    <strong><?=$banquan?>-<?=date('Y')?> <a href="/"><?=$this->title?></a>.</strong> All rights

    reserved.

  </footer>



  <!-- Control Sidebar -->

  <aside class="control-sidebar control-sidebar-dark">

    <!-- Create the tabs -->

    <!-- 

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>

    </ul>

     -->

    <!-- Tab panes -->

    <div class="tab-content">

      <!-- Home tab content -->

      <div class="tab-pane" id="control-sidebar-home-tab">

        <h3 class="control-sidebar-heading">Recent Activity</h3>

        <ul class="control-sidebar-menu">

          <li>

            <a href="javascript:void(0)">

              <i class="menu-icon fa fa-birthday-cake bg-red"></i>



              <div class="menu-info">

                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>



                <p>Will be 23 on April 24th</p>

              </div>

            </a>

          </li>

          <li>

            <a href="javascript:void(0)">

              <i class="menu-icon fa fa-user bg-yellow"></i>



              <div class="menu-info">

                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>



                <p>New phone +1(800)555-1234</p>

              </div>

            </a>

          </li>

          <li>

            <a href="javascript:void(0)">

              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>



              <div class="menu-info">

                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>



                <p>nora@example.com</p>

              </div>

            </a>

          </li>

          <li>

            <a href="javascript:void(0)">

              <i class="menu-icon fa fa-file-code-o bg-green"></i>



              <div class="menu-info">

                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>



                <p>Execution time 5 seconds</p>

              </div>

            </a>

          </li>

        </ul>

        <!-- /.control-sidebar-menu -->



        <h3 class="control-sidebar-heading">Tasks Progress</h3>

        <ul class="control-sidebar-menu">

          <li>

            <a href="javascript:void(0)">

              <h4 class="control-sidebar-subheading">

                Custom Template Design

                <span class="label label-danger pull-right">70%</span>

              </h4>



              <div class="progress progress-xxs">

                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>

              </div>

            </a>

          </li>

          <li>

            <a href="javascript:void(0)">

              <h4 class="control-sidebar-subheading">

                Update Resume

                <span class="label label-success pull-right">95%</span>

              </h4>



              <div class="progress progress-xxs">

                <div class="progress-bar progress-bar-success" style="width: 95%"></div>

              </div>

            </a>

          </li>

          <li>

            <a href="javascript:void(0)">

              <h4 class="control-sidebar-subheading">

                Laravel Integration

                <span class="label label-warning pull-right">50%</span>

              </h4>



              <div class="progress progress-xxs">

                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>

              </div>

            </a>

          </li>

          <li>

            <a href="javascript:void(0)">

              <h4 class="control-sidebar-subheading">

                Back End Framework

                <span class="label label-primary pull-right">68%</span>

              </h4>



              <div class="progress progress-xxs">

                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>

              </div>

            </a>

          </li>

        </ul>

        <!-- /.control-sidebar-menu -->



      </div>

      <!-- /.tab-pane -->

      <!-- Stats tab content -->

      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>

      <!-- /.tab-pane -->

      <!-- Settings tab content -->

      <div class="tab-pane" id="control-sidebar-settings-tab">

        <form method="post">

          <h3 class="control-sidebar-heading">General Settings</h3>



          <div class="form-group">

            <label class="control-sidebar-subheading">

              Report panel usage

              <input type="checkbox" class="pull-right" checked>

            </label>



            <p>

              Some information about this general settings option

            </p>

          </div>

          <!-- /.form-group -->



          <div class="form-group">

            <label class="control-sidebar-subheading">

              Allow mail redirect

              <input type="checkbox" class="pull-right" checked>

            </label>



            <p>

              Other sets of options are available

            </p>

          </div>

          <!-- /.form-group -->



          <div class="form-group">

            <label class="control-sidebar-subheading">

              Expose author name in posts

              <input type="checkbox" class="pull-right" checked>

            </label>



            <p>

              Allow the user to show his name in blog posts

            </p>

          </div>

          <!-- /.form-group -->



          <h3 class="control-sidebar-heading">Chat Settings</h3>



          <div class="form-group">

            <label class="control-sidebar-subheading">

              Show me as online

              <input type="checkbox" class="pull-right" checked>

            </label>

          </div>

          <!-- /.form-group -->



          <div class="form-group">

            <label class="control-sidebar-subheading">

              Turn off notifications

              <input type="checkbox" class="pull-right">

            </label>

          </div>

          <!-- /.form-group -->



          <div class="form-group">

            <label class="control-sidebar-subheading">

              Delete chat history

              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>

            </label>

          </div>

          <!-- /.form-group -->

        </form>

      </div>

      <!-- /.tab-pane -->

    </div>

  </aside>

  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed

       immediately after the control sidebar -->

  <div class="control-sidebar-bg"></div>

</div>

<!-- ./wrapper -->





<script src="<?=Url::base()?>/backend/web/plugins/form/jquery.form.min.js"></script>

<!-- Bootstrap 3.3.6 -->

<script src="<?=Url::base()?>/backend/web/bootstrap/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->

<script src="<?=Url::base()?>/backend/web/libs/raphael-min.js"></script>

<script src="<?=Url::base()?>/backend/web/plugins/morris/morris.min.js"></script>

<!-- Sparkline -->

<script src="<?=Url::base()?>/backend/web/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- jvectormap -->

<script src="<?=Url::base()?>/backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<script src="<?=Url::base()?>/backend/web/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- jQuery Knob Chart -->

<script src="<?=Url::base()?>/backend/web/plugins/knob/jquery.knob.js"></script>

 

<!-- daterangepicker -->

<script src="<?=Url::base()?>/backend/web/libs/moment.min.js"></script>

<script src="<?=Url::base()?>/backend/web/plugins/daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->

<script src="<?=Url::base()?>/backend/web/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- Bootstrap WYSIHTML5 -->

<script src="<?=Url::base()?>/backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->

<script src="<?=Url::base()?>/backend/web/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->

<script src="<?=Url::base()?>/backend/web/plugins/fastclick/fastclick.js"></script>

<!-- DataTables -->

<script src="<?=Url::base()?>/backend/web/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?=Url::base()?>/backend/web/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="<?=Url::base()?>/backend/web/plugins/treeview/bootstrap-treeview.min.js"></script>

<script src="<?=Url::base()?>/backend/web/dist/js/ajaxfileupload.js"></script>

<!-- AdminLTE App -->

<script src="<?=Url::base()?>/backend/web/dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->

<script src="<?=Url::base()?>/backend/web/dist/js/demo.js"></script>

<script>

    function clearcache(){

        $.ajax({

            url:"<?=Url::toRoute(['public/clear-cache'])?>",

            type:"POST",

            success:function(data){

                var obj=jQuery.parseJSON(data);



                if(obj.status==1){

                    layer.alert("清除成功!",{icon:6})

                }else{

                    layer.alert("清除失败!",{icon:5})

                }

            },error:function(){

                layer.alert("清除失败,稍后再试!",{icon:5})

            }

        })

    }

    laydate.render({

        elem: '#b_time'

        ,type: 'datetime'

        ,theme: 'molv'

    });

    laydate.render({

        elem: '#e_time'

        ,type: 'datetime'

        ,theme: 'molv'

    });

</script>







    <?php

    if( Yii::$app->getSession()->hasFlash('error') ) { ?>

    <script>

    var error = "<?=Yii::$app->getSession()->getFlash('error')?>";

    layer.alert(error, {icon: 2});

</script>



<?php }



if(Yii::$app->getSession()->hasFlash('success')) { ?>

    <script>

        var success = "<?=Yii::$app->getSession()->getFlash('success')?>";

        layer.alert(success, {icon: 1});

    </script>

<?php }

?>



</body>

<?php if(isset($this->blocks['footer']) == true):?>

<?= $this->blocks['footer'] ?>

<?php endif;?>

</html>
