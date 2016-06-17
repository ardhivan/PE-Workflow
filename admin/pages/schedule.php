<?php
function tanggal_sekarang($time=FALSE)
{
	date_default_timezone_set('Asia/Jakarta');
	$str_format='';
	if($time==FALSE)
	{
		$str_format= date("Y-m-d");
	}else{
		$str_format= date("Y-m-d H:i:s");
	}
	return $str_format;
}
?>
<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			theme:true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?=tanggal_sekarang();?>',
			editable: false,
			eventLimit: false,
			events: {
				url: 'data.php',				
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			},
			eventClick: function(calEvent, jsEvent, view) {
        alert('Event: ' + calEvent.title);


    }
		});
		
	});

</script>
<style>
	#calendar {
		max-width: 100%;
		margin: 0 auto;
	}
</style>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
    $(document).ready(function() {
        $('#model').DataTable({
        order: [[ 0, "desc" ]],
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
			modal.find('#hapus-true').attr("href","engine_schedule.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			var start 	= div.data('start');
			var end= div.data('end');
			var title 	= div.data('title');
			var stat 	= div.data('stat');

			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#start').attr("value",start);
			modal.find('#end').attr("value",end);
			modal.find('#title').attr("value",title);
			modal.find('#stat').attr("value",stat);
			

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#stat option').each(function(){
				  if ($(this).val() == stat )
				    $(this).attr("selected","selected");
			});

		});

	});

</script>

<div class="row">

               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header">Schedule Manager</h1>
                </div>
					 <div class="col-lg-8 col-lg-offset-2">
					<div class="panel panel-default">
					<div class="panel-heading">
					</div>
					<div class="panel-body">
					<div id='loading'>loading...</div>
					<div id='calendar'></div>
					</div>
					</div>
					</div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			<button class="btn btn-md pull-left" data-id='0' data-toggle="modal" data-target="#tambah-data"><span class="fa fa-plus"></span> Add NEW Entry</button> <br /><br />
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-hover" id="model">
                                    <thead align="center">
					<tr>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Title</th>
						<th>Status</th>
						<th>Setting</th>
					</tr>
				</thead>
				<tbody>
				<tr>				<?php $sql = $conn->query("SELECT * FROM jadwal"); ?>

					<?php while ( $r = $sql->fetch_assoc() ) { ?>
					<?php 

						echo "<td align=center><h5><strong>$r[tgl1]</strong></h5></td>";
						echo "<td align='center'><h5>" . $r['tgl2'] . "</h5></td>";
						echo "<td align='center'><h5>" . $r['judul'] . "</h5></td>";
						echo "<td align='center'><h5>" . $r['stat'] . "</h5></td>";?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $r['jadwal_id'] ?>"
									data-start="<?php echo $r['tgl1'] ?>"
									data-end="<?php echo $r['tgl2'] ?>"
									data-title="<?php echo $r['judul'] ?>"
									data-stat="<?php echo $r['stat'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Edit
								</a>
							<span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $r['jadwal_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Delete</a>
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

				<form id="form-data" method="post" action="engine_schedule.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="issue">Start Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="start" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value=""/>
						    </div>
							<div class="form-group">
						      <label for="issue">End Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="end" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value=""/>
						    </div>
							<div class="form-group">
						      <label for="title">Title</label>
						      <input type="text"  name="title" class="form-control" placeholder="Title">
						    </div>
						    <div class="form-group">
						      <label for="stat">STATUS</label>
						      <select name="stat" class="form-control">
						        <option value="">Select Status</option>
						        <option value="open">Open</option>
								<option value="close">Close</option>
							
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

				<form id="form-data" method="post" action="engine_schedule.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>
<div class="form-group">
						      <label for="issue">Start Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="start" id="start" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value=""/>
						    </div>
							<div class="form-group">
						      <label for="issue">End Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="end" id="end" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							<input type="hidden" id="dtp_input2" value=""/>
						    </div>
							<div class="form-group">
						      <label for="title">Title</label>
						      <input type="text"  name="title" id="title" class="form-control" placeholder="Title">
						    </div>
						    <div class="form-group">
						      <label for="stat">STATUS</label>
						      <select id="stat" name="stat" class="form-control">
						        <option value="">Select Status</option>
						        <option value="open">Open</option>
								<option value="close">Close</option>
							
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
	<br>

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
