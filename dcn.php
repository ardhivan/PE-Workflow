
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./js/bootstrap.min.js"></script>
	
<div class="container">
<div class="single-page-artical">
<div class="artical-content">
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('table.display').dataTable({
		"order": [ 0, "desc" ],
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		"columnDefs": [ 
            {
                "targets": [ 2 ],
				"visible": false
            },
			{
                "targets": [ 3 ],
				"visible": false
            },
			{
                "targets": [ 4 ],
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
	} );
	$(document).ready(function() {
    var table = $('#example').DataTable();
 
    $("#example tfoot th").each( function ( i ) {
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
	</script>
  									<h2><span class="glyphicon glyphicon-th-list"></span><STRONG> DCN List All Model</STRONG></h2>
									<br>
                                    <div class="container">
									<?php

$result = mysql_query("SELECT * FROM dcn");

?>

		  						 	<table id="example" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Reciving Date</th>
						<th>DCN No</th>
						<th>DCN Title</th>
						<th>DCN spec</th>
						<th>type</th>
						<th>Part No</th>
						<th>Ref No</th>
						<th>Part Name</th>
						<th>Effective</th>
						<th>Section</th>
                        <th>Model</th>
						<th>PIC</th>
					</tr>
				</thead>

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
						
						echo "<td align='center'>" . $row['dcn_no'] . "</td>";
						echo "<td>" . $row['dcn_title'] . "</td>";
						echo "<td>" . $row['dcn_spec'] . "</td>";
						echo "<td align='center'>" . $row['dcn_type'] . "</td>";
						echo "<td align='center'>" .$row['dcn_partno'] . "</td>";
						echo "<td align='center'>" .$row['dcn_nowf'] . "</td>";
						echo "<td>";
						
						if (strlen("$row[dcn_partname]") >= 40){
							echo substr("$row[dcn_partname]",0,40);
							echo "...</td>";
						}else{
							echo substr("$row[dcn_partname]",0,40);
							echo "</td>";}
						echo "<td align='center'>" . $row['dcn_effect'] . "</td>";
						echo "<td align='center'>" . $row['dcn_section'] . "</td>";
						
						echo "<td align=center><a href=?page=detail_dcn&id=$row[dcn_id]><strong>";
						if (strlen("$row[dcn_model]") >= 20){
							echo substr("$row[dcn_model]",0,20);
							echo "...</strong></a></td>";
						}else{
							echo substr("$row[dcn_model]",0,20);
							echo "</strong></a></td>";}
							
						echo "<td align='center'> $pic</td>";	
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div>
								    </div>							    
					</div>
					</div>
