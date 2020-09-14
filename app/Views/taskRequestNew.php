
<div class="spacer-40"></div>

<!--header-->
<section id="newRequest" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Request <small class="fnt-18">New</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<section>
  <div class="container fnt-18">

		<!-- message -->
		<?php if($result != ""){?>
			<div class="alert alert-<?php print $result;?> fnt-12" role="alert">
				<?php print $message;?>
			</div>
		<?php }?>

    <form action="" method="post">

      <div class="row">
        <div class="col-lg-4">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Order No. :</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext fnt-16" value="<?php print $order_id; ?>">
              <input type="hidden" name="order_id" value="<?php print $order_id; ?>">
            </div>
          </div>
        </div>
        <div class="col-lg-3">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Date :</label>
						<div class="col-sm-8">
							<input type="text" readonly class="form-control-plaintext fnt-16" value="<?php print $order_date; ?>">
						</div>
					</div>
        </div>
				<div class="col-lg-5">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Service Type :</label>
						<div class="col-sm-8">
							<select name="sc_type" class="form-control selectpicker" data-live-search="true" required>
								<?php print $option_scType; ?>
							</select>
						</div>
					</div>
				</div>
      </div>


      <div class="row">
        <div class="col-lg-4">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Type :</label>
            <div class="col-sm-8">
              <select id="equip_type" class="form-control selectpicker" data-live-search="true" required>
                <?php print $option_equipType; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Model :</label>
            <div class="col-sm-8">
              <select id="equip_name" class="form-control selectpicker" data-live-search="true" disabled required>
                <option value="">Please Select</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Serial No. :</label>
            <div class="col-sm-8">
              <select name="equipments" id="serial_no" class="form-control selectpicker" data-live-search="true" disabled required>
                <?php //print $option_status; ?>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Issue Desription :</label>
            <div class="col-sm-10">
              <textarea name="issue" class="form-control" rows="4" cols="80" required></textarea>
            </div>
          </div>

        </div>
        <div class="col-lg-2 align-self-end">
          <div class="spacer-10"></div>
          <input type="submit" name="submitRequest" class="btn btn-primary btn-azeer-bl w-100" value="SUBMIT">
        </div>
      </div>

    </form>


  </div>
</section>

<div class="spacer-20"></div>

<section>
  <div class="container">

      <div class="row">
        <div class="col-lg-10">
					<label>List of New Request</label>
					<p>TOTAL: <?php print $taskCount; ?></p>
        </div>
        <div class="col-lg-2"></div>
      </div>

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

<script>
  jQuery(document).ready(function(){

    jQuery('#equip_type').on('change', function(){
      var getEquipType = jQuery(this).val();
      if(getEquipType != 0 || getEquipType != ''){
        $.ajax({
            type: 'POST',
            url: "<?php print base_url();?>/ajax",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data:{
              id:getEquipType,
							uid:<?php print $_SESSION['uid']; ?>,
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
			var getEquipName = jQuery(this).val();
			if(getEquipName != 0 || getEquipName != ''){
				$.ajax({
						type: 'POST',
						url: "<?php print base_url();?>/ajax",
						headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							id:getEquipName,
							uid:<?php print $_SESSION['uid']; ?>,
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
