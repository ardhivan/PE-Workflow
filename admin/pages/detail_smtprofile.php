	
<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header"> SMT Profile Data</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php
									$g=$_GET['id'];
									$result = mysql_query("SELECT * FROM  `smtprofile` WHERE id ='$g'");
									?>
<?php 
                    while($row = mysql_fetch_array($result)) {
	
					echo "
					
					<table class='table table-striped'>
					<tr>
						<td width='10%'>Data ID</td>
						<td>&nbsp:&nbsp</td>
						<td width='90%'> $row[id]  </td>
					</tr>
					<tr>	
						<td>PWB Name</td>
						<td>&nbsp:&nbsp</td>
						<td> $row[pwb]</td> 
					</tr>
					<tr>
						<td> Model</td>
						<td>&nbsp:&nbsp</td>
						<td>  $row[model]  </td>
					</tr>
								</table>";
					@$no=$row[id];
					}
                ?>
				

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

                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->	
</div>
 </div>

