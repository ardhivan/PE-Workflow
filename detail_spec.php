
<?php include "connect.php";?>

<div class="container">
				
						<div class="single-page-artical">
								<div class="artical-content">
									<h2>Part Spec</h2>
									<div class="artical-links">
                                    <div class="container">
									<?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `partspec` WHERE spec_id ='$g'");
									?>
<?php 
                    while($row = mysql_fetch_array($result)) {
					echo "
					<h2><span class='glyphicon glyphicon-chevron-down'></span><strong>$row[spec_model]</strong></h2>
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
<h4><strong>File Attachment</strong></h4>
									<table class="table display table-condensed" cellspacing="0">
				<thead>
				</thead>
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=left>";
						echo "<td><h5><a href='$row2[file_path]' onclick='window.open(this.href); return false;'><strong>";
						echo "<span class='glyphicon glyphicon-file'></span> $row2[file_name]";
						echo "</strong></a></h5></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div><!-- end-->			
									</div>
									</div>
								    </div>
								    
								 
				
						<div class="clearfix">
						</div>
					</div>
					</div>