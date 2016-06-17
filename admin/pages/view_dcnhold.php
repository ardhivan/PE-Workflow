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
                targets: [ 9 ],
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
			modal.find('#hapus-true').attr("href","engine_partspec.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
			var id 		= div.data('id');
			var dl 		= div.data('dl');
			var wfno 	= div.data('wfno');
			var type 	= div.data('type');
			var partno 	= div.data('partno');
			var partname = div.data('partname');
			var supplier = div.data('supplier');
			var docno 	= div.data('docno');
			var title 	= div.data('title');
			var spec = div.data('spec');
			var effect = div.data('effect');
			var rev 	= div.data('rev');
			var model 	= div.data('model');
			var section 	= div.data('section');
			var issue 	= div.data('issue');
			var stat 	= div.data('stat');
			var modal 	= $(this)

			// Isi nilai pada field
			modal.find('#id').attr("value",id);
			modal.find('#dl').attr("value",dl);
			modal.find('#wfno').attr("value",wfno);
			modal.find('#type').attr("value",type);
			
			modal.find('#partno').attr("value",partno);
			modal.find('#partname').attr("value",partname);
			modal.find('#supplier').attr("value",supplier);
			modal.find('#docno').attr("value",docno);
			modal.find('#title').attr("value",title);
			$("#spec").html(spec);
			modal.find('#spec').attr("value",spec);
			modal.find('#effect').attr("value",effect);
			modal.find('#rev').attr("value",rev);
			modal.find('#model').attr("value",model);
			modal.find('#section').attr("value",section);
			modal.find('#issue').attr("value",issue);
			modal.find('#stat').attr("value",stat);
			// Membuat combobox terpilih berdasarkan value yg tersimpan saat pengeditan
			modal.find('#type option').each(function(){
				  if ($(this).val() == type )
				    $(this).attr("selected","selected");
			});
			// Membuat combobox terpilih berdasarkan value yg tersimpan saat pengeditan
			modal.find('#stat option').each(function(){
				  if ($(this).val() == stat )
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
                    <h1 class="page-header">DCN onHOLD</h1>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-hover" id="dcn">
                                    <thead align="center">
					<tr>
						<th>Receive</th> 	
						<th>DCN Type</th>	
						<th>Section</th>	
						<th>Effective</th>	
						<th>DCN No</th>		
						<th>Part name</th>	
						<th>DCN Title</th>
						<th>DCN SPEC</th>
						<th>DCN type</th>
						<th>Stat</th>
						<th>Model</th>
						
						
					</tr>
				</thead>
				<tbody>
							<?php $sql = $conn->query("SELECT * FROM dcn WHERE  `dcn_stat` LIKE 'HOLD'"); ?>

					<?php while ( $row = $sql->fetch_assoc() ) { ?>
					
				<?php
					$cat=$row['dcn_stat'];
	switch ($cat) {
    case "OPEN":
        $cat='danger';
        break;
    case "CLOSE":
        $cat='success';
        break;
	case "HOLD":
        $cat='warning';
        break;

	}		
					
					echo "<tr class='$cat'>";
						echo "<td align='center'>" . $row['dcn_dl'] . "</td>"; 							
						echo "<td align='center'>" . $row['dcn_type'] . "</td>";						
						echo "<td align='center'>" . $row['dcn_section'] . "</td>";						
						echo "<td align='center'>" . $row['dcn_effect'] . "</td>";						
						echo "<td align='center'>" . $row['dcn_no'] . "</td>";							
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
						echo "<td align='center'>" . $row['dcn_stat'] . "</td>";
						echo "<td align=center><a href=?page=detail_dcn&id=$row[dcn_id]><strong>";		
				
						if (strlen("$row[dcn_model]") >= 20){
							echo substr("$row[dcn_model]",0,20);
							echo "...</strong></a></td>";
						}else{
							echo substr("$row[dcn_model]",0,20);
							echo "</strong></a></td>";}
						
						
						?>
								
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

				<form id="form-data" method="post" action="engine_dcn.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">New DCN</h4>
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
						      <label for="type">Doc Type</label>
						      <select name="type" class="form-control">
						        <option value="">Select Doc Type</option>
						        <option value="DCI">DCI</option>
								<option value="DCNS">DCNS</option>
								<option value="DCNSZ">DCNSZ</option>
								<option value="PWBDCI">PWBDCI</option>
						      </select>
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
						      <label for="supplier">Supplier</label>
						      <input type="text" name="supplier"  class="form-control" placeholder="Supplier">
						    </div>
							<div class="form-group">
						      <label for="docno">DCN No</label>
						      <input type="text" name="docno"  class="form-control" placeholder="DCN No">
						    </div>
							<div class="form-group">
						      <label for="title">DCN Title</label>
						      <input type="text" name="title"  class="form-control" placeholder="DCN title">
						    </div>
							
							<div class="form-group">
						      <label for="spec">Comment</label>
						      <textarea class="form-control" name="spec" placeholder="Comment" rows="5" ></textarea> 
						    </div>
							<div class="form-group">
						      <label for="effect">Effective</label>
						      <input type="text" name="effect"  class="form-control" placeholder="Effective">
						    </div>
							<div class="form-group">
						      <label for="rev">Revision</label>
						      <input type="text" name="rev" class="form-control" placeholder="Revision">
						    </div>
							<div class="form-group">
						      <label for="model">Model</label>
						      <input type="text" name="model" class="form-control" placeholder="Model">
						    </div>
							<div class="form-group">
						      <label for="section">Section</label>
						      <input type="text" name="section" class="form-control" placeholder="Section">
						    </div>
							<div class="form-group">
						      <label for="issue">Issue Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="issue" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
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

				<form id="form-data" method="post" action="engine_dcn.php?p=update">

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
						      <input type="text" id="dl" name="dl" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							</div>
							<div class="form-group">
						      <label for="wfno">Workflow Number</label>
						      <input type="text" name="wfno" id="wfno" class="form-control" placeholder="Workflow Number">
						    </div>
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
						      <label for="partno">Part Number</label>
						      <input type="text" name="partno" id="partno" class="form-control" placeholder="Part Number">
						    </div>
							<div class="form-group">
						      <label for="partname">Part Name</label>
						      <input type="text" name="partname" id="partname"  class="form-control" placeholder="Part Name">
						    </div>
							<div class="form-group">
						      <label for="supplier">Supplier</label>
						      <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Supplier">
						    </div>
							<div class="form-group">
						      <label for="docno">DCN No</label>
						      <input type="text" name="docno" id="docno"  class="form-control" placeholder="DCN No">
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
						      <label for="rev">Revision</label>
						      <input type="text" name="rev" id="rev" class="form-control" placeholder="Revision">
						    </div>
							<div class="form-group">
						      <label for="model">Model</label>
						      <input type="text" name="model" id="model" class="form-control" placeholder="Model">
						    </div>
							<div class="form-group">
						      <label for="section">Section</label>
						      <input type="text" name="section" id="section" class="form-control" placeholder="Section">
						    </div>
							<div class="form-group">
						      <label for="issue">Issue Date</label>
							  <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						      <input type="text" name="issue" id="issue" class="form-control" placeholder="YYYY-MM-DD">
							  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
							</div>
							<div class="form-group">
						      <label for="type">DCN Stat</label>
						      <select name="stat" id="stat" class="form-control">
						        <option value="">Select DCN stat</option>
						        <option value="OPEN">OPEN</option>
								<option value="CLOSE">CLOSE</option>
						      </select>
						    </div>
						Ignore if there is no file changes
							<div class="form-group" style="width:80%;margin:0 auto;border-radius:5px;background:#eee;padding:10px">
						      <label for="file">File Attachment</label>
							  <input type="file" accept="*" name="file[]" />
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
