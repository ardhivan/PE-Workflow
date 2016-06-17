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
            },
			{
                targets: [ 10 ],
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
			modal.find('#hapus-true').attr("href","engine_dci_pur.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');			
			var type 	= div.data('type');			
			var dcnno 	= div.data('dcnno');
			var partno 	= div.data('partno');
			var partname = div.data('partname');
			var supplier = div.data('supplier');
			var title 	= div.data('title');
			var effect  = div.data('effect');		
			var model 	= div.data('model');
			var issue 	= div.data('issue');
			var pur 	= div.data('pur');
			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			
			modal.find('#type').attr("value",type);
			
			modal.find('#dcnno').attr("value",dcnno);
			modal.find('#partno').attr("value",partno);
			modal.find('#partname').attr("value",partname);
			modal.find('#supplier').attr("value",supplier);
			modal.find('#title').attr("value",title);
			
			modal.find('#effect').attr("value",effect);

			modal.find('#model').attr("value",model);
			
			modal.find('#issue').attr("value",issue);
			modal.find('#pur').attr("value",pur);
			// Membuat combobox terpilih berdasarkan value yg tersimpan saat pengeditan
			modal.find('#type option').each(function(){
				  if ($(this).val() == type )
				    $(this).attr("selected","selected");
			});
			// Membuat combobox terpilih berdasarkan value yg tersimpan saat pengeditan
			modal.find('#pur option').each(function(){
				  if ($(this).val() == pur )
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
                    <h1 class="page-header">DCN/DCI OPEN LIST</h1>
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
						<th>Receive</th> 	<!-- 0 -->
						<th>DCN Type</th>	<!-- 1 -->
						<th>Effective</th>	<!-- 2 -->
						<th>DCN No</th>		<!-- 3 -->
						<th>Part No</th>	<!-- 4 -->
						<th>Part name</th>	<!-- 5 -->
						<th>DCN Title</th>	<!-- 6 -->
						<th>DCN SPEC</th>	<!-- 7 -->
						<th>Refno</th>		<!-- 8 -->
						<th>Model</th>		<!-- 9 -->
						<th>DCI STAT</th>	<!-- 10 -->
						<th>Setting</th>
					</tr>
				</thead>
				<tbody>
				<?php $sql = $conn->query("SELECT * FROM dcn where pur_stat='OPEN' OR pur_stat='CLOSE' ");
				while ( $row = $sql->fetch_assoc() ) {	
				$catpur=$row['pur_stat'];
	switch ($catpur) {
    case "OPEN":
        $classpur='danger';
        break;
    case "CLOSE":
        $classpur='success';
        break;
	case "NO NEED":
        $classpur='success';
        break;	
}
	 ?>

					<?php 
						echo "<tr class='$classpur'>";
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
						echo "<td align='center'>" . $row['dcn_partno'] . "</td>";
						echo "<td>";
						if (strlen("$row[dcn_partname]") >= 30){
							echo substr("$row[dcn_partname]",0,30);
							echo "...</td>";
						}else{
							echo substr("$row[dcn_partname]",0,30);
							echo "</td>";}
						
						echo "<td align='center'>" . $row['dcn_title'] . "</td>";
						echo "<td align='center'>" . $row['dcn_spec'] . "</td>";		
						echo "<td align='center'>" . $row['dcn_nowf'] . "</td>";
						echo "<td align=center>";
						if (strlen("$row[dcn_model]") >= 20){
							echo substr("$row[dcn_model]",0,20);
							echo "...</td>";
						}else{
							echo substr("$row[dcn_model]",0,20);
							echo "</td>";}
						echo "<td align='center'>" . $row['pur_stat'] . "</td>";	
						
						
						?>
								<td align="right">

								<a  class="btn btn-xs" href="javascript:;"
									data-id="<?php echo $row['dcn_id'] ?>"						
									data-type="<?php echo $row['dcn_type'] ?>"							
									data-dcnno="<?php echo $row['dcn_no'] ?>"
									data-partno="<?php echo $row['dcn_partno'] ?>"
									data-partname="<?php echo $row['dcn_partname'] ?>"
									data-supplier="<?php echo $row['dcn_supplier'] ?>"
									data-title="<?php echo $row['dcn_title'] ?>"	
									data-effect="<?php echo $row['dcn_effect'] ?>"					
									data-model="<?php echo $row['dcn_model'] ?>"
									data-pur="<?php echo $row['pur_stat'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Verify DCN
								</a>
							<!-- <span class="fa fa-ellipsis-v"></span>
								<a class="btn btn-xs" href="javascript:;" data-id="<?php echo $row['dcn_no'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-ban"></i> Hold</a>-->
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

				<form id="form-data" method="post" action="engine_dci_pur.php?p=update">

					<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Verify DCI</h4>
					</div>
					<div class="modal-body">
						  <fieldset>
						  
							<div class="form-group">
						      <label for="dcnno">DCN Type</label>
						      <input type="text" name="type" id="type"  class="form-control" readonly>
						    </div>
							<div class="form-group">
						      <label for="dcnno">DCN No</label>
						      <input type="text" name="dcnno" id="dcnno"  class="form-control" placeholder="DCN No" readonly>
						    </div>
							<div class="form-group">
						      <label for="title">DCN Title</label>
						      <input type="text" name="title" id="title"  class="form-control" placeholder="DCN Title" readonly>
						    </div>
							<div class="form-group">
						      <label for="partno">Part No</label>
						      <input type="text" name="partno" id="partno"  class="form-control" placeholder="Part No" readonly>
						    </div>
							<div class="form-group">
						      <label for="partname">Part Name</label>
						      <input type="text" name="partname" id="partname"  class="form-control" placeholder="Part Name" readonly>
						    </div>
							<div class="form-group">
						      <label for="effect">Effective</label>
						      <input type="text" name="effect" id="effect" class="form-control" placeholder="Effective" readonly>
						    </div>
							<div class="form-group">
						      <label for="model">Model</label>
						      <input type="text" name="model" id="model" class="form-control" placeholder="Model" readonly>
						    </div>
							
							<hr>
						 <strong>DCI STATUS CONFIRMATON</strong>
						 <div class="form-group"><br/>
						      <label for="comment">Confirmation</label>
						      <textarea class="form-control" name="comment" placeholder="Comments goes here, use <br/> to make a new line break" rows="5" ></textarea> 
						    </div>
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">DCI Reply Attachment</label>
							  <input type="file" accept="*" name="file[]"/>
						    </div>
						  <div class="form-group"><br>
						      <label for="dci_stat">DCN STATUS</label>
						      <select name="dci_stat" id="pur" class="form-control">
						        <option value="">Select DCN STATUS</option>
								<option value="NO NEED">NO NEED</option>
						        <option value="CLOSE">CLOSE</option>
								<option value="OPEN">OPEN</option>
						      </select>
						  </div>

						  
						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> Submit</button>
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
