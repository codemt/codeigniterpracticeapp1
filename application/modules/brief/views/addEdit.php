<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content container-fluid">
		
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title brief-title"><?php echo( !empty($data['Brief_ID'])? 'Brief No: '.str_pad($data['Brief_NO'],5, "0", STR_PAD_LEFT)."/".$data['Year'] :  $title );  ?></h3>
							<?php if(!empty($data['Brief_ID'])){?>
							<style>
								.box-header .brief-title{
									text-align: center;
									display: block;
									font-weight: 600;
								}
							</style>	
							<?php } ?>
					</div>
					<form role="form" method="post" action="<?php echo base_url()?>brief/savedata">
						<div class="box-body">
							<?php if(!empty($data['Brief_ID'])){?>
								<input type="hidden" value="<?php echo $data['Brief_ID']; ?>" name="Brief_ID" />
							<?php } ?>
							<div class="form-group col-xs-12 col-sm-6">
								<label>Client Name:</label>
									<select <?php echo( !empty($data['Brief_ID'])? 'disabled' : '');?> name="Client_ID" class="form-control select2" id="sel_client" style="width: 100%;" tabindex="-1" aria-hidden="true">
										<option disabled selected>Client Name</option>
										<?php foreach($client as $item){ ?>
											<option value="<?php echo $item->client_id; ?>" <?php echo(!empty($data['Client_ID']) && $data['Client_ID']==$item->client_id)? "selected":""?> ><?php echo $item->name; ?></option>
										<?php } ?>
									</select>
									<?php if (form_error('Client_ID')) echo form_error('Client_ID'); ?> 
							</div>
							<div class="form-group col-xs-12 col-sm-6">
							<label>Brand Name:</label>
								<select <?php echo( !empty($data['Brief_ID'])? 'disabled' : '');?> name="Brand_Name" class="form-control select2" id="sel_brand" style="width: 100%;" tabindex="-1" aria-hidden="true">
									<option disabled selected>Brand Name</option>
									<?php if(!empty($data['Brand_Name'])){ ?>
										<option value="<?php echo($data['Brand_Name'])?>" selected><?php echo($data['Brand_Name'])?></option>

									<?php } ?>
									
									
								</select>
								
								<?php if (form_error('Brand_Name')) echo form_error('Brand_Name'); ?> 
							</div>
							
							<div class="form-group col-xs-12 col-sm-6">
								<label>Brief Date:</label>
								<div class="input-group date" id="briefDate">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input name="Brief_Date" type="text" class="form-control pull-right "value="<?php echo (!empty($data['Brief_Date']))? date("d-m-Y",strtotime($data['Brief_Date'])) : date('d-m-Y'); ?>" />
								</div>
								<?php if (form_error('Brief_Date')) echo form_error('Brief_Date'); ?>
									<!-- <input type="text" value="" class="" placeholder="Date"> --> 
							</div>
							<div class="form-group col-xs-12 col-sm-6">
								<label>Brief Status:</label>
								<select name="Brief_Status" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
									<option value="Active"  <?php echo (!empty($data['Brief_Status']) && $data['Brief_Status']=="Active")? "selected":"";?>>Active</option>
									<option value="Pending"  <?php echo (!empty($data['Brief_Status']) && $data['Brief_Status']=="Pending")? "selected":"";?>>Pending</option>
									<option value="Job Created"  <?php echo (!empty($data['Brief_Status']) && $data['Brief_Status']=="Job Created")? "selected":"";?>>Job Created</option>
									<option value="Completed" <?php echo (!empty($data['Brief_Status']) && $data['Brief_Status']=="Completed")? "selected":"";?>>Completed</option>
								</select>
								<?php if (form_error('Brief_Status')) echo form_error('Brief_Status'); ?> 
							</div>
							<div class="form-group  col-xs-12 col-sm-12">
								<textarea name="Brief_Text" class="editor" placeholder="Place some text here" value="<?php  echo (!empty($data['Brief_Text']))? $data['Brief_Text'] : ''; ?>"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php  echo (!empty($data['Brief_Text']))? $data['Brief_Text'] : ''; ?></textarea>
                          <?php if (form_error('Brief_Text')) echo form_error('Brief_Text'); ?> 
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a class="btn btn-default" type="cancel" href="/nmw/brief">Cancel</a>
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
	$(document).ready(function(){
		var datetim ="<?php echo (!empty($data['Brief_Date']))? date('d-m-Y',strtotime($data['Brief_Date'])) : date('d-m-Y')?>";
		var datetim2="<?php echo (!empty($data['Brief_Date']))? date('Y-m-d',strtotime($data['Brief_Date'])) : date('Y-m-d')?>";
		// alert(datetim);
		var d = new Date(datetim2);
		 d.setDate(d.getDate()-7);
		;
		var D=d.getDate();
		var M=d.getMonth()+1;
		var Y=d.getFullYear();
		var datetim3=D+"-"+M+"-"+Y;
	
		$('#briefDate').datepicker({
			inline: true,
			format: 'dd-mm-yyyy',
			changeFirstDay: false,
			startDate: datetim3,
			endDate: datetim
		});
	});
	$(function () {
		$('.select2').select2()
		
		ClassicEditor
			.create( document.querySelector( '.editor' ),{
				ckfinder: {
					uploadUrl: '<?php echo base_url()?>/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
				} 
			})
			.then( editor => {
				console.log( editor );
			} )
			.catch( error => {
				console.error( error );
			} );

		$('#briefDate').datepicker({
			autoclose: true
		})
	})
	
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
	  

</script>