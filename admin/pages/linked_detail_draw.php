<script>
    $(document).ready(function() {
        $('#dcn').DataTable({
		scrollX: true,
        order: [[ 0, "desc" ]],
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]]
        });
    });
    </script>				
<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header">Design Change Notice</h1>
                </div>
                <div class="col-lg-12">
       
									
									<?php
									$g=$_GET['partno'];
									$result = mysql_query("SELECT * FROM  `drawing` WHERE draw_partno LIKE  '%$g%'");
									?>
									
                   <table class="table table-striped table-hover" id="dcn">
				<thead align="center">
					<tr>
					
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
						echo "<td align='center'>" . $row['draw_no'] . "</td>";
						echo "<td align='center'>" .$row['draw_partno'] . "</td>";
						echo "<td>" . $row['draw_partname'] . "</td>";
						echo "<td align='center'>" . $row['draw_dcnno'] . "</td>";
						echo "<td align='center'>" . $row['draw_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_draw&id=$row[draw_id]><strong>";
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
	