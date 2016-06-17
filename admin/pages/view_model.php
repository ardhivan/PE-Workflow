    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
    $(document).ready(function() {
        $('#model').DataTable({
        order: [[ 1, "asc" ],[ 0, "asc" ]],
		lengthMenu: [[5, 10, 50, -1], [5, 10, 50, "All"]],
		info:false	
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
			modal.find('#hapus-true').attr("href","engine_model.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			var name 	= div.data('name');
			var division= div.data('division');
			var stage 	= div.data('stage');

			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#name').attr("value",name);
			modal.find('#division').attr("value",division);
			modal.find('#stage').attr("value",stage);
			

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#division option').each(function(){
				  if ($(this).val() == division )
				    $(this).attr("selected","selected");
			});
			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
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
                    <h1 class="page-header">DATA MODEL</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			<button class="btn btn-md pull-left" data-id='0' data-toggle="modal" data-target="#tambah-data"><span class="fa fa-plus"></span> Add NEW Model</button> <br /><br />
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-hover" id="model">
                                    <thead align="center">
					<tr>
						<th>MODEL</th>
						<th>Division</th>
						<th>Stage</th>
						<th>Setting</th>
					</tr>
				</thead>
				<tbody>
				<tr>				<?php $sql = $conn->query("SELECT * FROM model"); ?>

					<?php while ( $r = $sql->fetch_assoc() ) { ?>
					<?php 

						echo "<td align=center><h5><strong>$r[model_name]</strong></h5></td>";
						echo "<td align='center'><h5>" . $r['model_division'] . "</h5></td>";
						echo "<td align='center'><h5>" . $r['model_stage'] . "</h5></td>";?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $r['model_id'] ?>"
									data-name="<?php echo $r['model_name'] ?>"
									data-division="<?php echo $r['model_division'] ?>"
									data-stage="<?php echo $r['model_stage'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Edit
								</a>
							<span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $r['model_name'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Delete</a>
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

				<form id="form-data" method="post" action="engine_model.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="name">Model Name</label>
						      <input type="text" name="name" class="form-control" placeholder="Model Name">
						    </div>

						    <div class="form-group">
						      <label for="division">Division</label>
						      <select name="division" class="form-control">
						        <option value="">Select Division</option>
						        <option value="AV">AV</option>
								<option value="GD">GD</option>
								<option value="PA">PA</option>
								<option value="PIANO">PIANO</option>
								<option value="SN">SN</option>
						      </select>
						    </div>

						    <div class="form-group">
						      <label for="stage">Production Stage</label>
						      <select name="stage" class="form-control">
						        <option value="">Select Stage</option>
						        <option value="ES">ES</option>
						        <option value="TP">TP</option>
								<option value="MPP">MPP</option>
								<option value="MP">MP</option>
						      </select>
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

				<form id="form-data" method="post" action="engine_model.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="name">Model Name</label>
						      <input type="text" name="name" id="name" class="form-control" placeholder="Model Name">
						    </div>

						    <div class="form-group">
						      <label for="division">Division</label>
						      <select id="division" name="division" class="form-control">
						        <option value="">Select Division</option>
						        <option value="AV">AV</option>
								<option value="GD">GD</option>
								<option value="PA">PA</option>
								<option value="PIANO">PIANO</option>
								<option value="SN">SN</option>
						      </select>
						    </div>
							
							<div class="form-group">
						      <label for="stage">Production Stage</label>
						      <select id="stage" name="stage" class="form-control">
						        <option value="">Select Stage</option>
								<option value="ES">ES</option>
						        <option value="TP">TP</option>
								<option value="MPP">MPP</option>
								<option value="MP">MP</option>
						      </select>
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

