<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title"><?php echo $title; ?></h3>
					</div>
					<form action="<?php echo base_url()."user/storeUser"; ?>" method="post" role="form" class="form-horizontal">
						<div class="box-body">
							<?php if(!empty($data['id'])){?>
							<input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
							<?php } ?>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Name:</label>
								<div class="col-xs-9">
									<input type="text" class="form-control" id="name" name="name" required value="<?php echo (!empty($data['name']))? $data['name']:''; ?>">
									<?php if (form_error('name')) echo form_error('name'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">User Name:</label>
								<div class="col-xs-9">
									<input type="email" class="form-control" id="username" name="username" required value="<?php echo (!empty($data['username']))? $data['username']:''; ?>" <?php echo ($edit)? "readonly" :""; ?>>
									<?php if (form_error('username')) echo form_error('username'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Role:</label>
								<div class="col-xs-9">
									<select class="form-control" name="role" id="role" style="width: 100%;" required>
										<option value="" disabled selected>Select Role</option>
										<?php foreach ($roles as $item){ ?>
										<option value="<?php echo $item->role_id; ?>" <?php echo (!empty($data['role']) && $item->role_id == $data['role'])? "selected":"";?>><?php echo $item->name; ?></option>
										<?php } ?>
									</select>
									<?php if (form_error('role[]')) echo form_error('role[]'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Status:</label>
								<div class="col-xs-9">
									<select class="form-control" name="status" id="status" style="width: 100%;" required>
										<option value="Active" <?php echo (!empty($data['status']) && $data['status']=="Active")? "selected":"";?>>Active</option>
										<option value="Inactive" <?php echo (!empty($data['status']) && $data['status']=="Inactive")? "selected":"";?>>Inactive</option>
									</select>
									<?php if (form_error('status')) echo form_error('status'); ?>
								</div>
							</div>
							<div class="form-group col-xs-12">
								<label class="col-xs-3 col-sm-1 control-label">Client:</label>
								<div class="col-xs-9 col-sm-11">
									<select class="form-control select2" name="clients[]" id="clients" multiple style="width: 100%;">
										<?php foreach ($clients as $item){ ?>
										<option value="<?php echo $item->client_id; ?>" <?php echo (!empty($data['clients']) && in_array($item->client_id, $data['clients']))? "selected":"";?>><?php echo $item->name; ?></option>
										<?php } ?>
									
									</select>
									<?php if (form_error('clients[]')) echo form_error('clients[]'); ?>
								</div>
							</div>
							<?php if($edit){ ?>
							<div class="form-group col-xs-12">
								<div class="checkbox col-xs-offset-1 ">
									<label>
										<input type="checkbox" name="resetPassword" id="resetPassword"> Reset Password 
									</label>
								</div>
							</div>
							<?php } ?>
						</div>
						<!-- /.box-body -->

						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="<?php echo base_url()?>user/" type="cancel" class="btn btn-default">Cancel</a>
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
	$(function () {
		$('.select2').select2()
		$('#role').on('change',function(){
			if(this.value == '1')
			{
				$('#clients > option').prop("selected",true);
				$('#clients').trigger('change');
			}
		}); 
	})
</script>