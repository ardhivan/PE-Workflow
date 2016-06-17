    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
    $(document).ready(function() {
        $('#stencil').DataTable({
			processing: true,
		scrollX: true,
        order: [[ 0, "desc" ],[ 8, "asc" ]],
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
		columnDefs: [ 
            {
                targets: [ 1 ],
                visible: false,
                
            },
			{
                targets: [ 2 ],
                visible: false,
                
            },
			{
                targets: [ 3 ],
                visible: false,
                
            },
			{
                targets: [ 4 ],
                visible: false,
                
            },
			{
                targets: [ 7 ],
                visible: false,
                
            },
			{
                targets: [ 8 ],
                visible: false,
                
            }
        ]
        });
    });
    </script>

<!-- script crud model-->
<script>
	// Fungsi untuk pengiriman form baca dokumentasinya di https://github.com/malsup/form/
	function set_ajax(identifier){
		
		var options = {
			beforeSend: function() {

				$(".progress-container").show();
				$(".btn-submit").attr("disabled",""); // Membuat button submit jadi tidak bisa terklik
			 
			},
			uploadProgress: function(event, position, total, percentComplete) {

				$(".progress-bar").attr('style','width'+percentComplete+'%');

			},
			success:function(data, textStatus, jqXHR,ui) {

				if ( data.trim() == "Sukses" ) {

					$(".progress-bar").attr('style','width:100%');
					setTimeout(function(){ location.reload() }, 2000);

				} else {

					$(".progress-container").hide();
					$("#pesan-required-field").html(data);
					$("#modal-peringatan").modal('show');
					$(".btn-submit").removeAttr('disabled','');
				}

			},
			error: function(jqXHR, textStatus, errorThrown){

				$(".progress-container").hide();
				$("#pesan-required-field").html('Gagal Memproses data<br/> textStatus='+textStatus+', errorThrown='+errorThrown);
				$("#modal-peringatan").modal('show');
			}
		 
		};
		 
		// kirim form dengan opsi yang telah dibuat diatas
		$("#"+identifier).ajaxForm(options);
	}

	$(function(){

		// Untuk pengiriman form tambah
		set_ajax('tambah-data');

		// Untuk pengiriman form sunting
		set_ajax('edit-data');

		// Hapus
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id') 

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","engine_drawing.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			var dl 		= div.data('dl');
			var wfno 	= div.data('wfno');
			var code 	= div.data('code');
			var docno 	= div.data('docno');
			var partno 	= div.data('partno');
			var partname = div.data('partname');
			var type = div.data('type');
			var dcnno = div.data('dcnno');
			var comment = div.data('comment');
			var rev 	= div.data('rev');
			var model 	= div.data('model');
			var issue 	= div.data('issue');
			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#dl').attr("value",dl);
			modal.find('#wfno').attr("value",wfno);
			modal.find('#code').attr("value",code);
			modal.find('#docno').attr("value",docno);
			modal.find('#partno').attr("value",partno);
			modal.find('#partname').attr("value",partname);
			modal.find('#type').attr("value",type);
			modal.find('#dcnno').attr("value",dcnno);
			$("#comment").html(comment);
			modal.find('#comment').attr("value",comment);
			modal.find('#rev').attr("value",rev);
			modal.find('#model').attr("value",model);
			modal.find('#issue').attr("value",issue);
			
			// Membuat combobox terpilih berdasarkan value yg tersimpan saat pengeditan
			modal.find('#type option').each(function(){
				  if ($(this).val() == type )
				    $(this).attr("selected","selected");
			
		});
		});
	});

</script>

<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header">DRAWING</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			<button class="btn btn-md pull-left" data-id='0' data-toggle="modal" data-target="#tambah-data"><span class="fa fa-plus"></span> New Drawing</button> <br /><br />
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-hover" id="stencil">
                                    <thead align="center">
					<tr>
						<th>Receive</th>
						<th>Doc Type</th> <!--hidden1-->
						<th>WF no</th> <!--hidden2-->
						<th>code</th> <!--hidden3-->
						<th>Doc No</th> <!--hidden4-->
						<th>Part no</th>
						<th>Part name</th>
						<th>DCN No</th> <!--hidden7-->
						<th>comment</th> <!--hidden8-->
						<th>Rev</th>
						<th>Model</th>
						<th>Setting</th>
					</tr>
				</thead>
				<tbody>
				<tr>				<?php $sql = $conn->query("SELECT * FROM drawing"); ?>

					<?php while ( $row = $sql->fetch_assoc() ) { ?>
					
					<?php 
						echo "<td align='center'>" . $row['draw_dl'] . "</td>";
						echo "<td align='center'>" .$row['draw_category'] . "</td>";
						echo "<td>" . $row['draw_wfno'] . "</td>";
						echo "<td>" . $row['draw_code'] . "</td>";
						echo "<td align='center'>" . $row['draw_no'] . "</td>";
						echo "<td align='center'>" . $row['draw_partno'] . "</td>";
						echo "<td align='center'>" . $row['draw_partname'] . "</td>";
						echo "<td align='center'>" . $row['draw_dcnno'] . "</td>";
						echo "<td align='center'>" . $row['draw_comment'] . "</td>";
						echo "<td align='center'>" . $row['draw_rev'] . "</td>";
						echo "<td align=center><a href=?page=detail_draw&id=$row[draw_id]><strong>";		
				
						if (strlen("$row[draw_model]") >= 20){
							echo substr("$row[draw_model]",0,20);
							echo "...</strong></a></td>";
						}else{
							echo substr("$row[draw_model]",0,20);
							echo "</strong></a></td>";}
						//echo "<td align=center><a href=?page=detail_draw&id=$row[draw_id]><strong>$row[draw_model]</strong></a></td>";
						
						?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $row['draw_id'] ?>"
									data-dl="<?php echo $row['draw_dl'] ?>"
									data-wfno="<?php echo $row['draw_wfno'] ?>"
									data-code="<?php echo $row['draw_code'] ?>"
									data-docno="<?php echo $row['draw_no'] ?>"
									data-partno="<?php echo $row['draw_partno'] ?>"
									data-partname="<?php echo $row['draw_partname'] ?>"
									data-type="<?php echo $row['draw_category'] ?>"
									data-dcnno="<?php echo $row['draw_dcnno'] ?>"
									data-comment="<?php echo $row['draw_comment'] ?>"
									data-rev="<?php echo $row['draw_rev'] ?>"
									data-model="<?php echo $row['draw_model'] ?>"
									data-issue="<?php echo $row['draw_issue'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Edit
								</a>
							<span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $row['draw_no'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Delete</a>
							</td>
						</tr>
				<?php	
				 }
                ?>
				</tbody>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->	
</div>
 </div>
 
							<!-- Pesan jika telah melakukan aksi -->
							<?php if ( isset( $_SESSION['info'] ) ) { ?>
								<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;"> 
									Berhasil <?php echo $_SESSION['info'] ?> Data
									</div>
								<?php unset( $_SESSION['info'] ); } ?>	
	
	<!-- Modal tambah data -->
	<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="engine_drawing.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">New Drawing</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="dl">Receive Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="dl" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							</div>
							<div class="form-group">
						      <label for="wfno">Workflow Number</label>
						      <input type="text" name="wfno"  class="form-control" placeholder="Workflow Number">
						    </div>
							<div class="form-group">
						      <label for="code">Sort Code / Doc Class</label>
						      <input type="text" name="code"  class="form-control" placeholder="Sort Code / Doc Class">
						    </div>
							
							<div class="form-group">
						      <label for="docno">Document Number</label>
						      <input type="text" name="docno"  class="form-control" placeholder="Document Number">
						    </div>
							<div class="form-group">
						      <label for="partno">Part Number</label>
						      <input type="text" name="partno" class="form-control" placeholder="Part Number">
						    </div>
							<div class="form-group">
						      <label for="partname">Part Name</label>
						      <input type="text" name="partname"  class="form-control" placeholder="Part Name">
						    </div>
							<div class="form-group">
						      <label for="type">Document Type</label>
						      <select name="type" class="form-control">
						        <option value="">Select Type</option>
								<option value="Part">Part Drawing</option>
						        <option value="Assembly">Assy Drawing</option>
								<option value="Specification">Specification</option>
								<option value="JIG">JIG</option>
								<option value="PWB Data">PWB Data</option>
								<option value="PWB Drawing">PWB Drawing</option>
								<option value="Quotation">Quotation Drawing</option>
								<option value="Part List">Part List</option>
						      </select>
						    </div>
							<div class="form-group">
						      <label for="dcnno">DCN No.</label>
						       <input type="text" name="dcnno"  class="form-control" placeholder="DCN No">
						    </div>
							<div class="form-group">
						      <label for="comment">Comment</label>
						      <textarea class="form-control" name="comment" placeholder="Comment goes here... (type <br> to make new a line-break)" rows="5" ></textarea> 
						    </div>
							<div class="form-group">
						      <label for="rev">Revision</label>
						      <input type="text" name="rev" class="form-control" placeholder="Revision">
						    </div>
							<div class="form-group">
						      <label for="issue">Issue Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="issue" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							</div>
							<div class="form-group">
						      <label for="model">Model</label>
						      <input type="text" name="model" class="form-control" placeholder="Model">
						    </div>
							
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">File Attachment</label>
							  <input type="file" accept="*" name="file[]" multiple />
						    </div>
						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> SAVE</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> CANCEL</button>
					</div>

				</form>

			</div>
		</div>
	</div>

	<!-- Modal edit data -->
	<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="engine_drawing.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="dl">Receive Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="dl" id="dl" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							</div>
							<div class="form-group">
						      <label for="wfno">Workflow Number</label>
						      <input type="text" name="wfno" id="wfno" class="form-control" placeholder="Workflow Number">
						    </div>
							<div class="form-group">
						      <label for="code">Sort Code / Doc Class</label>
						      <input type="text" name="code" id="code" class="form-control" placeholder="Sort Code / Doc Class">
						    </div>
							<div class="form-group">
						      <label for="docno">Document Number</label>
						      <input type="text" name="docno" id="docno" class="form-control" placeholder="Document Number">
						    </div>
							<div class="form-group">
						      <label for="partno">Part Number</label>
						      <input type="text" name="partno" id="partno" class="form-control" placeholder="Part Number">
						    </div>
							<div class="form-group">
						      <label for="partname">Part Name</label>
						      <input type="text" name="partname" id="partname" class="form-control" placeholder="Part Name">
						    </div>
							<div class="form-group">
						      <label for="type">Document Type</label>
						      <select name="type" id="type" class="form-control">
						        <option value="">Select Type</option>
								<option value="Part">Part Drawing</option>
						        <option value="Assembly">Assy Drawing</option>
								<option value="Specification">Specification</option>
								<option value="JIG">JIG</option>
								<option value="PWB DATA">PWB Data</option>
								<option value="PWB DRAWING">PWB Drawing</option>
								<option value="Quotation">Quotation Drawing</option>
								<option value="Part List">Part List</option>
						      </select>
						    </div>
							<div class="form-group">
						      <label for="dcnno">DCN No</label>
						      <input type="text" name="dcnno" id="dcnno" class="form-control" placeholder="DCN No">
							
						    </div>
							<div class="form-group">
						      <label for="comment">Comment</label>
						      <textarea class="form-control" name="comment" id="comment" placeholder="Comment" rows="5" ></textarea> 
						    </div>
							<div class="form-group">
						      <label for="rev">Revision</label>
						      <input type="text" name="rev" id="rev" class="form-control" placeholder="Revision">
						    </div>
							<div class="form-group">
						      <label for="model">Model</label>
						      <input type="text" name="model" id="model" class="form-control" placeholder="Model">
						    </div>
							<div class="form-group">
						      <label for="issue">Issue Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="issue" id="issue" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							</div>
						Ignore if there is no file changes
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">File Attachment</label>
							  <input type="file" accept="*" name="file[]" multiple />
						    </div>
						  </fieldset>

						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> SAVE</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> CANCEL</button>
					</div>

				</form>

			</div>
		</div>
	</div>

	<!-- modal konfirmasi-->
	<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Confirmation</h4>
				</div>

				<div class="modal-body" style="background:#d9534f;color:#fff">
					Are you sure to delete this data?
				</div>

				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-true">YES</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
				</div>

			</div>
		</div>
	</div>

	<!-- Modal peringatan jika field belum terisi sempurna -->
	<div id="modal-peringatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-warning">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="title"><span class="fa fa-warning"></span> <b>NOTICE</b></h4>
				</div>

				<div class="modal-body" style="background: #d9534f; color: #fff;">
					<div id="pesan-required-field"></div>
				</div>

				<div class="modal-footer">

					<center><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></center>

				</div>

			</div>
		</div>
	</div>
<!--datepicker-->
<script type="text/javascript">
 $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script>
