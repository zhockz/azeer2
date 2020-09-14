
<div class="spacer-40"></div>

<!--header-->
<section id="newRequest" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title"><?php print $head_title; ?></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->


<section>
  <div class="container">

		<!-- message -->
		<?php if($result != ""){?>
			<div class="alert alert-<?php print $result;?> fnt-12" role="alert">
				<?php print $message;?>
			</div>
		<?php }?>

    <div class="row">

      <div class="col-lg-6">
				<label>List of <?php print $table_title; ?></label>
				<p>TOTAL: <?php print $taskCount; ?></p>
      </div>

      <div class="col-lg-6 fnt-18 d-flex align-items-center">

				<form action="" method="post">

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<!--<label class="col-sm-4 col-form-label">From Date :</label>-->
								<div class="">
									<div class="input-group date dateOnly" id="from_date" data-target-input="nearest">
											<input name="from_date" type="text" class="form-control datetimepicker-input" data-target="#from_date" placeholder="From Date" required/>
											<div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
									</div>
								</div>
							</div>
							<div class="spacer-10"></div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<!--<label class="col-sm-5 col-form-label">To Date :</label>-->
								<div class="">
									<div class="input-group date dateOnly" id="to_date" data-target-input="nearest">
											<input name="to_date" type="text" class="form-control datetimepicker-input" data-target="#to_date" placeholder="To Date" required/>
											<div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
									</div>
								</div>
							</div>
							<div class="spacer-10"></div>
						</div>
						<div class="col-lg-2">
							<input type="submit" name="submitSearch" class="btn btn-primary btn-azeer-bl w-100 fnt-12" value="Search">
							<div class="spacer-10"></div>
						</div>
						<div class="col-lg-2">
							<a href="<?php print base_url().$table_link;?>" class="btn btn-primary btn-azeer-bl w-100 fnt-12">Reset</a>
							<div class="spacer-10"></div>
						</div>
					</div>
				</form>

      </div>

		</div>

		<?php if($_SESSION['roles'] <= 2){?>

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="text-center thead-dark">
						<tr>
							<th>#</th>
							<th>Order ID</th>
							<th>Customer</th>
							<th>Type</th>
							<th>Model</th>
							<th>Manufacturer</th>
							<th>Serial No.</th>
							<th class="w-15">Date</th>
							<th>Engineer</th>
							<th class="w-5">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php print $taskList;?>
					</tbody>
				</table>
			</div>

		<?php }?>

		<?php if($_SESSION['roles'] == 3){?>

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="text-center thead-dark">
						<tr>
							<th>#</th>
							<th>Order ID</th>
							<th>Customer</th>
							<th>Type</th>
							<th>Model</th>
							<th>Manufacturer</th>
							<th>Serial No.</th>
							<th class="w-15">Date</th>
							<th class="w-5">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php print $taskList;?>
					</tbody>
				</table>
			</div>

		<?php }?>

		<?php if($_SESSION['roles'] == 4){?>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="text-center thead-dark">
						<tr>
							<th>#</th>
							<th>Order ID</th>
							<th>Type</th>
							<th>Model</th>
							<th>Manufacturer</th>
							<th>Serial No.</th>
							<th class="w-15">Date</th>
							<th class="w-5">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php print $taskList;?>
					</tbody>
				</table>
			</div>
		<?php }?>




		<!--pagination-->
		<?php print $pagination; ?>

  </div>
</section>

<div class="spacer-40"></div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">

				<a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
					<!--<i class="fas fa-power-off marRight-10"></i>-->Back
				</a>
				<div class="spacer-20"></div>
			</div>
			<div class="col-lg-3"></div>
			<div class="col-lg-3"></div>
			<div class="col-lg-3"></div>
		</div>
</div>
</section>

<!--
<script>
  jQuery(document).ready(function(){

    jQuery('.assignEng').each(function(){

      jQuery(this).on('change', function(){
        var getOrderId = jQuery(this).attr("data-orderId");
        var getEngName = jQuery(this).val();

        if(getEngName != 0 || getEngName != ''){
          $.ajax({
              type: 'POST',
              url: "<?php print base_url();?>/ajax",
              headers: {'X-Requested-With': 'XMLHttpRequest'},
              data:{
                order_id:getOrderId,
                eng_uid:getEngName,
                action:'assignEng'
              },
              success: function(data){

                console.log(data);

              }
          });
        }
      });

    });

    jQuery('#customerName').on('change', function(){
      var getCusName = jQuery(this).val();
      if(getCusName != 0 || getCusName != ''){
        $.ajax({
            type: 'POST',
            url: "<?php print base_url();?>/ajax",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data:{
							uid:getCusName,
              type:'getEquipType'
            },
            success: function(data){
              jQuery('#equip_type').removeAttr('disabled');
              jQuery('#equip_type').html('');
              jQuery('#equip_type').html(data);
              jQuery('#equip_type').selectpicker('refresh');

            }
        });
      }else{
        jQuery('#equip_type').attr('disabled','disabled');
        jQuery('#equip_type').html('');
        jQuery('#equip_type').html('<option value="">Please Select</option>');
        jQuery('#equip_type').selectpicker('refresh');

      }

    });
    jQuery('#equip_type').on('change', function(){
      var getCusName = jQuery('#customerName').val();
      var getEquipType = jQuery(this).val();
      if(getEquipType != 0 || getEquipType != ''){
        $.ajax({
            type: 'POST',
            url: "<?php print base_url();?>/ajax",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data:{
              id:getEquipType,
							uid:getCusName,
              type:'getEquipNameUser'
            },
            success: function(data){
              jQuery('#equip_name').removeAttr('disabled');
              jQuery('#equip_name').html('');
              jQuery('#equip_name').html(data);
              jQuery('#equip_name').selectpicker('refresh');

            }
        });
      }else{
        jQuery('#equip_name').attr('disabled','disabled');
        jQuery('#equip_name').html('');
        jQuery('#equip_name').html('<option value="">Please Select</option>');
        jQuery('#equip_name').selectpicker('refresh');

      }

    });

		jQuery('#equip_name').on('change', function(){
      var getCusName = jQuery('#customerName').val();
			var getEquipName = jQuery(this).val();
			if(getEquipName != 0 || getEquipName != ''){
				$.ajax({
						type: 'POST',
						url: "<?php print base_url();?>/ajax",
						headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							id:getEquipName,
							uid:getCusName,
							type:'getSerialNo'
						},
						success: function(data){
							jQuery('#serial_no').removeAttr('disabled');
							jQuery('#serial_no').html('');
							jQuery('#serial_no').html(data);
							jQuery('#serial_no').selectpicker('refresh');

						}
				});
			}else{
				jQuery('#serial_no').attr('disabled','disabled');
				jQuery('#serial_no').html('');
				jQuery('#serial_no').html('<option value="">Please Select</option>');
				jQuery('#serial_no').selectpicker('refresh');

			}

		});

  });
</script>
-->
