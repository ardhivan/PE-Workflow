
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
		$('#drawing').dataTable({
		"order": [[ 0, "desc" ],[ 7, "asc" ]],
		"lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
		"columnDefs": [ 
            {
                "targets": [ 1 ],
                "visible": false
            },
			{
                "targets": [ 5 ],
                "visible": false
            },
			{
                "targets": [ 6 ],
                "visible": false
            },
			{
                "targets": [ 7 ],
                "visible": false
            }
        ]
		});
	} );
	</script>
	<?php include "connect.php";?>
  									<h2><span class="glyphicon glyphicon-th-list"></span><STRONG> Drawing List All Model</STRONG></h2>
									<br>
                                    <div class="container">
									<?php
$result = mysql_query("SELECT * FROM drawing ");
?>
		  						 	<table id="drawing" class="table display table-condensed" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Receiving Date</th>
						<th>Category</th>
						<th>Draw No</th>
						<th>Part No</th>
						<th>Part Name</th>
						<th>DCN No</th>
						<th>Comment</th>
						<th>Refno</th>	
                        <th>Rev</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
						echo "<td align='center'>" . $row['draw_dl'] . "</td>";
						echo "<td align='center'>" . $row['draw_category'] . "</td>";
						echo "<td align='center'>" . $row['draw_no'] . "</td>";
						echo "<td align='center'>" .$row['draw_partno'] . "</td>";
						echo "<td>" . $row['draw_partname'] . "</td>";
						echo "<td>" . $row['draw_dcnno'] . "</td>";
						echo "<td>" . $row['draw_comment'] . "</td>";
						echo "<td>" . $row['draw_wfno'] . "</td>";
						echo "<td align='center'>" . $row['draw_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_drawing&id=$row[draw_id]><strong>";
						echo substr("$row[draw_model]",0,40);
						echo "</strong></a></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div>

  

  
								    </div>							    
					</div>
					</div>
