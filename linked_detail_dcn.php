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
									<h2>Design Change Notice</h2>
									<div class="artical-links">
                                    <div class="container">
									<?php
									$g=$_GET['dcn'];
									$result = mysql_query("SELECT * FROM  `dcn` WHERE dcn_no LIKE  '%$g%'");
									?>
									


<?php 
                    while($row = mysql_fetch_array($result)) {
					echo "
					<h2><span class='glyphicon glyphicon-chevron-down'></span><strong>$row[dcn_model]</strong></h2>
					<h4><strong>$row[dcn_type]</strong></h4>
					<h4><strong>$row[dcn_section]</strong></h4>
					<table class='table table-condensed table-striped' width='100%' >
					<tr>
						<td  width='15%'> Receive On</td>
						<td width='1%' align='left'>:</td>
						<td> $row[dcn_dl]  </td>
						
					</tr>
					<tr>	
						<td>Workflow No</td>
						<td>:</td>
						<td> $row[dcn_nowf]</td> 
					</tr>
					<tr>
						<td> DCN No</td>
						<td>:</td>
						<td>  $row[dcn_no]  </td>
					</tr>
					<tr>
						<td>DCN Title</td>
						<td>:</td>
						<td> $row[dcn_title]  </td>
					</tr>
					<tr>
						<td>Part No</td>
						<td>:</td>
						<td><a href=?page=linked_detail_draw&partno=$row[dcn_partno] onclick='window.open(this.href); return false;'> $row[dcn_partno]</a></td>
					</tr>
					<tr>	
						<td>Partname</td>
						<td>:</td>
						<td>  $row[dcn_partname]  </td>
					</tr>
					<tr>	
						<td>Supplier</td>
						<td>:</td>
						<td>  $row[dcn_supplier]  </td>
                    </tr>
					<tr>	
						<td>Effective</td>
						<td>:</td>
						<td>  $row[dcn_effect]  </td>
                    </tr>
					<tr>	
						<td>Rev</td>
						<td>:</td>
						<td>  $row[dcn_rev]  </td>
                    </tr>
					<tr>	
						<td>Issued to Internal</td>
						<td>:</td>
						<td>  $row[dcn_issue]  </td>
                    </tr>
					<tr>	
						<td>Description/ Comment</td>
						<td>:</td>
						<td>  $row[dcn_spec]  </td>
                    </tr>
					<tr>	
						<td align='right'><h1><span class='glyphicon glyphicon-file'></span></h1></td>
						<td></td>
						<td><h4><a href='$row[dcn_file]' onclick='window.open(this.href); return false;'>  $row[dcn_filename] </a></h4></td>
                    </tr>
					
					";
					@$dcn=$row[dcn_no];
					}
                ?>
				
			</table>	
<?php										
									$result= mysql_query("SELECT * FROM  `drawing` WHERE 'draw_dcnno' LIKE  '%$dcn%'");
									?>
<div id="tabelbawah">
<h5>
Drawing concerned with this change:
</h5>
									<table id="drawing" class="table display table-condensed" cellspacing="0">
				<thead>
					<tr>
						<th>Part No</th>
						<th>Part Name</th>
                        <th>Rev</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=center>";
						echo "<td><a href=?page=detail_drawing&id=$row2[draw_id] onclick='window.open(this.href); return false;'><strong>";
						echo "$row2[draw_partno]";
						echo "</strong></a></td>";
						echo "<td>" . $row2['draw_partname'] . "</td>";
						echo "<td>" . $row2['draw_rev'] . "</td>";
						echo "<td>" . $row2['draw_model'] . "</td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div>			
									</div>
									</div>
								    </div>
								    
								 
				
						<div class="clearfix">
						</div>
					</div>
					</div>