<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
		
		<div class="row">
			<div class="col-xs-12">
			
				<form role="form" method="post" action="<?php echo base_url()?>billtypes/saveActivity" class="form-horizontal">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title job-title"><?php echo( !empty($data['job_id'])? 'Job No: '.$data['bill_type']."/" .str_pad($data['job_no'],5, "0", STR_PAD_LEFT)."/".$data['year'] :  $title );  ?></h3>
							<?php if(!empty($data['job_id'])){?>
								<style>
									.box-header .job-title{
										text-align: center;
										display: block;
										font-weight: 600;
									}
								</style>
							<?php } ?>
						</div>
						<div class="box-body">

								<div class="form-group col-xs-12 col-sm-6">
										<label class="col-xs-3 control-label">Bill Type  Name:</label>
										<div class="col-xs-9">
											<select name="bill_type_id" id="type_id" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true"> 
													
											</select>
											<?php if (form_error('client_id')) echo form_error('client_id'); ?>
										</div>
								</div>
							<div class="form-group col-xs-12 col-sm-6">
									<label class="col-xs-3 control-label">Bill Type  Abbreviation:</label>
									<div class="col-xs-9">
										<select name="abbreviation_name" id="abbreviation_id" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true"> 
												
										</select>
										<?php if (form_error('client_id')) echo form_error('client_id'); ?>
									</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label"> Sub Activity Name:</label>
								<div class="col-xs-9">
									<input value="<?php  echo (!empty($data['job_title']))? $data['job_title'] : ''; ?>" type="text" name="activity_name" class="form-control" id="activity_name">
									<?php if (form_error('job_title')) echo form_error('job_title'); ?>
								</div>
                            </div>



						</div>
						<!-- /.box-body -->

					</div>
					<?php if(!empty($data['job_id'])){?>
					<?php if(in_array('job_payment_info', $permissions)){ ?>
					<div id="paymentbox" class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Billing Information</h3>
						</div>
						<div class="box-body">
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill No:</label>
								<div class="col-xs-9">
									<input value="<?php  echo (!empty($data['bill_no']))? $data['bill_no'] : ''; ?>" type="text" name="bill_no" class="form-control" id="billNo">
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill Date:</label>
								<div class="col-xs-9">
									<div class="input-group date" id="billDate">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input value="<?php  echo (!empty($data['bill_date']))? date("d-m-Y",strtotime($data['bill_date'])) : ''; ?>" type="text" name="bill_date" class="form-control">
									</div>
								</div>
							</div>
						</div>
					</div> 
					<?php } ?>
					<?php }?>

					<div class="box">
						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a class="btn btn-default" type="cancel" href="<?php echo base_url()?>job">Cancel</a>
						</div>
					</div>
				</form>
			</div>
			<!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade in" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Briefs List</h4>
				<div class="show_msg"></div>
			</div>
			<div class="modal-body">
				<table id="briefTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Brief No.</th>
							<th>Brief Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
		
		

<script>



$(function () {

	$('.select2').select2()


});

	//  $(document).ready(function() {
	// 	CKEDITOR.replace( 'editor' );
    //     });

$(document).ready(function(){



$.ajax({
				url:'<?php echo base_url();?>billtypes/getBillTypesJSON',
				method: 'get',
				// data: {clientID: clientID, },
				// dataType: 'json',
				success: function(response){

					console.log(response);

					var data = JSON.parse(response);
					//console.log(JSON.stringify(response));
					// Remove options
					//$('#sel_brand').find('option').not(':first').remove();

					// Add options
					$.each(data, function (i, item) {
    					$("#type_id").append("<option value='"+item.id+"'>" + item.bill_type + "</option>");
						
   							 });
				},
				error:function(data)
				{
					alert(JSON.stringify(data));
				}
    });

	
	if($('#type_id').val('Creative')){



		$.ajax({
				url:'<?php echo base_url();?>billtypes/getAbbreviationsJSON',
				method: 'get',
				// data: {clientID: clientID, },
				// dataType: 'json',
				success: function(response){

					console.log(response);

					var data = JSON.parse(response);
					//console.log(JSON.stringify(response));
					// Remove options
					//$('#sel_brand').find('option').not(':first').remove();

					// Add options
					$.each(data, function (i, item) {
						$('#abbreviation_id').append("<option value='"+item.abbreviation_name+"'>" + item.abbreviation_name + "</option>");
   							 });
				},
				error:function(data)
				{
					alert(JSON.stringify(data));
				}
    });




	}










	$('#type_id').on('change', function() {
		var billType = this.value;
		switch (billType) { 
			case 'Creative': 
				$('#abbreviation_id').append("<option value='AW'>AW</option>");
				break
			case 'CF': 
				$("#subactivity").html("<option>Finished Job</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break
			case 'RF': 
				$("#subactivity").html("<option>Project Fee</option>")
				break
			case 'DF': 
				$("#subactivity").html("<option>Digital Retainer Fee</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'IT': 
				$("#subactivity").html("<option>Digital Media</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'WD': 
				$("#subactivity").html("<option>Lead Generation</option> <option>E-commerce Management</option> <option>3-d</option> <option>Animation</option> <option>Virtual Reality</option> <option>Influencer</option> <option>Website</option> <option>Seo</option> <option>Sem</option> <option>Smm</option> <option>Orm</option> <option>Smo</option> <option>Maintenance</option> <option>Html</option> <option>Dtp & Mobile</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'AV': 
				$("#subactivity").html("<option>Tvc</option> <option>Film Production</option> <option>Radio Spot</option> <option>Beta Transfer</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'FB': 
				$("#subactivity").html("<option>Fabrication</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'EV': 
				$("#subactivity").html("<option>Events</option> <option>Exhibition</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'IM': 
				$("#subactivity").html("<option>Image Purchase</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'DN': 
				$("#subactivity").html("<option>Recovery Of Expenses</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break
			case 'FI': 
				$("#subactivity").html("<option>Finished Job</option>")
				break
			case 'CR': 
				$("#subactivity").html("<option>Creative Layout</option>")
				break	
			case 'PN': 
				$("#subactivity").html("<option>Printing</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break	
			case 'PH': 
				$("#subactivity").html("<option>Photography</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
				break
			default:
				$("#subactivity").html("<option></option>")
		}
	})

})







</script>