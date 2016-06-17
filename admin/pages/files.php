    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
    $(document).ready(function() {
        $('#files').DataTable({
			scrollX: true,
        order: [ 0, "desc" ],
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
		
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
			modal.find('#hapus-true').attr("href","engine_files.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			var docno 	= div.data('docno');
			var filetype 	= div.data('filetype');
			var filename 	= div.data('filename');
			var filedir 	= div.data('filedir');
			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#docno').attr("value",docno);
			modal.find('#filename').attr("value",filename);
			modal.find('#filedir').attr("value",filedir);
			// Membuat combobox terpilih berdasarkan value yg tersimpan saat pengeditan
			modal.find('#filetype option').each(function(){
				  if ($(this).val() == filetype )
				    $(this).attr("selected","selected");
			});
		});

	});

</script>

<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header">FILE MANAGER</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			<button class="btn btn-md pull-left" data-id='0' data-toggle="modal" data-target="#tambah-data"><span class="fa fa-plus"></span> Attach New File</button> <br /><br />
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-hover" id="files">
                                    <thead align="center">
					<tr>
						<th>Data ID</th>
						<th>Doc No.</th>
						<th>Doc Type</th>
						<th>File Name</th>
					
						<th>Setting</th>
					</tr>
				</thead>
				<tbody>
				<tr>				<?php $sql = $conn->query("SELECT * FROM files"); ?>

					<?php while ( $row = $sql->fetch_assoc() ) { ?>
					
					<?php 
						echo "<td align='center'>" . $row['file_id'] . "</td>";
						echo "<td align='center'>" .$row['file_docno'] . "</td>";
						echo "<td align='center'>" .$row['file_type'] . "</td>";
						echo "<td align=center><a href='../../$row[file_path]' onclick='window.open(this.href); return false;'><strong>$row[file_name]</strong></a></td>";
			
						?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $row['file_id'] ?>"
									data-docno="<?php echo $row['file_docno'] ?>"
									data-filetype="<?php echo $row['file_type'] ?>"
									data-filename="<?php echo $row['file_name'] ?>"
									data-filedir="<?php echo $row['file_path'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Edit
								</a>
							<span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $row['file_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Delete</a>
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

				<form id="form-data" method="post" action="engine_files.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Attach New File</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

							<div class="form-group">
						      <label for="docno">Document Number</label>
						      <input type="text" name="docno"  class="form-control" placeholder="Document Number">
						    </div>
							
							<div class="form-group">
						      <label for="filetype">Document Type</label>
						      <select name="filetype" class="form-control">
						        <option value="">Select Document Type</option>
						        <option value="dcn">DCN</option>
								<option value="drawing">Drawing</option>
								<option value="partspec">Part Spec</option>
								<option value="stencil">Stencil</option>
						      </select>
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

				<form id="form-data" method="post" action="engine_files.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>
							<div class="form-group">
						      <label for="docno">Document Number</label>
						      <input type="text" name="docno" id="docno" class="form-control" placeholder="Document Number">
						    </div>
							
							<div class="form-group">
						      <label for="filetype">Document Type</label>
						      <select id="filetype" name="filetype" class="form-control">
						        <option value="">Select Document Type</option>
						        <option value="dcn">DCN</option>
								<option value="drawing">Drawing</option>
								<option value="partspec">Part Spec</option>
								<option value="stencil">Stencil</option>

						      </select>
						    </div>
							
						    <div class="form-group">
						      <label for="makermp">Filename</label>
						      <input type="text" name="filename" id="filename" class="form-control" placeholder="" readonly>
						    </div>
							<div class="form-group">
						      <label for="makermp">File directory</label>
						      <input type="text" name="filename2" id="filedir" class="form-control" placeholder="" readonly>
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
