
	 
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
		"order": [[ 0, "desc" ],[ 5, "asc" ]],
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		columnDefs: [ 
            {
                targets: [ 4 ],
                visible: false
                
            } ]
       
		});
	} );
	</script>
  									<h2><span class="glyphicon glyphicon-th-list"></span><STRONG> Part Spec List All Model</STRONG></h2>
									<br>
                                    <div class="container">
									<?php

$result = mysql_query("SELECT * FROM partspec");

?>

		  						 	<table id="#tablepartspec" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Receive</th>
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
						echo "<td align='center'>" . $row['spec_dl'] . "</td>";
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
					</div>
