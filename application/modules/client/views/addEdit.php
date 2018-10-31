<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content container-fluid">
		
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Add Client</h3>
					</div>
					<form role="form" class="form-horizontal" method="post" action="<?php echo base_url()?>client/store/">
					
						<div class="box-body">
							<?php if(!empty($data['client_id'])){?>
							<input type="hidden" value="<?php echo $data['client_id']; ?>" name="client_id" />
							<?php } ?>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">Client Name:</label>
								<div class="col-xs-10">
									<input type="text" name="name" class="form-control" id="clientName" placeholder="Client Name" value="<?php echo (!empty($data['name'])) ? $data['name']: ''; ?>">
									<?php if (form_error('name')) echo form_error('name'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">Address:</label>
								<div class="col-xs-10">
									<textarea class="form-control" name="address" rows="3" id="address" placeholder="Address" value="<?php echo (!empty($data['address'])) ? $data['address']: ''; ?>"><?php echo (!empty($data['address'])) ? $data['address']: ''; ?></textarea>
						        <?php if (form_error('address')) echo form_error('address'); ?>
								</div>
							</div>
					        <div class="form-group col-xs-12 brand">
								<label class=" col-md-2 control-label">Brand: </label>
								<div class="col-xs-10">
									<?php 
									if(!empty($data['brand_name'])){
										$brandName = explode(",",$data['brand_name']);
										foreach ($brandName as $brand) { ?>
											<div class="col-md-7 brand_name">
												<input autocomplete="off" class="form-control" id="brand_name" name="brand_name[]" type="text" value="<?php echo $brand ?>" readonly/>
											</div>
										<?php } ?>
									<?php } else{?>
										<div class="col-md-7 brand_name">
											<input autocomplete="off" class="form-control" id="brand_name" name="brand_name[]" type="text" placeholder="Brand Name"/>
										</div>
									<?php } ?>
									<button id="add-more" class="col-md-1 btn add-more" type="button">+</button>
									<div class="col-md-7">
										<?php if (form_error('brand_name[]')) echo form_error('brand_name[]'); ?>
									</div>
								</div>
					        </div>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">Status:</label>
								<div class="col-xs-10">
									<select class="form-control" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option value="Active" selected <?php echo (!empty($data['status']) && $data['status']=="Active")? "selected":"";?>>Active</option>
										<option value="Inactive" <?php echo (!empty($data['status']) && $data['status'] == "Inactive")? "selected":"";?>>Inactive</option>
									</select>
									<?php if (form_error('status')) echo form_error('status'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">State Code:</label>
								<div class="col-xs-10">
									<input type="text" name="state_code" class="form-control" id="stateCode" placeholder="State Code" value="<?php echo (!empty($data['state_code'])) ? $data['state_code']: ''; ?>">
									<?php if (form_error('state_code')) echo form_error('state_code'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">PAN:</label>
								<div class="col-xs-10">
									<input type="text" name="pan_no" class="form-control" id="panNo" placeholder="PAN" value="<?php echo (!empty($data['pan_no'])) ? $data['pan_no']: ''; ?>">
									<?php if (form_error('pan_no')) echo form_error('pan_no'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">TAN:</label>
								<div class="col-xs-10">
									<input type="text" name="tan_no" class="form-control" id="tanNo" placeholder="TAN" value="<?php echo (!empty($data['tan_no'])) ? $data['tan_no']: ''; ?>">
									<?php if (form_error('tan_no')) echo form_error('tan_no'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<label class="col-xs-2 control-label">GSTIN:</label>
								<div class="col-xs-10">
									<input type="text" name="gstin" class="form-control" id="gstin" placeholder="GSTIN" value="<?php echo (!empty($data['gstin'])) ? $data['gstin']: ''; ?>">
									<?php if (form_error('gstin')) echo form_error('gstin'); ?>
								</div>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="<?php echo base_url()?>client/" type="cancel" class="btn btn-default">Cancel</a>
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
	$('.select2').select2({
		tags: true
	});
	i=0;
	$(".add-more").click(function(e){
		$(".brand_name:last").after('<button class="col-md-1 btn remove-me" type="button">-</button>');
		$(".remove-me:last").after('<div class="col-md-7 brand_name"><input autocomplete="off" class="form-control" id="brand_name" name="brand_name[]" type="text" placeholder="Brand Name"/></div>');
		$('.remove-me').click(function(e){
			$(this).prev('.brand_name:last').remove();
			$(this).remove();
		});
		i++;
		<?php if(!empty($data['client_id'])){?>
		if(i==1){ $(".remove-me:last").remove();}
		<?php } ?>
	});
	$('#stateCode').on('input',function(e){
		$('#gstin').val(this.value + $('#panNo').val()); 
	});
	$('#panNo').on('input',function(e){
		$('#gstin').val($('#stateCode').val() + this.value); 
	});
</script>
<style>
	.brand .col-md-7 {
	    padding-left: 0;
	    margin-bottom: 5px;
	}
</style>