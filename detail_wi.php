<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#wi').dataTable({
		scrollY:  "100px",
        scrollCollapse: true,
		paging: false,
        ordering: false,
        info:    false,
		filter: false
		});
    });
    </script>
<?php include "connect.php";?>
<div class="container">
				
						<div class="single-page-artical">
								<div class="artical-content">
									<h2>Work Instruction</h2>
									<div class="artical-links">
                                    <div class="container">
									<?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `wi` WHERE wi_id ='$g'");
									?>
<?php 
                    while($row = mysql_fetch_array($result)) {
	$type=$row['wi_status'];
	switch ($type) {
    case "OPEN":
        $class='danger';
        break;
    case "CLOSE":
        $class='success';
        break;
	case "WAITING APPROVAL":
        $class='warning';
        break;	
}		
					echo "
					<h2><span class='glyphicon glyphicon-chevron-down'></span><strong>$row[wi_model]</strong></h2>
					
					<table class='table table-condensed table-striped table-hover' width='100%' >
					<tr class='$class'>	
						<td>Status</td>
						<td>&nbsp:&nbsp</td>
						<td><H1><b>  $row[wi_status]</b></H1></td>
                    </tr>
					<tr>	
						<td>Section</td>
						<td>&nbsp:&nbsp</td>
						<td><b>  $row[wi_section]  </b></td>
                    </tr>
					<tr>
						<td  width='15%'> Doc No</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> $row[wi_docno]  </td>
						
					</tr>
					<tr>	
						<td>Title</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[wi_title]</td> 
					</tr>
					<tr>
						<td>Stage Status</td>
						<td>&nbsp:&nbsp</td>
						<td>$row[wi_stagestat]  </td>
					</tr>
					
					<tr>
						<td>Issue</td>
						<td>&nbsp:&nbsp</td>
						<td><a href='$row[wi_file2]' onclick='window.open(this.href); return false;'>$row[wi_issue]</a></td>
					</tr>
					<tr>	
						<td>Revision</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[wi_rev]  </td>
					</tr>
					<tr>	
						<td>Maker</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[wi_maker]  </td>
                    </tr>

					<tr>	
						<td align='right'><h1><span class='glyphicon glyphicon-file'></span></h1></td>
						<td></td>
						<td><a href='$row[wi_file]' onclick='window.open(this.href); return false;'><h4><strong>$row[wi_filename]</strong></a></h4></td>
                    </tr>
					<tr>	
						<td align='right'><h1><span class='glyphicon glyphicon-list-alt'></span></h1></td>
						<td></td>
						<td><a href='$row[wi_file3]' onclick='window.open(this.href); return false;'><h4><strong>$row[wi_filename3]</strong></a></h4></td>
                    </tr>
					
					";
					@$wi_no=$row[wi_docno];
					}
                ?>
				
			</table>

<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `dcn_wi` WHERE `wi_docno` LIKE  '%$wi_no%'");
									?>
<h5><strong>DCN concerned with this WI:</strong></h5>
									<table id="wi" class="table display table-condensed" cellspacing="0">
				<thead>
					<tr align="center">
						<th align="center">DCN No</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					
                    while($row2= mysql_fetch_array($result)) {
					$cat=$row2['stat'];
					switch ($cat) {
					case "OPEN":
					$cat='danger';
					break;
					case "CLOSE":
					$cat='success';
					break;	
					}
                        echo "<tr align=center class='$cat'>";
						echo "<td><a href=?page=detaill_dcn&doc=$row2[dcn_no] onclick='window.open(this.href); return false;'><strong>";
						echo "$row2[dcn_no]";
						echo "</strong></a></td>";
						echo "<td>" . $row2['stat'] . "</td>";

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