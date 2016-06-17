
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
		"order": [[ 1, "asc" ],[ 0, "asc" ]],
		"lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
		"info":false
		});
	} );
	</script>
  									<h2><STRONG>SELECT MODEL</STRONG></h2>
                                    <div class="container">
									
									<?php

$result = mysql_query("SELECT * FROM model ");
?>

		  						 	<table id="example" class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>MODEL</th>
						<th>Division</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
						echo "<td align=center><h2><a href=?page=main&model=$row[model_name]><strong>$row[model_name]</strong></a></h2></td>";
						echo "<td align='center'><h2>" . $row['model_division'] . "</h2></td>";

                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>
			</div>

  

  
								    </div>							    
					</div>
					</div>