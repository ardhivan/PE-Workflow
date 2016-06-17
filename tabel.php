<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" class="init">


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
</head>

<body><?php
include "connect.php";
$result = mysql_query("SELECT * FROM result order by id desc");
?>

		  						 	<table id="example" class="display" cellspacing="0" width="100%" border="0">
				<thead align="center">
					<tr>
						<th>Doc Type</th>
						<th>Part Name</th>
						<th>Workflow No</th>
						<th>Doc no</th>
                        <th>model_name</th>
					</tr>
				</thead>
<tfoot>
					<tr>
						<th>Doc Type</th>
						<th>Part Name</th>

					</tr>
				</tfoot>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
						echo "<td align='center'>" . $row['doc_type'] . "</td>";
						echo "<td>" . $row['part_name'] . "</td>";
						echo "<td align='center'><a href='#'>" . $row['workflow_no'] . "</a></td>";
						echo "<td align='center'>" . $row['doc_no'] . "</td>";
						echo "<td align='center'>" . $row['model_name'] . "</td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
</body>
</html>