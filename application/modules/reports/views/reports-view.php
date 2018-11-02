<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
		
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Reports</h3>
					</div>
					<form role="form" method="post" action="<?php echo base_url();?>reports/download" class="form-horizontal">
						<div class="box-body">
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Client:</label>
								<div class="col-xs-9">
									<select name="name" class="form-control select2" id="sel_client" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option disabled selected>Client Name</option>
										<?php foreach($client as $item){ ?>
											<option value="<?php echo $item->client_id; ?>"><?php echo $item->name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Brand:</label>
								<div class="col-xs-9">
								<select name="brand_name" class="form-control select2" id="sel_brand" style="width: 100%;" tabindex="-1" aria-hidden="true">
									<option disabled selected>Brand Name</option>
									<?php if(!empty($data['Brand_Name'])){ ?>
										<option value="<?php echo($data['Brand_Name'])?>" selected><?php echo($data['Brand_Name'])?></option>

									<?php } ?>
									
									
								</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill Type:</label>
								<div class="col-xs-9">
									<select class="form-control select2" name="bill_type" style="width: 100%;" tabindex="-1" aria-hidden="true" id="subactivity">
										<option disabled selected value=""></option>
										
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Billable:</label>
								<div class="col-xs-9">
									<select name="billable" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option disabled selected value=""></option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Stages:</label>
								<div class="col-xs-9">
									<select name="stages" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option disabled selected value=""></option>
										<option value="Layout">Layout</option>
										<option value="Artwork">Artwork</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Status:</label>
								<div class="col-xs-9">
									<select name="job_status" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option disabled selected value=""></option>
										<option value="Pending for billing">Pending for billing</option>
										<option value="Billed">Billed</option>
										<option value="Finished Jobs">Finished Jobs</option>
										<option value="Closed Layouts">Closed Layouts</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">From:</label>
								<div class="col-xs-9">
									<div class="input-group date" id="fromDate">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="from_date" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">To:</label>
								<div class="col-xs-9">
									<div class="input-group date" id="toDate">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input name="to_date" type="text" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary">Get Reports</button>
						</div>
					</form>
				<!-- /.box-body -->
			  </div>
			  
			</div>
			<!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<script>

	$(document).ready(function (){


		$.ajax({

					url:'<?php echo base_url();?>billtypes/getSubTypesJSON',
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
						$('#subactivity').empty();	
						$.each(data, function (i, item) {


							
							$("#subactivity").append("<option value='"+item.abbreviation_name+"'>" +item.abbreviation_name+ ' - ' + item.activity_name + "</option>");
						
							
								});
					},
					error:function(data)
					{
						alert(JSON.stringify(data));
					}



		});	





	});

	$('#sel_client').on('change',function(){
      var clientID = this.value;
	  
	   // AJAX request
     $.ajax({
       url:'<?php echo base_url();?>brief/getClientBrand',
       method: 'post',
       data: {clientID: clientID},
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

	$(function () {
		$('.select2').select2()
		$('#fromDate').datepicker({
			autoclose: true
		})
		$('#toDate').datepicker({
			autoclose: true
		})
	})
</script>