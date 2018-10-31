<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
    	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h1 class="box-title">Roles</h1>
						<div class="box-tools pull-right">
							<a class="btn btn-block btn-primary" href="<?php echo base_url()?>roles/addEdit">Add Role</a>
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
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								foreach ($roles as $role){
								?>
								<tr>
									
									<td><?php echo $i ?></td>
									<td><?php echo $role->name; ?></td>
									<td>
										<a href="<?php echo base_url()?>roles/addEdit/<?php echo $role->role_id; ?>"><i class="fa fa-pencil"></i></a>
									</td>
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
  
<script>
  $(function () {
    $('#userTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>