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
					<form role="form" class="form-horizontal">
						<div class="box-body">
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Client:</label>
								<div class="col-xs-9">
									<select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="1">Client 1</option>
										<option value="2">Client 2</option>
										<option value="3">Client 3</option>
										<option value="4">Client 4</option>
										<option value="5">Client 5</option>
										<option value="6">Client 6</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Brand:</label>
								<div class="col-xs-9">
									<select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="1">Brand 1</option>
										<option value="2">Brand 2</option>
										<option value="3">Brand 3</option>
										<option value="4">Brand 4</option>
										<option value="5">Brand 5</option>
										<option value="6">Brand 6</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Bill Type:</label>
								<div class="col-xs-9">
									<select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="AW">Artwork</option>
										<option value="IM">Images</option>
										<option value="RF">Retainer Fee</option>
										<option value="CF">Creative Fee(Project)</option>
										<option value="CR">Creative Layout</option>
										<option value="FI">Finished Job</option>
										<option value="DF">Digital Retainer</option>
										<option value="IT">Digital Media</option>
										<option value="WD">Digital Non-media</option>
										<option value="AV">Audio Visual</option>
										<option value="PN">Printing</option>
										<option value="FB">Fabrication</option>
										<option value="EV">Events/exhibitions</option>
										<option value="PH">Photography</option>
										<option value="DN">Debit Notes</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Billable:</label>
								<div class="col-xs-9">
									<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option value="1">Yes</option>
										<option value="2">No</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Stages:</label>
								<div class="col-xs-9">
									<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="1">Layout</option>
										<option value="2">Artwork</option>
										<option value="2">Pending for billing</option>
										<option value="2">Billed</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">Status:</label>
								<div class="col-xs-9">
									<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option></option>
										<option value="1">Active</option>
										<option value="2">Pending</option>
										<option value="2">Complete</option>
									</select>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">From:</label>
								<div class="col-xs-9">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control" id="fromDate">
									</div>
								</div>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label class="col-xs-3 control-label">To:</label>
								<div class="col-xs-9">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control" id="toDate">
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