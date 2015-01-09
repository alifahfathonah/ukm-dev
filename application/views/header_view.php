<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$title;?> // SIM UKM</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?=base_url();?>public/assets/img/favicon.ico" type="image/x-icon">
        <!-- bootstrap 3.0.2 -->
        <link href="<?=base_url();?>public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>public/assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
		   
        <!-- font Awesome -->
        <link href="<?=base_url();?>public/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=base_url();?>public/assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?=base_url();?>public/assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="<?=base_url();?>public/assets/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?=base_url();?>public/assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?=base_url();?>public/assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?=base_url();?>public/assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Datatables style -->
        <link href="<?=base_url();?>public/assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?=base_url();?>public/assets/css/iCheck/all.css" rel="stylesheet" type="text/css" />


        <!-- jQuery -->
        <!-- jQuery 2.0.2  -->
        <script src="<?=base_url();?>public/assets/js/jquery.min.js" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?=base_url();?>public/assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?=base_url();?>public/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>public/assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?=base_url();?>public/assets/js/raphael-min.js"></script>
        <script src="<?=base_url();?>public/assets/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?=base_url();?>public/assets/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?=base_url();?>public/assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?=base_url();?>public/assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?=base_url();?>public/assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- Datatables -->
        <script src="<?=base_url();?>public/assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?=base_url();?>public/assets/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=base_url();?>public/assets/js/plugins/datatables/dataTables.reload.js" type="text/javascript"></script>

        <!-- InputMask -->
        <script src="<?=base_url();?>public/assets/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?=base_url();?>public/assets/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?=base_url();?>public/assets/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

        <!-- ukm App -->
        <script src="<?=base_url();?>public/assets/js/ukm/app.js" type="text/javascript"></script>
        <script src="<?=base_url();?>public/assets/js/ukm/misc.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var value = "#li-" + window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
                //alert(value);
                $(value).addClass("active");
            });
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="pace-done fixed <?=$this->access->get_roleid() == 40 ? "skin-black" : "skin-blue";?>">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?=site_url()?>dashboard" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Dashboard
                <small><?=$this->access->get_role();?></small>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?=$this->access->get_username();?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?=base_url();?>public/assets/img/avatar10.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?=$this->access->get_username();?>
                                        <small>sebagai <?= $this->access->get_role() == "UKM" ? "Admin" : ""; ?> <?=$this->access->get_role();?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=base_url();?>dashboard/profil" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=base_url();?>dashboard/logout" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?=base_url();?>public/assets/img/avatar10.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hai, <?=$this->access->get_username();?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li id="li-dashboard">
                            <a href="<?=base_url();?>dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <?php
                            if(!empty($menu)){
                                echo $menu;
                            }
                        ?>


                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
