
<div class="spacer-40"></div>

<!--header-->
<section id="dashboard-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Customers <small class="fnt-18">Add Equipments</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<form action="" method="post">

  <section>
    <div class="container fnt-18">

			<!-- message -->
			<?php if($result != ""){?>
				<div class="alert alert-<?php print $result;?> fnt-12" role="alert">
					<?php print $message;?>
				</div>
			<?php }?>

        <div class="row">

          <!--column 1-->
          <div class="col-lg-4">
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Type :</label>
              <div class="col-sm-7">
                <select name="equip_type" id="equip_type" class="form-control selectpicker" data-live-search="true" required>
	                <?php print $option_equipType; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Name :</label>
              <div class="col-sm-7">
                <select name="equip_name" id="equip_name" class="form-control selectpicker" data-live-search="true" disabled required>
                  <option value="">Please Select</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Manufacturer :</label>
              <div class="col-sm-7">
                <input name="manufacturer" class="form-control" type="text" value="" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Serial No. :</label>
              <div class="col-sm-7">
                <input name="serial_no" class="form-control" type="text" value="" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Customer	:</label>
              <div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-12" value="<?php print $user['name']; ?>">
              </div>
            </div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">Status :</label>
							<div class="col-sm-7">
								<select name="status" class="form-control selectpicker" data-live-search="true" required>
                  <?php print $option_equipStat; ?>
                </select>
							</div>
						</div>
          </div>

          <!--column 2-->
          <div class="col-lg-4">
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">Installation No.:</label>
							<div class="col-sm-7">
								<input name="install_no" class="form-control" type="text" value="">
							</div>
						</div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Location :</label>
              <div class="col-sm-7">
                <input name="location" class="form-control" type="text" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Region :</label>
              <div class="col-sm-7">
                <select name="region" id="region" class="form-control selectpicker" data-live-search="true" required>
                  <?php print $option_region; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">City :</label>
              <div class="col-sm-7">
                <select name="city" id="city" class="form-control selectpicker" data-live-search="true" disabled required>
                  <option value="">Please Select</option>
                </select>
              </div>
            </div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">Warranty End :</label>
							<div class="col-sm-7">
								<div class="input-group date dateOnly" id="warrantyDate" data-target-input="nearest">
										<input name="warranty" type="text" class="form-control datetimepicker-input" data-target="#warrantyDate"/>
										<div class="input-group-append" data-target="#warrantyDate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
							</div>
						</div>
          </div>

          <!--column 3-->
          <div class="col-lg-4">
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">SC No. :</label>
							<div class="col-sm-7">
								<input name="sc_no" class="form-control" type="text" value="" placeholder="Service Contract No.">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">SC Start :</label>
							<div class="col-sm-7">
								<div class="input-group date dateOnly" id="scStartDate" data-target-input="nearest">
										<input name="sc_start" type="text" class="form-control datetimepicker-input" data-target="#scStartDate" placeholder="Service Contract Start"/>
										<div class="input-group-append" data-target="#scStartDate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">SC End :</label>
							<div class="col-sm-7">
								<div class="input-group date dateOnly" id="scEndDate" data-target-input="nearest">
										<input name="sc_end" type="text" class="form-control datetimepicker-input" data-target="#scEndDate" placeholder="Service Contract End"/>
										<div class="input-group-append" data-target="#scEndDate" data-toggle="datetimepicker" >
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
							</div>
						</div>
						<div class="spacer-6"></div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">1st Visit :</label>
							<div class="col-sm-7">
								<div class="input-group date dateOnly" id="1stVisitDate" data-target-input="nearest">
										<input name="visit_1" type="text" class="form-control datetimepicker-input" data-target="#1stVisitDate"/>
										<div class="input-group-append" data-target="#1stVisitDate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">2nd Visit :</label>
							<div class="col-sm-7">
								<div class="input-group date dateOnly" id="2ndVisitDate" data-target-input="nearest">
										<input name="visit_2" type="text" class="form-control datetimepicker-input" data-target="#2ndVisitDate"/>
										<div class="input-group-append" data-target="#2ndVisitDate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
							</div>
						</div>
          </div>

        </div>

    </div>

  </section>

  <div class="spacer-20"></div>

  <section>
  	<div class="container">
  		<div class="row">
  			<div class="col-lg-3">
					<a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
						Dashboard
					</a>
					<div class="spacer-20"></div>
  				<a href="<?php print base_url();?>/customers/equipments?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
  					<!--<i class="fas fa-power-off marRight-10"></i>-->Back
  				</a>
  				<div class="spacer-20"></div>
  			</div>
  			<div class="col-lg-3"></div>
  			<div class="col-lg-3"></div>
  			<div class="col-lg-3">
          <input name="addEquip" type="submit" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl" value="Add">
        </div>
  		</div>
  </div>
  </section>

</form>

<script>
	jQuery(document).ready(function(){

		jQuery('#equip_type').on('change', function(){
			var getTypeVal = jQuery(this).val();
			//console.log(getTypeVal);
			if(getTypeVal != 0 || getTypeVal != ''){
				$.ajax({
						type: 'POST',
				    url: "<?php print base_url();?>/ajax",
				    headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							id:getTypeVal,
	         		type:'getEquipName'
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

		jQuery('#region').on('change', function(){
			var getRegion = jQuery(this).val();
			if(getRegion != 0 || getRegion != ''){
				$.ajax({
						type: 'POST',
				    url: "<?php print base_url();?>/ajax",
				    headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							id:getRegion,
	         		type:'getCity'
	      		},
						success: function(data){
							jQuery('#city').removeAttr('disabled');
							jQuery('#city').html('');
							jQuery('#city').html(data);
							jQuery('#city').selectpicker('refresh');

						}
				});
			}else{
				jQuery('#city').attr('disabled','disabled');
				jQuery('#city').html('');
				jQuery('#city').html('<option value="">Please Select</option>');
				jQuery('#city').selectpicker('refresh');

			}

		});

	});
</script>
