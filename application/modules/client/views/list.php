<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
    	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h1 class="box-title">Clients</h1>
						<div class="box-tools pull-right">
							<?php if(in_array('client_add', $permissions)){ ?>
								<a class="btn btn-block btn-primary" href="<?php echo base_url()?>client/addEdit">Add Client</a>
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
						<table id="clientTable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Name</th>
									<th>Address</th>
									<th>Brand</th>
									<th>Status</th>
									<th>Created At</th>
									<th>Created By</th>
									
									<?php if(in_array('client_edit', $permissions)){ ?>
									<th>Actions</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
							<?php
								if ($client) {
									$i = 1;
									foreach ($client as $item) {
										echo "<tr>";
										echo "<td>".$i++."</td>";
										echo "<td>".$item->name."</td>";
										echo "<td>".$item->address."</td>";
										echo "<td>".$item->brand_name."</td>";
										echo "<td>".$item->status."</td>";
										echo "<td>".date("d-m-Y",strtotime($item->created_at))."</td>";
										echo "<td>".$item->creator."</td>";
										?>
										<?php if(in_array('client_edit', $permissions)){ ?>
										<td>
												<a href="<?php echo  base_url()."client/addEdit/".$item->client_id; ?>" ><i class="fa fa-pencil"></i></a>
												<!-- <a href="<?php //echo base_url()."client/getChangestatus/".$item->client_id;  ?>" onclick="return confirm('Are you sure, you want to delete it?');"><i class="fa fa-trash"></i></a> -->
										</td>
										<?php } ?>

										<?php echo "</tr>";
									}
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
    $('#clientTable').DataTable({
		'paging'		: true,
		'lengthChange'	: false,
		'searching'		: true,
		'ordering'		: true,
		'info'			: true,
		'autoWidth'		: false,
		'scrollX'		: true
    })
  })

  <?php if(!empty($this->session->flashdata('message'))) {?>
	$('#modal-default').modal('show')
	<?php } ?>

</script>