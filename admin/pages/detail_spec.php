

<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header"> Part Spec</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `partspec` WHERE spec_id ='$g'");
									?>
<?php 
                    while($row = mysql_fetch_array($result)) {
	
					echo "
					<h2><span class='fa fa-angle-double-down'></span><strong>$row[spec_model]</strong></h2>
					<table class='table table-condensed table-striped table-hover' width='100%' >
					<tr>
						<td  width='15%'> Receive On</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> $row[spec_dl]  </td>
						
					</tr>
					<tr>	
						<td>Workflow No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[spec_wfno]</td> 
					</tr>
					<tr>
						<td> Doc No</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[spec_no]  </td>
					</tr>
					<tr>
						<td>Part No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[spec_partno]  </td>
					</tr>
					<tr>
						<td>Part Name</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[spec_partname]  </td>
					</tr>
					<tr>	
						<td>Supplier</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[spec_supplier]  </td>
					</tr>
					<tr>	
						<td>Spesification</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[spec_spesification]  </td>
                    </tr>
					<tr>	
						<td>Rev</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[spec_rev]  </td>
                    </tr>
					<tr>	
						<td>Issued to Internal</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[spec_issue]  </td>
                    </tr>

					";
					@$specno=$row[spec_no];
					}
                ?>
				
			</table>
<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `files` WHERE `file_docno` =  '$specno'");
									?>
<h5><strong>File Attachment</strong></h5>
									<table class="table display table-condensed" cellspacing="0">
				<thead>
				</thead>
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=left>";
						echo "<td><h3><a href='../../$row2[file_path]' onclick='window.open(this.href); return false;'><strong>";
						echo "<span class='fa fa-file-text'></span> $row2[file_name]";
						echo "</strong></a></h3></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div><!-- end-->
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->	
</div>
 </div>

