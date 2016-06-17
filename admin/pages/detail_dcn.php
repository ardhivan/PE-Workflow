 <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/dataTables.tableTools.js"></script>
<!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
	<script>
    $(document).ready(function() {
        $('#drawing').dataTable({
		scrollY:  100,
        scrollCollapse: true,
		paging: false,
        ordering: false,
        info:     false,
		filter: false
		
		});
    });
    </script>
		<script>
    $(document).ready(function() {
        $('#wi').dataTable({
		scrollY: 100,
        scrollCollapse: true,
		ordering: false,
		paging: false,
        info: false,
		filter: false
		});
    });
    </script>
	
	
<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header"> Design Change Notice</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `dcn` WHERE dcn_id ='$g'");
									


                    while($row = mysql_fetch_array($result)) {
						
							$cat=$row['dcn_stat'];
	switch ($cat) {
    case "OPEN":
        $class='danger';
        break;
    case "CLOSE":
        $class='success';
        break;
	case "HOLD":
        $class='warning';
        break;
	
}
$catwi=$row['wi_stat'];
	switch ($catwi) {
    case "OPEN":
        $classwi='danger';
        break;
    case "CLOSE":
        $classwi='success';
        break;
	case "NO NEED":
        $classwi='success';
        break;	
}
$catpur=$row['pur_stat'];
	switch ($catpur) {
    case "OPEN":
        $classpur='danger';
        break;
    case "CLOSE":
        $classpur='success';
        break;
	case "NO NEED":
        $classpur='success';
        break;	
}
$catiqa=$row['iqa_stat'];
	switch ($catiqa) {
    case "OPEN":
        $classiqa='danger';
        break;
    case "CLOSE":
        $classiqa='success';
        break;
	case "NO NEED":
        $classiqa='success';
        break;	
}
$catpc=$row['pc_stat'];
	switch ($catpc) {
    case "OPEN":
        $classpc='danger';
        break;
    case "CLOSE":
        $classpc='success';
        break;
	case "NO NEED":
        $classpc='success';
        break;	
}
	
					echo "
					<h2><span class='fa fa-angle-double-down'></span><strong>$row[dcn_model]</strong></h2>
					<h4><strong>$row[dcn_type]</strong></h4>
					<h4><strong>$row[dcn_section]</strong></h4>
					
<table class='table table-condensed table-striped table-hover' width='100%' >
					<tr class='$class'>	
						<td>Status</td>
						<td>&nbsp:&nbsp</td>
						<td><b>  $row[dcn_stat]  </b></td>
                    </tr>
					<tr>
						<td  width='15%'> Receive On</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> $row[dcn_dl]  </td>
						
					</tr>
					<tr>	
						<td>Workflow No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[dcn_nowf]</td> 
					</tr>
					<tr>
						<td> DCN No</td>
						<td>&nbsp:&nbsp</td>
						<td><b>  $row[dcn_no]  </b></td>
					</tr>
					<tr>
						<td>DCN Title</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[dcn_title]  </td>
					</tr>
					<tr>
						<td>Part No</td>
						<td>&nbsp:&nbsp</td>
						
						<td><a href=?page=linked_detail_draw&partno=$row[dcn_partno] onclick='window.open(this.href); return false;'> $row[dcn_partno]</a></td>
					</tr>
					<tr>	
						<td>Partname</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[dcn_partname]  </td>
					</tr>
					<tr>	
						<td>Supplier</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[dcn_supplier]  </td>
                    </tr>
					<tr>	
						<td>Effective</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[dcn_effect]  </td>
                    </tr>
					<tr>	
						<td>Rev</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[dcn_rev]  </td>
                    </tr>
					<tr>	
						<td>Issued to Internal</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[dcn_issue]  </td>
                    </tr>
					<tr>	
						<td>Description/ Comment</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[dcn_spec]  </td>
                    </tr>
					
					<tr>	
						<td><strong>Verification Status</strong></td>
						<td></td>
						<td></td>
                    </tr>
					<tr class='$classwi'>	
						<td>[PE] WI Status</td>
						<td>&nbsp:&nbsp</td>
						<td> <strong> $row[wi_stat] </strong> </td>
                    </tr><tr><td>&nbsp&nbsp</td><td>&nbsp&nbsp</td><td>&nbsp&nbsp</td></tr>";
					$result3 = mysql_query("SELECT * FROM  `dcn_pur` WHERE 	pur_dcnno ='$row[dcn_no]'");
					$row3 = mysql_fetch_array($result3);
					echo"
					<tr class='$classpur'>	
						<td>[Purc] DCI Status</td>
						<td>&nbsp:&nbsp</td>
						<td> <strong> $row[pur_stat] </strong> </td>
                    </tr>
					<tr >	
						<td>[Purc] DCI Comment</td>
						<td>&nbsp:&nbsp</td>
						<td> <strong> $row3[pur_comment] </strong> </td>
                    </tr>
					<tr >	
						<td>[Purc] DCI reply</td>
						<td>&nbsp:&nbsp</td>";
						echo "<td><h5><a href='../../$row3[pur_file]' onclick='window.open(this.href); return false;'><strong>";
						echo "$row3[pur_filename]";
						echo "</strong></a></h5></td></tr>";

					
					echo"
					<tr class='$classiqa'>		
						<td>[IQC] Incoming Check Status</td>
						<td>&nbsp:&nbsp</td>
						<td> <strong> $row[iqa_stat] </strong> </td>
                    </tr>
					<tr class='$classpc'>			
						<td>[PC] SAP Status</td>
						<td>&nbsp:&nbsp</td>
						<td> <strong> $row[pc_stat] </strong> </td>
                    </tr>
					";
					@$dcn=$row[dcn_no];
					}
                ?>
				
			</table>
		
			
<div id=""><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `files` WHERE `file_docno` =  '$dcn'");
									?>
<h4><strong>File Attachment</strong></h4>
									<table cellspacing="5">
				
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=left>";
						echo "<td><h5><a href='../../$row2[file_path]' onclick='window.open(this.href); return false;'><strong>";
						echo "<span class='fa fa-file-text'></span> $row2[file_name]";
						echo "</strong></a></h5></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div><!-- end-->
<br/>
							
<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `drawing` WHERE `draw_dcnno` LIKE  '%$dcn%'");
									?>
<h5><strong>Drawing concerned with this change:</strong></h5>
									<table id="drawing" class="table display table-condensed" cellspacing="0">
				<thead>
					<tr>
						<th>Part No</th>
						<th>Part Name</th>
                        <th>Rev</th>

					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=center>";
						echo "<td><a href=?page=detail_draw&id=$row2[draw_id] onclick='window.open(this.href); return false;'><strong>";
						echo "$row2[draw_partno]";
						echo "</strong></a></td>";
						echo "<td>" . $row2['draw_partname'] . "</td>";
						echo "<td>" . $row2['draw_rev'] . "</td>";

                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div><!-- end-->
			
<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `dcn_wi` WHERE `dcn_no` LIKE  '%$dcn%'");
									?>
<h5><strong>WI concerned with this change:</strong></h5>
									<table id="wi" class="table display table-condensed" cellspacing="0">
				<thead>
					<tr>
						<th>WI No</th>
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
						echo "<td><a href=?page=detail_wii&doc=$row2[wi_docno] onclick='window.open(this.href); return false;'><strong>";
						echo "$row2[wi_docno]";
						echo "</strong></a></td>";
						echo "<td>" . $row2['stat'] . "</td>";

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

