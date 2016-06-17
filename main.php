<!DOCTYPE HTML>
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./js/bootstrap.min.js"></script>
	
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
	<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('#tabledcn').dataTable({
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		"order": [[ 0, "desc" ]],
		"columnDefs": [ 
            {
                "targets": [ 4 ],
				"visible": false
            },
			{
                "targets": [ 5 ],
                "visible": false
            },
			{
                "targets": [ 7 ],
                "visible": false
            }
        ]
		});
	$(document).ready(function() {
    var table = $('#tabledcn').DataTable();
 
    $("#tabledcn tfoot th").each( function ( i ) {
        var select = $('<select><option value=""></option></select>')
            .appendTo( $(this).empty() )
            .on( 'change', function () {
                var val = $(this).val();
 
                table.column( i )
                    .search( val ? '^'+$(this).val()+'$' : val, true, false )
                    .draw();
            } );
 
        table.column( i ).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
    } );
} );
		$('#tabledraw').dataTable({
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		"order": [[ 1, "desc" ]],
		"columnDefs": [ 
            {
                "targets": [ 2 ],
				"visible": false
            },
			{
                "targets": [ 5 ],
				"visible": false
            },
			{
                "targets": [ 6 ],
				"visible": false
            }
        ]
		});
		$('#tablespec').dataTable({
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		"order": [[ 0, "desc" ]],
		"columnDefs": [ 
            {
                "targets": [ 3 ],
				"visible": false
            }
        ]
		});
		$('#tablewi').dataTable({
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		
		});
		
		$('#tablestencil').dataTable({
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		"order": [[ 0, "desc" ]]
		});
	} );
</script>
	
<div class="container">
			<div class="single-page-artical">
			<div align="right">
			<?php $getmodel=$_GET['model']; 
			echo "<h3><span class='glyphicon glyphicon-chevron-down'></span><strong>$getmodel</strong></h3>";
			?></div>
				<ul class="nav nav-tabs">
				<!-- Untuk Semua Tab.. pastikan a href=”#nama_id” sama dengan nama id di “Tap Pane” dibawah-->
				<li class="active"><a href="#dcn" data-toggle="tab"><b>Design Change Notice</b></a></li>
				 <!-- Untuk Tab pertama berikan li class=”active” agar pertama kali halaman di load tab langsung active-->
				<li><a href="#drawing" data-toggle="tab"><b>Drawing</b></a></li>
				<li><a href="#partspec" data-toggle="tab"><b>Part Spec</b></a></li>
				<li><a href="#wi" data-toggle="tab"><b>Work Instruction</b></a></li>
				<li><a href="#stencil" data-toggle="tab"><b>PWB Data</b></a></li>
						</ul>
<div class="artical-content">
<div class="tab-content">
<!-- start tab 1-->
 <div class="tab-pane active" id="dcn">
 
			<br><h2><span class="glyphicon glyphicon-th-large"></span>
			Design Change Notice</h2>
			<div class="artical-links">
			<div class="container">
			<?php

$result = mysql_query("SELECT * FROM dcn WHERE `dcn_model` LIKE  '%$getmodel%'");

?>

		  						 	<table id="tabledcn" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Recieving Date</th>
						<th>Section</th>
						<th>Effective</th>
						<th>DCN No</th>
						<th>DCN Title</th>
						<th>Part No</th>
						<th>Part Name</th>
						<th>Rev</th>
                        <th>Model</th>
						<th>PIC</th>
					</tr>
				</thead>
				<!--<tfoot align="center">
					<tr>
						<th>Reciving Date</th>
						<th>Section</th>
						<th>Effective</th>
					</tr>
				</tfoot>-->
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
					$type=$row['dcn_type'];
	switch ($type) {
    case "DCNS":
        $pic='PC-Purch-PE-QA';
        break;
		
    case "DCNSZ":
        $pic='PE-QA';
        break;
	case "DCI":
        $pic='Purch-PE-QA';
        break;	
}		
                        echo "<tr>";
						echo "<td align='center'>" . $row['dcn_dl'] . "</td>";
						echo "<td align='center'>" . $row['dcn_section'] . "</td>";
						echo "<td align='center'>" . $row['dcn_effect'] . "</td>";
						echo "<td align='center'>" . $row['dcn_no'] . "</td>";
						echo "<td>" . $row['dcn_title'] . "</td>";
						echo "<td align='center'>" .$row['dcn_partno'] . "</td>";
						echo "<td>" . $row['dcn_partname'] . "</td>";
						echo "<td align='center'>" . $row['dcn_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_dcn&id=$row[dcn_id]><strong>";
						echo substr("$row[dcn_model]",0,40);
						echo "<td align='center'>" . $pic . "</td>";
						
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
	</div>
	</div>
	</div>
  <!-- end tab 1-->
  <!-- start tab 2-->
  <div class="tab-pane" id="drawing">
  
									
  									<br><h2><span class="glyphicon glyphicon-th-large"></span>
									Part Drawing</h2>
									<div class="artical-links">
                                    <div class="container">
									<?php
$result = mysql_query("SELECT * FROM drawing WHERE `draw_model` LIKE  '%$getmodel%' ");
?>
		  		<table id="tabledraw" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Category</th>
						<th>Recieve</th>
						<th>Doc No</th>
						<th>Part No</th>
						<th>Part Name</th>
						<th>DCN No</th>
						<th>Comment</th>
                        <th>Rev</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
						echo "<td align='center'>" . $row['draw_category'] . "</td>";
						echo "<td align='center'>" . $row['draw_dl'] . "</td>";
						echo "<td align='center'>" . $row['draw_no'] . "</td>";
						echo "<td align='center'>" .$row['draw_partno'] . "</td>";
						echo "<td>" . $row['draw_partname'] . "</td>";
						echo "<td>" . $row['draw_dcnno'] . "</td>";
						echo "<td>" . $row['draw_comment'] . "</td>";
						echo "<td align='center'>" . $row['draw_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_drawing&id=$row[draw_id]><strong>$row[draw_model]</strong></a></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div>
			</div>
  
  </div>
  
	<!-- end tab 2-->
	<!-- start tab 3-->
	<div class="tab-pane" id="partspec">
 
			<br><h2><span class="glyphicon glyphicon-th-large"></span>
			Part Spesification</h2>
			<div class="artical-links">
			<div class="container">
			<?php

$result = mysql_query("SELECT * FROM partspec WHERE `spec_model` LIKE  '%$getmodel%'");

?>

		  						 	<table id="tablespec" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Part no</th>
						<th>Part name</th>
						<th>Supplier</th>
						<th>Spec</th>
						<th>Rev</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
						echo "<td align='center'>" .$row['spec_partno'] . "</td>";
						echo "<td>" . $row['spec_partname'] . "</td>";
						echo "<td align='center'>" . $row['spec_supplier'] . "</td>";
						echo "<td align='center'>" . $row['spec_spesification'] . "</td>";
						echo "<td align='center'>" . $row['spec_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_spec&id=$row[spec_id]><strong>$row[spec_model]</strong></a></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
	</div>
	</div>
	</div>
	<!-- end tab 3-->
	<!-- start tab 4-->
	<div class="tab-pane" id="wi">
 
			<br><h2><span class="glyphicon glyphicon-th-large"></span>
			Work Instruction</h2>
			<div class="artical-links">
			<div class="container">
			<?php

$result = mysql_query("SELECT * FROM wi WHERE `wi_model` LIKE  '%$getmodel%'");

?>

		  						 	<table id="tablewi" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						
						<th>Section</th>
						<th>Doc. No</th>
						<th>Title</th>
						<th>Status Stage</th>
						<th>Status</th>
						<th>Issue</th>
						<th>Rev</th>
						<th>Maker</th>
						<th>Model</th>
						
					</tr>
				</thead>
				<tbody>
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
						echo "<tr class='$class'>";
						
						echo "<td align='center'>" .$row['wi_section'] . "</td>";
						echo "<td align=center><a href=?page=detail_wi&id=$row[wi_id]><strong>$row[wi_docno]</strong></a></td>";
						echo "<td align='center'>" . $row['wi_title'] . "</td>";
						echo "<td align='center'>" . $row['wi_stagestat'] . "</td>";
						echo "<td align='center'>" . $row['wi_status'] . "</td>";
						echo "<td align='center'>" . $row['wi_issue'] . "</td>";
						echo "<td align='center'>" . $row['wi_rev'] . "</td>";
						echo "<td align='center'>" . $row['wi_maker'] . "</td>";
						echo "<td>" . $row['wi_model'] . "</td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
	</div>
	</div>
	</div>
	<!-- end tab 4-->
	<!-- start tab 5-->
	<div class="tab-pane" id="stencil">
 
			<br><h2><span class="glyphicon glyphicon-th-large"></span>
			Stencil, Gerber, XY</h2>
			<div class="artical-links">
			<div class="container">
			<?php

$result = mysql_query("SELECT * FROM stencil WHERE `stencil_model` LIKE  '%$getmodel%'");

?>

		  						 	<table id="tablestencil" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Receive</th>
						<th>WF no</th>
						<th>Doc No</th>
						<th>Part no</th>
						<th>Part name</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
						echo "<td align='center'>" . $row['stencil_dl'] . "</td>";
						echo "<td>" . $row['stencil_wfno'] . "</td>";
						echo "<td align='center'>" . $row['stencil_docno'] . "</td>";
						echo "<td align='center'>" . $row['stencil_partno'] . "</td>";
						echo "<td align='center'>" . $row['stencil_partname'] . "</td>";
						echo "<td align=center><a href=?page=detail_stencil&id=$row[stencil_id]><strong>$row[stencil_model]</strong></a></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
	</div>
	</div>
	</div>
	<!-- end tab 5-->
</div>
</div>
</div>
</div>