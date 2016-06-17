
	<script>
    $(document).ready(function() {
        $('#drawing').dataTable({
		scrollY:  200,
		scrollX: true,
        scrollCollapse: true,
		paging: false,
        ordering: false,
        info:     false,
		filter: false
		
		});
    });
    </script>
	
	
	
<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header"> Drawing</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `drawing` WHERE draw_id ='$g'");
									?>
<?php 
                    while($row = mysql_fetch_array($result)) {
	
					echo "
					<h2><span class='fa fa-angle-double-down'></span><strong>$row[draw_model]</strong></h2>
					<h4><strong>$row[draw_category]</strong></h4>
					<table class='table table-condensed table-striped' width='100%' >
					<tr>
						<td  width='15%'> Receive On</td>
						<td width='1%' align='left'>&nbsp:&nbsp</td>
						<td> $row[draw_dl]  </td>
						
					</tr>
					<tr>	
						<td>Workflow No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[draw_wfno]</td> 
					</tr>
					<tr>
						<td> Code</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_code]  </td>
					</tr>
					<tr>
						<td> Doc No</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_no]  </td>
					</tr>
					<tr>
						<td>Part No</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[draw_partno]  </td>
					</tr>
					<tr>
						<td>Part Name</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_partname]  </td>
					</tr>
					<tr>
						<td>Comment</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_comment]  </td>
					</tr>
					<tr>	
						<td>Rev</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_rev]  </td>
                    </tr>
					<tr>	
						<td>Issued to Internal</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[draw_issue]  </td>
                    </tr>

					";
					@$no=$row[draw_no];
					@$dcn=$row[draw_dcnno];
					}
                ?>
				
			</table>
<div id=""><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `files` WHERE `file_docno` ='$no'");
									?>
<h4><strong>File Attachment</strong></h4>
									<table class="table display table-condensed" cellspacing="0">
				<thead>
				</thead>
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

<div id="tabelbawah"><!-- Start-->		
<?php    
									$result= mysql_query("SELECT * FROM  `dcn` WHERE `dcn_no` LIKE  '%$dcn%'");
									?>
<h4><strong>DCN concerned with this drawing:</strong></h4>
									<table id="drawing" class="table display" cellspacing="0">
				<thead>
					<tr>
						<th>DCN No</th>
						<th>DCN Title</th>

					</tr>
				</thead>
				<tbody>
					<?php 
                    while($row2= mysql_fetch_array($result)) {
                        echo "<tr align=center>";
						echo "<td><a href=?page=detail_dcn&id=$row2[dcn_id] onclick='window.open(this.href); return false;'><strong>";
						echo "$row2[dcn_no]";
						echo "</strong></a></td>";
						echo "<td>";
						echo substr("$row2[dcn_title]",0,100);
                        echo "...</td></tr>";
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

