
<?php include "connect.php";?>
<div class="container">
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$('table.display').dataTable({
		
		});
	} );
	</script>				
						<div class="single-page-artical">
								<div class="artical-content">
									<h2>Drawing</h2>
									<div class="artical-links">
                                    <div class="container">
									<?php
									$g=$_GET['partno'];
									$result = mysql_query("SELECT * FROM  `drawing` WHERE draw_partno LIKE  '%$g%'");
									?>
									
                   <table class="table display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Category</th>
						<th>Doc No</th>
						<th>Part No</th>
						<th>Part Name</th>
						<th>DCN No</th>
                        <th>Rev</th>
						<th>Model</th>
					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row = mysql_fetch_array($result)) {
                        echo "<tr>";
						echo "<td align='center'>" . $row['draw_category'] . "</td>";
						echo "<td align='center'>" . $row['draw_no'] . "</td>";
						echo "<td align='center'>" .$row['draw_partno'] . "</td>";
						echo "<td>" . $row['draw_partname'] . "</td>";
						echo "<td align='center'>" . $row['draw_dcnno'] . "</td>";
						echo "<td align='center'>" . $row['draw_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_drawing&id=$row[draw_id]><strong>";
						echo substr("$row[draw_model]",0,25);
						echo "</strong></a></td>";
                        echo "</tr>";
                    }
                ?>
				</tbody>
			</table>					 	
									</div>
									</div>
								    </div>
								    
								 
				
						<div class="clearfix">
						</div>
					</div>
					</div>