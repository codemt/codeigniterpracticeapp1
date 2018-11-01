<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MX - NMW | <?php echo $title; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"></script>
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
		page. However, you can choose any other skin. Make sure you
		apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/skin-grey.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
	<!-- [if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif] -->

	<!-- Google Font -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		
	<!-- REQUIRED JS SCRIPTS -->

	<!-- jQuery 3 -->
	<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<!-- Select2 -->
	<script src="<?php echo base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
	<!-- bootstrap datepicker -->
	<script src="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- CKEDITOR - text editor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
	<!-- AdminLTE App -->
  <script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
  <!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>   
</head>
<body class="hold-transition skin-grey sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">MX</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url()?>images/logo.jpg" atl="MX" style="height:50px; width:auto;"/></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <i class="fa fa-user-circle"></i>
              <span class="hidden-xs"><?php echo $this->session->userdata('name'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url()?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <?php if(!empty($permissions)) { ?>
            <?php if(in_array('client_add', $permissions) || in_array('client_list', $permissions)){ ?>
              <a href="#"><i class="fa fa-user"></i> <span>Client</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('client_add', $permissions)){ ?>
                  <li><a href="<?php echo base_url()?>client/addEdit"><i class="fa fa-plus"></i> Add Client</a></li>
                <?php } ?>
                <?php if(in_array('client_list', $permissions)) { ?>
                  <li><a href="<?php echo base_url()?>client/"><i class="fa fa-list"></i> Client List</a></li>
                <?php } ?>
              </ul>
            <?php } ?>
          <?php }  ?>
        </li>
        <li class="treeview">
          <?php if(!empty($permissions)) { ?>
            <?php if(in_array('brief_add', $permissions) || in_array('brief_list', $permissions)){ ?>
          <a href="#"><i class="fa fa-list-alt"></i> <span>Brief</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class="">
              <?php if(in_array('brief_add', $permissions)){ ?>
              <a href="<?php echo base_url()?>brief/addEdit"><i class="fa fa-plus"></i> Add Brief</a></li>
              <?php } ?>

              <?php if(in_array('brief_list', $permissions)) { ?>
            <li><a href="<?php echo base_url()?>brief/"><i class="fa fa-list"></i> Brief List</a></li>
            <?php } ?>
          </ul>
            <?php } ?>
          <?php }  ?>
        </li>
		<li class="treeview">
          <?php if(!empty($permissions)) { ?>
            <?php if(in_array('job_add', $permissions) || in_array('job_list', $permissions)){ ?>
          <a href="#"><i class="fa fa-building"></i> <span>Job</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <?php if(in_array('job_add', $permissions)){ ?>
            <li><a href="<?php echo base_url()?>job/addEdit"><i class="fa fa-plus"></i> Add Job</a></li>
              <?php } ?>

              <?php if(in_array('job_list', $permissions)) { ?>
            <li><a href="<?php echo base_url()?>job/"><i class="fa fa-list"></i> Job List</a></li>
            <?php } ?>
          </ul>
            <?php } ?>
          <?php }  ?>
        </li>
		<li class="treeview">
       <?php if(!empty($permissions)) { ?>
            <?php if(in_array('user_add', $permissions) || in_array('user_list', $permissions)){ ?>
              <a href="#"><i class="fa fa-user-circle"></i> <span>User</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('user_add', $permissions)){ ?>
                  <li><a href="<?php echo base_url()?>user/addEdit"><i class="fa fa-plus"></i> Add User</a></li>
                <?php } ?>
                <?php if(in_array('user_list', $permissions)){ ?>
                  <li><a href="<?php echo base_url()?>user/"><i class="fa fa-list"></i> User List</a></li>
                <?php } ?>
              </ul>
          <?php } ?>
        <?php } ?>

        </li>
        <li class="treeview">
       <?php if(!empty($permissions)) { ?>
            <?php if(in_array('user_add', $permissions) || in_array('user_list', $permissions)){ ?>
              <a href="#"><i class="fas fa-money-bill"></i> <span style="padding-left:1em;"> Bill Types </span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('user_add', $permissions)){ ?>
                  <li><a href="<?php echo base_url()?>billtypes/getTypes"><i class="fa fa-list"></i> View Types</a></li>
                <?php } ?>
                <?php if(in_array('user_list', $permissions)){ ?>
                  <li><a href="<?php echo base_url()?>billtypes/addTypes"><i class="fa fa-plus"></i> Edit Types</a></li>
                <?php } ?>
                <?php if(in_array('user_list', $permissions)){ ?>
                  <li><a href="<?php echo base_url()?>billtypes/addActivity"><i class="fa fa-plus"></i> Add Sub Categories </a></li>
                <?php } ?>
              </ul>
          <?php } ?>
        <?php } ?>

        </li>
        <?php if(!empty($permissions)) { ?>
            <?php if(in_array('get_reports', $permissions)){ ?>		
        <li><a href="<?php echo base_url()?>reports/"><i class="fa fa-file-text-o"></i> <span>Reports</span></a></li>
          <?php } ?>
        <?php } ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>