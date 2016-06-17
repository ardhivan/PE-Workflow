<?

$needverify = mysql_num_rows(mysql_query("select * from dcn WHERE  `dcn_verifstat` =  'unverified'"));
$waitingapprove = mysql_num_rows(mysql_query("select * from wi WHERE  `wi_status` LIKE  'WAITING APPROVAL'"));
$opendcn = mysql_num_rows(mysql_query("select * from dcn WHERE  `dcn_stat` =  'open'"));
$closedcn = mysql_num_rows(mysql_query("select * from dcn WHERE  `dcn_stat` =  'close'"));
?>

<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
				</div>
<div class="row">
                <!--  <div class="col-lg-3 col-md-6">
                  <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?//=$needverify?></div>
                                    <div><h5><b>DCN Need Verify</b></h5></div>
                                </div>
                            </div>
                        </div>
                        <a href="admin_home.php?page=view_needverify">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-play-circle fa-2x"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> -->
				<!-- <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-spinner	fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?//=$waitingapprove?></div>
									<div><h5><b>WI Waiting Approval</b></h5></div>
                                </div>
                            </div>
                        </div>
                        <a href="admin_home.php?page=view_wi_waiting">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-play-circle fa-2x"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$closedcn?></div>
									<div><h5><b>Closed DCN</b></h5></div>
                                </div>
                            </div>
                        </div>
                        <a href="admin_home.php?page=view_dcnclose">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-play-circle fa-2x"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-warning fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?=$opendcn?></div>
									<div><h5><b>Open DCN</b></h5></div>
                                </div>
                            </div>
                        </div>
                        <a href="admin_home.php?page=view_dcnopen">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-play-circle fa-2x"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
