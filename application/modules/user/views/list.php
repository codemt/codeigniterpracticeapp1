<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
    	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h1 class="box-title">User</h1>
						<div class="box-tools pull-right">
							<?php if(in_array('user_add', $permissions)){ ?>
							<a class="btn btn-block btn-primary" href="<?php echo base_url()?>user/addEdit">Add User</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<table id="userTable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Name</th>
									<th>User Name</th>
									<th>Role</th>
									<th>Status</th>
									<?php if(in_array('user_add', $permissions)){ ?>
									<th>Actions</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach ($users as $user){
								?>
								<tr>
									
									<td><?php echo $i ?></td>
									<td><?php echo $user->name; ?></td>
									<td><?php echo $user->username; ?></td>
									<td><?php echo $user->role; ?></td>
									<td><?php echo $user->status; ?></td>
									<?php if(in_array('user_add', $permissions)){ ?>
									<td>
										<a href="<?php echo base_url()?>user/addEdit/<?php echo $user->id; ?>"><i class="fa fa-pencil"></i></a>
 										<!-- <a href="<?php echo base_url()?>user/delete/<?php echo $user->id; ?>"><i class="fa fa-trash"></i> -->
									</td>
									<?php } ?>
								</tr>
								<?php 
								$i++;
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
			  
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
				<h4 class="modal-title">Message</h4>
			</div>
			<div class="modal-body">
				<p><?php echo $this->session->flashdata('message'); ?></p>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script>
	$(function () {
		$('#userTable').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false,
			'scrollX'		: true
		})
	})
	<?php if(!empty($this->session->flashdata('message'))) {?>
	$('#modal-default').modal('show')
	<?php } ?>
</script>