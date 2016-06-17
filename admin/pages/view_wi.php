    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
    $(document).ready(function() {
        $('#tablewi').dataTable({
		scrollX: true,
		dom: 'lfrtipT<"clear">'		
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
			modal.find('#hapus-true').attr("href","engine_wi.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			var model 	= div.data('model');
			var section = div.data('section');
			var docno 	= div.data('docno');
			var title 	= div.data('title');
			var stage 	= div.data('stage');
			var status 	= div.data('status');
			
			var issue = div.data('issue');
			var rev	= div.data('rev');
			var maker = div.data('maker');
			var filename = div.data('filename');
			var filename2 = div.data('filename2');
			var filename3 = div.data('filename2');
			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#model').attr("value",model);
			modal.find('#section').attr("value",section);
			modal.find('#docno').attr("value",docno);
			modal.find('#title').attr("value",title);
			modal.find('#stage').attr("value",stage);
			modal.find('#status').attr("value",status);
			
			modal.find('#issue').attr("value",issue);
			modal.find('#rev').attr("value",rev);
			modal.find('#maker').attr("value",maker); 
			modal.find('#filename').attr("value",filename);
			modal.find('#filename2').attr("value",filename2);
			modal.find('#filename2').attr("value",filename2); 
			
			// Membuat combobox terpilih berdasarkan status yg tersimpan saat pengeditan
			modal.find('#status option').each(function(){
				  if ($(this).val() == status )
				    $(this).attr("selected","selected");
			});
			// Membuat combobox terpilih berdasarkan stage yg tersimpan saat pengeditan
			modal.find('#stage option').each(function(){
				  if ($(this).val() == stage )
				    $(this).attr("selected","selected");
			});
		});

	});

</script>

<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header">DATA WORK INSTRUCTION</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			<button class="btn btn-md pull-left" data-id='0' data-toggle="modal" data-target="#tambah-data"><span class="fa fa-plus"></span> Add NEW WI</button> <br /><br />
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table id="tablewi" class="table table-condensed table-hover display" cellspacing="0">
				<thead align="center">
					<tr>
						<th>Model</th>
						<th>Section</th>
						<th>Doc. No</th>
						<th>Title</th>
						<th>Status Stage</th>
						<th>Status</th>
						<th>Issue</th>
						<th>Rev</th>
						<th>Maker</th>
						<th>Setting</th>
					</tr>

				</thead>
				<tbody>
								<?php $sql = $conn->query("SELECT * FROM wi"); ?>

					<?php while ( $row = $sql->fetch_assoc() ) { ?>
					<?php 
					$type=$row['wi_status'];
	switch ($type) {
    case "OPEN":
        $class='danger';
        break;
    case "CLOSE":
        $class='success';
        break;
	case "WAITING APPROVAL":
        $class='warning';
        break;	
}		
						echo "<tr class='$class'>";
						echo "<td>" . $row['wi_model'] . "</td>";
						echo "<td align='center'>" .$row['wi_section'] . "</td>";
						echo "<td align=center><a href=?page=detail_wi&id=$row[wi_id]><strong>$row[wi_docno]</strong></a></td>";
						echo "<td align='center'>" . $row['wi_title'] . "</td>";
						echo "<td align='center'>" . $row['wi_stagestat'] . "</td>";
						echo "<td align='center'>" . $row['wi_status'] . "</td>";
						echo "<td align='center'>" . $row['wi_issue'] . "</td>";
						echo "<td align='center'>" . $row['wi_rev'] . "</td>";
						echo "<td align='center'>" . $row['wi_maker'] . "</td>";
						?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $row['wi_id'] ?>"
									data-model="<?php echo $row['wi_model'] ?>"
									data-section="<?php echo $row['wi_section'] ?>"
									data-docno="<?php echo $row['wi_docno'] ?>"
									data-title="<?php echo $row['wi_title'] ?>"
									data-stage="<?php echo $row['wi_stagestat'] ?>"
									data-status="<?php echo $row['wi_status'] ?>"
									data-issue="<?php echo $row['wi_issue'] ?>"
									data-rev="<?php echo $row['wi_rev'] ?>"
									data-maker="<?php echo $row['wi_maker'] ?>"
									data-filename="<?php echo $row['wi_filename'] ?>"
									data-file="<?php echo $row['wi_file'] ?>"
									data-filename2="<?php echo $row['wi_filename2'] ?>"
									data-file2="<?php echo $row['wi_file2'] ?>"
									data-filename3="<?php echo $row['wi_filename3'] ?>"
									data-file3="<?php echo $row['wi_file3'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i>
								</a>
							<span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $row['wi_docno'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i></a>
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

				<form name="form-wi" id="form-data" method="post" action="engine_wi.php?p=tambah" enctype="multipart/form-data">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add Data</h4>
					</div>

					<div class="modal-body">
						  <fieldset>

						    <div class="form-group">
						      <label for="model">Model Name</label>
						      <input type="text" name="model" class="form-control" placeholder="Model Name">
						    </div>
							<div class="form-group">
						      <label for="section">Section</label>
						      <input type="text" name="section" class="form-control" placeholder="Section">
						    </div>
							<div class="form-group">
						      <label for="docno">Doc No.</label>
						      <input type="text" name="docno" class="form-control" placeholder="Doc No">
						    </div>
							<div class="form-group">
						      <label for="title">Doc Title</label>
						      <input type="text" name="title" class="form-control" placeholder="Doc Title">
						    </div>
							
							<div class="form-group">
						      <label for="stage">Production Stage</label>
						      <select name="stage" class="form-control">
						        <option value="">Select Stage</option>						        
						        <option value="TP">TP</option>
								<option value="MP">MP</option>
						      </select>
							</div>  
							<div class="form-group">
						      <label for="status">Status</label>
						      <select name="status" class="form-control">
						        <option value="">Select Status</option>	
								<option value="WAITING">WAITING APPROVAL</option>								
						        <option value="OPEN">OPEN</option>
								<option value="CLOSE">CLOSE</option>
								
						      </select>
							</div>  
							<div class="form-group">
						      <label for="issue">Issue Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="issue" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value=""/>
						    </div>
							<div class="form-group">
						      <label for="rev">Revision</label>
						      <input type="text" name="rev" class="form-control" placeholder="Revision">
						    </div>
							<div class="form-group">
						      <label for="maker">Maker</label>
						      <input type="text" name="maker" class="form-control" placeholder="Maker">
						    </div>
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">Upload File WI</label>
							  <input type="file" name="wi"/>
						    </div>
							
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">Upload File Masterlist</label>
							  <input type="file" name="masterlist" />
						    </div>
							
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">Upload File DCC</label>
							  <input type="file" name="dcc" />
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

				<form id="form-data" method="post" action="engine_wi.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="model">Model Name</label>
						      <input type="text" name="model" id="model" class="form-control" placeholder="Model Name">
						    </div>
							<div class="form-group">
						      <label for="section">Section</label>
						      <input type="text" name="section" id="section" class="form-control" placeholder="Section">
						    </div>
							<div class="form-group">
						      <label for="docno">Doc No.</label>
						      <input type="text" name="docno" id="docno" class="form-control" placeholder="Doc No">
						    </div>
							<div class="form-group">
						      <label for="title">Doc Title</label>
						      <input type="text" name="title" id="title" class="form-control" placeholder="Doc Title">
						    </div>
							
							<div class="form-group">
						      <label for="stage">Production Stage</label>
						      <select name="stage" id="stage" class="form-control">
						        <option value="">Select Stage</option>						        
						        <option value="TP">TP</option>
								<option value="MP">MP</option>
						      </select>
							</div>  
							<div class="form-group">
						      <label for="status">Status</label>
						      <select name="status" id="status" class="form-control">
						        <option value="">Select Status</option>						        
						        <option value="OPEN">OPEN</option>
								<option value="CLOSE">CLOSE</option>
								<option value="WAITING APPROVAL">WAITING APPROVAL</option>
						      </select>
							</div>  
							<div class="form-group">
						      <label for="issue">Issue Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="issue" id="issue" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value=""/>
						    </div>
							<div class="form-group">
						      <label for="rev">Revision</label>
						      <input type="text" name="rev" id="rev" class="form-control" placeholder="Revision On TP">
						    </div>
							<div class="form-group">
						      <label for="maker">Maker</label>
						      <input type="text" name="maker" id="maker" class="form-control" placeholder="Maker On TP">
						    </div>
						    
							<div class="form-group">
						      <label for="makermp">FILE WI</label>
						      <input type="text" name="filename" id="filename" class="form-control" placeholder="" readonly>
						    </div>
							<div class="form-group">
						      <label for="makermp">FILE DCC</label>
						      <input type="text" name="filename2" id="filename2" class="form-control" placeholder="" readonly>
						    </div>
							<div class="form-group">
						      <label for="makermp">FILE MASTERLIST</label>
						      <input type="text" name="filename3" id="filename3" class="form-control" placeholder="" readonly>
						    </div>
							<p>Ignore if there is no file changes</p>
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">Replace File WI</label>
							  <input type="file" accept="*" name="editwi" />
						    </div>
							
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">Replace File DCC</label>
							  <input type="file" accept="*" name="editdcc" />
						    </div>
							
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">Replace File MASTERLIST</label>
							  <input type="file" accept="*" name="editmasterlist" />
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
