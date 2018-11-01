<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
		
		<div class="row">
			<div class="col-xs-12">
			
				<form role="form" method="post" action="<?php echo base_url()?>billtypes/savetypes" class="form-horizontal">
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
							<?php if(!empty($data['job_id'])){?>
								<input type="hidden" value="<?php echo $data['job_id']; ?>" name="job_id" />
							<?php } ?>							
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Client  Name:</label>
								<div class="col-xs-9">
									<select <?php echo( !empty($data['job_id'])? 'disabled' : '');?> class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" id="sel_client" name="client_id">
										<option disabled selected>Client Name</option>
										<?php foreach($client as $item){ ?>
											<option value="<?php echo $item->client_id; ?>" <?php echo(!empty($data['client_id']) && $data['client_id']==$item->client_id)? "selected":""?> ><?php echo $item->name; ?></option>
										<?php } ?>
									</select>
									<?php if (form_error('client_id')) echo form_error('client_id'); ?>
								</div>
							</div> -->
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Brand Name:</label>
								<div class="col-xs-9">
									<select <?php echo( !empty($data['job_id'])? 'disabled' : '');?> class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" id="sel_brand" name="brand_name">
										<option disabled selected>Brand Name</option>
										<?php
										if(!empty($data['job_id'])){
											if(!empty($data['brand_name'])){ ?>
										<option value="<?php echo($data['brand_name'])?>" selected><?php echo($data['brand_name'])?></option>
									<?php }
									}
									else
										{
											if(!empty($data['brand_name'])){ ?>
										<option value="<?php echo($data['brand_name'])?>" selected><?php echo($data['brand_name'])?></option>
									<?php	}} ?>
									
									</select>
									<?php if (form_error('brand_name')) echo form_error('brand_name'); ?>
								</div>
							</div> -->
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Brief No:</label>
								<div class="col-xs-9">
									<input <?php echo(!empty($data['job_id'])? 'disabled' : '') ?> value="<?php  echo (!empty( $briefnumber))?  $briefnumber : ''; ?>" type="text" class="form-control" id="briefNumber" disabled>
									<input value="<?php  echo (!empty($data['brief_id'])) ?  $data['brief_id'] : ''; ?>" type="hidden" name="brief_id" class="form-control" id="briefid">
								</div>
							</div> -->
							
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill Type Abbreviation:</label>
								<div class="col-xs-9">
									<input value="<?php  echo (!empty($data['job_title']))? $data['job_title'] : ''; ?>" type="text" name="bill_abbreviation" class="form-control" id="bill_abbreviation">
									<?php if (form_error('job_title')) echo form_error('job_title'); ?>
								</div>
                            </div> -->
                            <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill  Type Name:</label>
								<div class="col-xs-9">
									<input value="<?php  echo (!empty($data['job_title']))? $data['job_title'] : ''; ?>" type="text" name="bill_type" class="form-control" id="bill_type">
									<?php if (form_error('job_title')) echo form_error('job_title'); ?>
								</div>
							</div>
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Job Date:</label>
								<div class="col-xs-9">
									<div class="input-group date" id="jobDate">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="job_date" class="form-control" value="<?php echo (!empty($data['job_date']))? date("d-m-Y",strtotime($data['job_date'])) : date("d-m-Y"); ?>">
									</div>
									<?php if (form_error('job_date')) echo form_error('job_date'); ?>
								</div>
							</div> -->
							<?php if(!empty($data['job_id'])){?>
								<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Status:</label>
								<div class="col-xs-9">
									<select  name="job_status" disabled class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="Pending for billing" <?php echo (!empty($data['job_status']) && $data['job_status']=="Pending for billing")? "selected":"";?>>Pending for billing</option>
										<option value="Billed" <?php echo (!empty($data['job_status']) && $data['job_status']=="Billed")? "selected":"";?>>Billed</option>
										<option value="Finished Jobs" <?php echo (!empty($data['job_status']) && $data['job_status']=="Finished Jobs")? "selected":"";?>>Finished Jobs</option>
										<option value="Closed Layouts" <?php echo (!empty($data['job_status']) && $data['job_status']=="Closed Layouts")? "selected":"";?>>Closed Layouts</option>
									</select>
									<?php if (form_error('job_status')) echo form_error('job_status'); ?>
								</div>
							</div>
							<?php }?>
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill Type:</label>
								<div class="col-xs-9">
									<select name="bill_type" class="form-control select2" id="billType" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="AW" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="AW")? "selected":"";?>>AW - Artwork</option>
										<option value="IM" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="IM")? "selected":"";?>>IM - Images</option>
										<option value="RF" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="RF")? "selected":"";?>>RF - Retainer Fee</option>
										<option value="CF" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="CF")? "selected":"";?>>CF - Creative Fee(Project)</option>
										<option value="CR" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="CR")? "selected":"";?>>CR - Creative Layout</option>
										<option value="FI" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="FI")? "selected":"";?>>FI - Finished Job</option>
										<option value="DF" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="DF")? "selected":"";?>>DF - Digital Retainer</option>
										<option value="IT" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="IT")? "selected":"";?>>IT - Digital Media</option>
										<option value="WD" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="WD")? "selected":"";?>>WD - Digital Non-media</option>
										<option value="AV" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="AV")? "selected":"";?>>AV - Audio Visual</option>
										<option value="PN" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="PN")? "selected":"";?>>PN - Printing</option>
										<option value="FB" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="FB")? "selected":"";?>>FB - Fabrication</option>
										<option value="EV" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="EV")? "selected":"";?>>EV - Events/exhibitions</option>
										<option value="PH" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="PH")? "selected":"";?>>PH - Photography</option>
										<option value="DN" <?php echo (!empty($data['bill_type']) && $data['bill_type']=="DN")? "selected":"";?>>DN - Debit Notes</option>
									</select>
									<?php if (form_error('bill_type')) echo form_error('bill_type'); ?>
								</div>
							</div> -->
							<!-- <div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Subactivity:</label>
								<div class="col-xs-9">
									<select name="subactivity" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="subactivity">
										<option><?php echo(!empty($data['job_id'])?$data['subactivity']:'') ?></option>
									</select>
								</div>
							</div> -->
							<?php if(!empty($data['job_id'])){?>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Stages:</label>
								<div class="col-xs-9">
									<select name="stages" id="stages" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="Layout" <?php echo (!empty($data['stages']) && $data['stages']=="Layout")? "selected":"";?>>Layout</option>
										<option value="Artwork" <?php echo (!empty($data['stages']) && $data['stages']=="Artwork")? "selected":"";?>>Artwork</option>
									</select>
									<?php if (form_error('stages')) echo form_error('stages'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Billable:</label>
								<div class="col-xs-9">
									<select name="billable" id="sel_billable" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option value="Yes" <?php echo (!empty($data['billable']) && $data['billable']=="Yes")? "selected":"";?>>Yes</option>
										<option value="No" <?php echo (!empty($data['billable']) && $data['billable']=="No")? "selected":"";?>>No</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Artwork:</label>
								<div class="col-xs-9">
									<select name="artwork" id="sel_artwork" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option value="Billing Retainer" <?php echo (!empty($data['artwork']) && $data['artwork']=="Billing Retainer")? "selected":"";?>>Billing Retainer</option>
										<option value="Billing" <?php echo (!empty($data['Billing']) && $data['Billing']=="Billing")? "selected":"";?>>Billing</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill Amount:</label>
								<div class="col-xs-9">
									<input value="<?php  echo (!empty($data['bill_amount']))? $data['bill_amount'] : ''; ?>" type="text" name="bill_amount" class="form-control" id="billAmount">
								</div>
							</div>	
							<?php }?>						
							<div class="form-group  col-xs-12">
								<div class="col-xs-12">
									
								<!-- <textarea name="summernoteInput"  id="textarea" class="summernote"></textarea> -->
									<!-- <textarea id="briefText" value="" name="editor" class="editor" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php  echo (!empty($data['job_text']))? $data['job_text'] : ''; ?></textarea> -->
									<?php if (form_error('job_text')) echo form_error('job_text'); ?>
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



	//  $(document).ready(function() {
	// 	CKEDITOR.replace( 'editor' );
    //     });


$('#sel_brand').on('change',function(){
	var brandname = this.value;
	var clientID = $('#sel_client option:selected').val();
	$.ajax({
       url:'<?php echo base_url();?>job/getBriefNumber',
       method: 'post',
       data: {clientID: clientID, brandname: brandname},
       dataType: 'json',
       success: function($response){

		   console.log($response);
	       	if($response['success']=='1')
			{	
				$(".show_msg").empty();
				$("#briefTable").DataTable().clear().draw().destroy(); //clear all the content from tbody here.
				var res = JSON.parse($response['data']);

				console.log($response['data']);
				console.log($response['data']['Brief_Text']);
				
				$.each(res,function(i,$item){
					$('#briefTable tbody').append('<tr><td>'+i+'</td><td>'+ $item.briefnum +'</td><td>'+$item.Brief_Date+'</td><td>'+$item.Brief_Status+'</td><td>'+'<button type="button" class="briefSelect btn btn-default" data-brief-no="'+$item.briefnum+'" data-brief-date="'+$item.Brief_Date+'" data-brief-id="'+$item.Brief_ID+'" data-brief-text="'+$item.Brief_Text+'">Select</button>'+'</td></tr>');

				})
			}
	       	else if($response['success']=='0')
			{
				$("#briefTable").DataTable().clear().draw().destroy(); //clear all the content from tbody here.
				$(".show_msg").html('<span style="color:#ff0000;">'+$response['msg']+'</span>');       		
			}
		    $('.briefSelect').on('click', function(){
			$('#modal-default').modal('hide')

			console.log($(this).data('brief-text'));
			$('#briefNumber').val($(this).data('brief-no'))
			$('#briefDate').val($(this).data('brief-date'))
			$('#briefid').val($(this).data('brief-id'))
			//$('#briefText').val($(this).data('brief-text'))
				//editor.setData( '<p>This is editor!</p>' );
				ClassicEditor.editor.setData( '<p>Some text.</p>' );
			//ClassicEditor.instances['#briefText'].setData('HELLO');
		//	document.getElementById('#briefText').value = $(this).data('brief-text');
		//	$('#textarea').summernote('code',$(this).data('brief-text'));
                    
                                                        

		})	
		 $('#briefTable').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'	  : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})	

       }		
	});
});
$(document).ready(function(){

	var datetim ="<?php echo (!empty($data['job_date']))? date('d-m-Y',strtotime($data['job_date'])) : date('d-m-Y')?>";
	var datetim2="<?php echo (!empty($data['job_date']))? date('Y-m-d',strtotime($data['job_date'])) : date('Y-m-d')?>";
	// alert(datetim);
	var d = new Date(datetim2);
	d.setDate(d.getDate()-7);
	;
	var D=d.getDate();
	var M=d.getMonth()+1;
	var Y=d.getFullYear();
	var datetim3=D+"-"+M+"-"+Y;

	$('#jobDate').datepicker({
	inline: true,
	format: 'dd-mm-yyyy',
	changeFirstDay: false,
	startDate: datetim3,
	endDate: datetim
	});

	$('#billDate').datepicker({
		autoClose:true,
		format: 'dd-mm-yyyy',
	});

	if($('#sel_billable').val()=="Yes"){
		$('#sel_artwork').html('<option>Billing</option>');
		$('#paymentbox').css('display','block');
		
	}
	else
	{
		$('#sel_artwork').html('<option>Billing Retainer</option>');
		$('#paymentbox').css('display','none');
	}
});
$('#sel_billable').on('change',function(){

	var $billableval = this.value;
	if($billableval=="Yes")
	{
		$('#sel_artwork').html('<option>Billing</option>');
		$('#paymentbox').css('display','block');
	}
	else
	{
		$('#sel_artwork').html('<option>Billing Retainer</option>');
		$('#paymentbox').css('display','none');
	}

})

$('#stages').on('change', function() {
	if(this.value=="Layout")
	{
		$('#sel_billable').html('<option value="No" selected="">No</option>');
		$('#sel_artwork').html('<option selected="">Billing Retainer</option>');
		$('#paymentbox').css('display','block');
	}
	if(this.value=="Artwork")
	{
		$('#sel_billable').html('<option value="Yes" selected="">Yes</option><option value="No" selected="">No</option>');
		$('#sel_artwork').html('<option>Billing</option><option>Billing Retainer</option>');
		$('#paymentbox').css('display','none');
	}
})


$(function () {
	$('.select2').select2()
	
	ClassicEditor
		.create( document.querySelector( '.editor' ),{
			ckfinder: {
				uploadUrl: '<?php echo base_url()?>/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
			} 
		})
		.then( editor => {
			console.log( editor );
		} )
		.catch( error => {
			console.error( error );
		} );

	$('#sel_brand').on('change', function(){
		$('#modal-default').modal('show')
	})
	$('.briefSelect').on('click', function(){
		$('#modal-default').modal('hide')
		$('#briefNumber').val($(this).data('brief-no'))
		$('#briefDate').val($(this).data('brief-date'))
	})
	$('#billType').on('change', function() {
		var billType = this.value;
		switch (billType) { 
			case 'AW': 
				$("#subactivity").html("<option>Concept & Design</option> <option>Adaptation</option> <option>Illustration</option> <option>Image Touch-up</option> <option>Language Translation</option>")
				$('#stages').val("Artwork")
				$('#sel_billable').val("Yes")
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

$('#sel_client').on('change',function(){
      var clientID = this.value;
	  
	   // AJAX request
     $.ajax({
       url:'<?php echo base_url();?>brief/getClientBrand',
       method: 'post',
       data: {clientID: clientID, },
       dataType: 'json',
       success: function(response){
         // Remove options
         $('#sel_brand').find('option').not(':first').remove();

         // Add options
         $.each(response,function(index,data){
           $('#sel_brand').append('<option value="'+data+'">'+data+'</option>');
         });
       },
	   error:function(data)
	   {
		   alert(JSON.stringify(data));
	   }
    });
  }); 


</script>