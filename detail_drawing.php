<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('#drawing').dataTable({
		"scrollY":        "200px",
        "scrollCollapse": true,
		"paging": false,
        "ordering": false,
        "info":     false,
		"filter": false
		});
	} );
	</script>
<?php include "connect.php";?>
<div class="container">
				
						<div class="single-page-artical">
								<div class="artical-content">
									<h2>Part Drawing</h2>
									<div class="artical-links">
                                    <div class="container">
									<?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `drawing` WHERE draw_id =  '$g'");
									?>
									


<?php 
                    while($row = mysql_fetch_array($result)) {
					echo "
					<h2><span class='glyphicon glyphicon-chevron-down'></span><strong>$row[draw_model]</strong></h2>
					<h4><strong>$row[draw_category]</strong></h4>
					<table class='table table-striped' width='100%' >
					<tr>
						<td  width='15%'> Receive On</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> $row[draw_dl]  </td>
						
					</tr>
					<tr>	
						<td>Workflow No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[draw_wfno]</td> 
					</tr>
					<tr>
						<td> Code</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_code]  </td>
					</tr>
					<tr>
						<td> Drawing no</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_no]  </td>
					</tr>
					<tr>
						<td>Part No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[draw_partno]  </td>
					</tr>
					<tr>
						<td>Part Name</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_partname]  </td>
					</tr>
					<tr>	
						<td>Comment</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_comment]  </td>
                    </tr>
					<tr>	
						<td>Revision</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_rev]  </td>
                    </tr>
					<tr>	
						<td>Issued to Internal</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_issue]  </td>
                    </tr>
	
						
					";
					@$dcn=$row[draw_dcnno];
					@$drawno=$row[draw_no];
					}
               /* <tr>	
						<td>DOC/DCN No</td>
						<td>&nbsp:&nbsp</td>
						<td><a href=?page=linked_detail_dcn&dcn=$row[draw_dcnno] onclick='window.open(this.href); return false;'>  $row[draw_dcnno] </a> </td>
					</tr> */
			   ?>	
				</table>
<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `files` WHERE `file_docno` =  '$drawno'");
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
<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `dcn` WHERE `dcn_no` LIKE  '%$dcn%'");
									?>
<h5><strong>DCN concerned with this drawing:</strong></h5>
									<table id="drawing" class="table display table-condensed" cellspacing="0">
				<thead>
					<tr>
						<th>DCN No</th>
						<th>DCN Title</th>
                        <th>Rev</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=center>";
						echo "<td><a href=?page=detail_dcn&id=$row2[dcn_id] onclick='window.open(this.href); return false;'><strong>";
						echo "$row2[dcn_no]";
						echo "</strong></a></td>";
						echo "<td>" . $row2['dcn_title'] . "</td>";
						echo "<td>" . $row2['dcn_rev'] . "</td>";
						echo "<td>" . $row2['dcn_model'] . "</td>";
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