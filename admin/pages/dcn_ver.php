    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
    $(document).ready(function() {
        $('#dcn').DataTable({
		scrollX: true,
        order: [[ 0, "desc" ]],
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
		columnDefs: [ 
            {
                targets: [ 1 ],
				visible: false
            },
			{
                targets: [ 2 ],
				visible: false
            },
			{
                targets: [ 5 ],
                visible: false
            },
			{
                targets: [ 6 ],
                visible: false
            },
			{
                targets: [ 7 ],
                visible: false
            },
			{
                targets: [ 8 ],
                visible: false
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
			modal.find('#hapus-true').attr("href","engine_dcnver.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			
			var type 	= div.data('type');
			
			var dcnno 	= div.data('dcnno');
			var title 	= div.data('title');
			var spec 	= div.data('spec');
			var effect  = div.data('effect');
			
			var model 	= div.data('model');
			
			var issue 	= div.data('issue');
			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			
			modal.find('#type').attr("value",type);
			
			modal.find('#dcnno').attr("value",dcnno);
			modal.find('#title').attr("value",title);
			$("#spec").html(spec);
			modal.find('#spec').attr("value",spec);
			modal.find('#effect').attr("value",effect);

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

<!--<script>
tinymce.init({
menubar: false,
selector:'textarea',
plugins: "textcolor",
toolbar: "style	select |  undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright print",

});</script> -->


<div class="row">
               <div class="row">
			   <div class="col-lg-12">
                    <h1 class="page-header">DCN & WI Verification</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <!--  <div class="panel-heading">
			<button class="btn btn-md pull-left" data-id='0' data-toggle="modal" data-target="#tambah-data"><span class="fa fa-plus"></span> New DCN</button> <br /><br />
                        </div>-->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-hover" id="dcn">
                                    <thead align="center">
					<tr>
						<th>Receive</th> 	
						<th>DCN Type</th>	
	
						<th>Effective</th>	
						<th>DCN No</th>		
						<th>Part name</th>	
						<th>DCN Title</th>
						<th>DCN SPEC</th>
						<th>DCN type</th>
						<th>Refno</th>
						<th>Model</th>
						<th>Verification Stats</th>
						
						<th>Setting</th>
					</tr>
				</thead>
				<tbody>
				<?php $sql = $conn->query("SELECT * FROM dcn");
				while ( $row = $sql->fetch_assoc() ) {	
				
	$cat=$row['dcn_verifstat'];
	switch ($cat) {
    case "Verified":
        $cat='info';
        break;
    case "Unverified":
        $cat='warning';
        break;

	} ?>
								

					 
					
					<?php 
						echo "<tr class='$cat'>";
						echo "<td align='center'>" . $row['dcn_dl'] . "</td>"; 							
						echo "<td align='center'>" . $row['dcn_type'] . "</td>";											
						echo "<td align='center'>" . $row['dcn_effect'] . "</td>";						
						
						echo "<td align=center><a href=?page=detail_dcn&id=$row[dcn_id]><strong>";
						if (strlen("$row[dcn_no]") >= 20){
							echo substr("$row[dcn_no]",0,20);
							echo "...</strong></a></td>";
						}else{
							echo substr("$row[dcn_no]",0,20);
							echo "</strong></a></td>";}						
						echo "<td>";
						if (strlen("$row[dcn_partname]") >= 30){
							echo substr("$row[dcn_partname]",0,30);
							echo "...</td>";
						}else{
							echo substr("$row[dcn_partname]",0,30);
							echo "</td>";}
						
						echo "<td align='center'>" . $row['dcn_title'] . "</td>";
						echo "<td align='center'>" . $row['dcn_spec'] . "</td>";	
						echo "<td align='center'>" . $row['dcn_type'] . "</td>";	
						echo "<td align='center'>" . $row['dcn_nowf'] . "</td>";
						echo "<td align=center>";
						if (strlen("$row[dcn_model]") >= 20){
							echo substr("$row[dcn_model]",0,20);
							echo "...</td>";
						}else{
							echo substr("$row[dcn_model]",0,20);
							echo "</td>";}
						echo "<td align='center'>" . $row['dcn_verifstat'] . "</td>";	
						
						
						?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $row['dcn_id'] ?>"
								
									data-type="<?php echo $row['dcn_type'] ?>"
							
									data-dcnno="<?php echo $row['dcn_no'] ?>"
									data-title="<?php echo $row['dcn_title'] ?>"	
									data-spec="<?php echo $row['dcn_spec'] ?>"
									data-effect="<?php echo $row['dcn_effect'] ?>"
					
									data-model="<?php echo $row['dcn_model'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Verify with WI
								</a>
							<span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $row['dcn_no'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-ban"></i> Hold</a>
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

	<!-- Modal edit data -->
	<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="engine_dcnver.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>
					<div class="modal-body">
						  <fieldset>
						  <div class="form-group">
						      <label for="type">Doc Type</label>
						      <select name="type" id="type" class="form-control">
						        <option value="">Select Doc Type</option>
						        <option value="DCI">DCI</option>
								<option value="DCNS">DCNS</option>
								<option value="DCNSZ">DCNSZ</option>
								<option value="PWBDCI">PWBDCI</option>
						      </select>
						    </div>
							<div class="form-group">
						      <label for="dcnno">DCN No</label>
						      <input type="text" name="dcnno" id="dcnno"  class="form-control" placeholder="DCN No">
						    </div>
							<div class="form-group">
						      <label for="title">DCN Title</label>
						      <input type="text" name="title" id="title"  class="form-control" placeholder="DCN Title">
						    </div>
							
							<div class="form-group">
						      <label for="spec">Comment</label>
						      <textarea class="form-control" name="spec" id="spec" placeholder="Comment" rows="5" > </textarea> 
						    </div>
							<div class="form-group">
						      <label for="effect">Effective</label>
						      <input type="text" name="effect" id="effect" class="form-control" placeholder="Effective">
						    </div>
							<div class="form-group">
						      <label for="model">Model</label>
						      <input type="text" name="model" id="model" class="form-control" placeholder="Model">
						    </div>
							<br>
						 <strong>ADD WI STATUS</strong>
						  <div class="form-group"><br>
						      <label for="wi_stat">WI Status</label>
						      <select name="wi_stat" class="form-control">
						        <option value="">Select WI Status</option>
						        <option value="CLOSE">NO NEED/ CLOSE</option>
								<option value="OPEN">OPEN</option>
						      </select>
						  </div>
						 <div class="form-group">
						      <label for="wi_stage">Production Stage</label>
						      <select name="wi_stage" class="form-control">
						        <option value="">Select Stage</option>						        
						        <option value="TP">TP</option>
								<option value="MP">MP</option>
						      </select>
							</div>
						  <div class="form-group">
						      <label for="wi_section">Section</label>
						      <input type="wi_section" name="wi_section" class="form-control" placeholder="Section">
						    </div>
						  <div class="form-group">
						      <label for="wi_no">WI Number</label>
						      <input type="text" name="wi_no" class="form-control" placeholder="WI Number" value="-">
						    </div>
							<div class="form-group">
						      <label for="wi_title">Title</label>
						      <input type="wi_title" name="wi_title" class="form-control" placeholder="WI Title">
						    </div>
							<div class="form-group">
						      <label for="wi_pic">WI PIC</label>
						      <input type="wi_pic" name="wi_pic" class="form-control" placeholder="WI PIC">
						    </div>
						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> Verify</button>
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
