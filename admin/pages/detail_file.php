

<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header"> File Attachment</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `files` WHERE file_id ='$g'");
									?>
<?php 
                    while($row = mysql_fetch_array($result)) {
	
					echo "
					<h2><span class='fa fa-angle-double-down'></span><strong>$row[file_docno]</strong></h2>
					<table class='table table-condensed table-striped table-hover' width='100%' >
					<tr>
						<td  width='15%'> Document Number</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> $row[file_docno]  </td>
					</tr>
					<tr>
						<td  width='15%'> Attached File</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> <h3><a href='../../$row[file_path]' onclick='window.open(this.href); return false;'><strong>
							<span class='fa fa-file-text'></span> $row[file_name]</strong></a></h3>
						</td>
					</tr>
					";
					}
                ?>
				
			</table>

                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->	
</div>
 </div>

