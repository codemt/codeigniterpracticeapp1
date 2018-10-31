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
					<form action="<?php echo base_url()."roles/storeRole"; ?>" method="post" role="form" class="form-horizontal">
						<div class="box-body">
							<?php if(!empty($data['role_id'])){?>
							<input type="hidden" value="<?php echo $data['role_id']; ?>" name="role_id" />
							<?php } ?>
							<div class="row">
								<div class="form-group col-xs-12 col-sm-6">
									<label class="col-xs-3 control-label">Name:</label>
									<div class="col-xs-9">
										<input type="text" class="form-control" id="name" name="name" required value="<?php echo (!empty($data['name']))? $data['name']:''; ?>">
										<?php if (form_error('name')) echo form_error('name'); ?>
									</div>
								</div>
							</div>
							<div style="display:none"><?php print_r($data['permissions']); ?></div>
							<div class="row">
								<?php foreach ($modules as $module){ ?>
								<div class="form-group col-xs-12 col-sm-6">
									<label class="col-xs-12 col-sm-offset-1"><?php echo $module->module.":"; ?></label>
									<?php foreach ($permissions as $permission) { ?>
										<?php if($module->module ==  $permission->module) { ?>
										<div class="checkbox col-xs-9 col-sm-offset-1">
											<label>
												<input type="checkbox"  name="permissions[]" value="<?php echo $permission->permissions_id; ?>" <?php echo (!empty($data['permissions']) && in_array($permission->permissions_id, $data['permissions']))? 'checked':''; ?>> <?php echo $permission->name; ?>  
											</label>
										</div>
										<?php } ?>
									<?php } ?>
								</div>
								<?php } ?>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a href="<?php echo base_url()?>roles/" type="cancel" class="btn btn-default">Cancel</a>
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
	})
</script>