<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
    	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h1 class="box-title">Brief</h1>
						<div class="box-tools pull-right">
							<?php if(in_array('brief_add', $permissions)){ ?>
								<a class="btn btn-block btn-primary" href="<?php echo base_url()?>brief/addEdit">Add Brief</a>
							<?php } ?> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<div ></div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<table id="briefTable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>Brief No.</th>
									<th>Client Name</th>
									<th>Brand Name</th>
									<th>Brief Status</th>
									<th>Brief Created Date</th>
									<th>Created By</th>
									<?php if(in_array('brief_edit', $permissions)){ ?>
									<th>Actions</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								
								<?php
								$i=0;
								foreach($briefs as $item){
								$briefnumber = str_pad($item['Brief_no'],5, "0", STR_PAD_LEFT)."/".$item['Year']; ?>
								<tr>
									<td>	<?php echo ++$i; ?></td>
									<td>	<?php echo $briefnumber; ?></td>
									<td>	<?php echo $item['name']; ?></td>
									<td>	<?php echo $item['Brand_Name']; ?></td>
									<td>	<?php echo $item['Brief_Status']; ?></td>
									<td>	<?php echo date("d-m-Y",strtotime($item['Brief_Date'])) ?></td>
									<td>	<?php echo $item['creator']; ?></td>
									
									<?php if(in_array('brief_edit', $permissions)){ ?>
									<td>
										<a href="<?php echo base_url()."brief/addEdit/".$item['Brief_ID']; ?>"><i class="fa fa-pencil"></i></a>
										<!-- <a href="<?php //echo base_url()."brief/getChangestatus/".$item['Brief_ID']; ?>"onclick="return confirm('Are you sure, you want to delete it?');">
										<i class="fa fa-trash"></i></a> -->
									</td>
									<?php } ?>
								</tr>

								<?php	} ?>
									
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
    $('#briefTable').DataTable({
		'paging'      : true,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false,
		'orderCellsTop': true,
		'scrollX'		: true
    })
    $(".dataTables_filter").css("float","right");
  })
  <?php if(!empty($this->session->flashdata('message'))) {?>
	$('#modal-default').modal('show')
	<?php } ?>
</script>