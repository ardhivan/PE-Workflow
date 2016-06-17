<!DOCTYPE html>

<?php

	session_start();
	
	if(!isset($_SESSION['anggota']) && !isset($_SESSION['nama']) && !isset($_SESSION['user'])  && !isset($_SESSION['pass'])  && !isset($_SESSION['level'])){		
		echo "<script>alert('Please Login!'); document.location='login.php'</script>";
		
	}else{ 
		include 'connect.php' ;	
		 	
		$user=$_SESSION['nama'];
		?>
			<?
// Fungsi untuk menampilkan progress bar
function set_progress($val=0){

	$data = "<div class='progress-container' style='display:none'>
			
				<div class='progress'>
					  <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: ". $val. "%'>
					  </div>
				</div>

			</div>";

	return $data;

}

?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Workflow Control Panel</title>

    

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- TABLE TOOLS CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dataTables.tableTools.css">
	
	<!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <!-- jQuery 
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>-->
<script src="../js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript 
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/jquery.form.js"></script>
		<script src="../js/tinymce/tinymce.min.js"></script>
		
 <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.tableTools.js"></script>

<!--form-->	
<link href="../css/style.css" rel="stylesheet">	
<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">	
    

<!--datepicker-->	
<link href="../bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>

<link href="../fullcalender/lib/cupertino/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<link href="../fullcalender/fullcalendar.css" rel="stylesheet" type="text/css" />
<link href="../fullcalender/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print" />
<script src="../fullcalender/lib/moment.min.js" type="text/javascript"></script>

<script src="../fullcalender/fullcalendar.min.js" type="text/javascript"></script>

</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                </button>
                <a class="navbar-brand" href="admin_home.php">Workflow Control Panel [Welcome, <b><?php echo"$user";?></b>]  </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<!-- menu 1 -->
                        <li>
                            <a href="admin_home.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<!-- menu 2 -->
                        <li>
                            <a href="#"><i class="fa  fa-database fa-fw"></i> Import CSV Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin_home.php?page=add_dcn">Import DCN</a>
                                </li>
								<li>
                                    <a href="admin_home.php?page=add_drawing">Import Drawing</a>
                                </li>
								<li>
                                    <a href="admin_home.php?page=add_partspec">Import Part Spec</a>
                                </li>
								
								<li>
                                    <a href="admin_home.php?page=add_wi">Import Work Instruction</a>
                                </li>
                            </ul><!-- /.nav-second-level -->
                        </li>
						<!-- menu 3 -->

                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Data Table<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin_home.php?page=view_model">Data Model</a>
                                </li>
                                <li>
                                    <a href="admin_home.php?page=view_dcn">Data DCN</a>
                                </li>
								<li>
                                    <a href="admin_home.php?page=view_drawing">Data Drawing</a>
                                </li>
								<li>
                                    <a href="admin_home.php?page=view_partspec">Data Part Spec</a>
                                </li>
								<li>
                                    <a href="admin_home.php?page=view_stencil">Data Stencil</a>
                                </li>
								<li>
                                    <a href="admin_home.php?page=view_wi">Data Work Instruction</a>
                                </li>
								
                            </ul><!-- /.nav-second-level -->
                        </li>
						<!-- menu 4 -->
						<li>
                            <a href="admin_home.php?page=dcn_ver"><i class="fa fa-pencil-square-o fa-fw"></i> DCN & WI Verification</a>
                        </li>
						<!-- menu 5 -->
						<li>
                            <a href="admin_home.php?page=dci_pur"><i class="fa fa-pencil-square-o fa-fw"></i> DCI Verification</a>
                        </li>
						
						<!-- menu 6 -->
                        <li>
                            <a href="admin_home.php?page=files"><i class="fa fa-folder fa-fw"></i> File Manager</a>
                        </li>
						<!-- menu 7 -->
						<li>
                            <a href="admin_home.php?page=schedule"><i class="fa fa-calendar fa-fw"></i> Schedule Manager</a>
                        </li>
						<!-- menu 8 -->
						<li>
                            <a href="admin_home.php?page=user"><i class="fa fa-user fa-fw"></i> Users</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
		<?php
		  if(isset($_GET['page'])) { $page = $_GET['page']; } 
			else { $page = ""; } 
		  //$page = $_GET['page'];
		  if($page){
		  	require_once($page.".php");
		  } else {
		  	require_once("home.php");
		  }
		  ?>
            
            
       
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

		
</body>

</html>
<?php } ?>