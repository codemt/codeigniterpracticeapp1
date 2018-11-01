<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
    	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h1 class="box-title">Bill Types List</h1>
						<div class="box-tools pull-right">
							<?php if(in_array('job_add', $permissions)){ ?>
								<a class="btn btn-block btn-primary" href="<?php echo base_url()?>billtypes/addTypes">Add Bill Type</a>
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
						<table id="briefTable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<!-- <th>Abbrevation </th> -->
									<th> Name</th>
									<!-- <th>Subactivity</th>
									<th>Brief Created Date</th>
									<th>Job Title</th>
									<th>Job Created Date</th>
									<th>Created By</th>
									<th>Job Status</th> -->

									<?php if(in_array('job_payment_info', $permissions)){ ?>
									<!-- <th>Bill Amount</th>
									<th>Bill No</th>
									<th>Bill Date</th> -->
									<?php } ?>
							  		
							  		<?php if(in_array('job_edit', $permissions)){ ?>
									<th>Actions</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php
										 $i=0;
									foreach($jobs as $item){
								 ?>
									<tr>
										<td>	<?php echo ++$i; ?></td>
									  <!--	<td>	<?php // echo $item['bill_abbreviation']; ?></td> -->
                                        <td>	<?php echo $item['bill_type']; ?></td>
                                        <td>  	<a href="<?php echo base_url()."job/addEdit/".$item['id']; ?>"><i class="fas fa-pencil-alt"></i></a></td> 
										<?php } ?>
                                           
								    </tr>

								
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
      'scrollX'		: true  
    })
    $(".dataTables_filter").css("float","right");

  })
    <?php if(!empty($this->session->flashdata('message'))) {?>
	$('#modal-default').modal('show')
	<?php } ?>
</script>