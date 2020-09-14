
<div class="spacer-40"></div>

<!--header-->
<section id="locations-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Settings <small class="fnt-18">Location</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<section>
  <div class="container">
	<!--
    <?php if($result != ""){?>
      <div class="alert alert-<?php print $result;?>" role="alert">
        <?php print $message;?>
      </div>
    <?php }?>
	-->
    <div class="row">
      <div class="col-lg-4">
        <h4>Regions</h4>
        <form action="" method="post" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">Region Name</label>
          <input name="region" type="text" class="form-control mb-2 mr-sm-2" placeholder="Region Name" required>
          <input name="addRegion" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
        </form>

        <div class="spacer-6"></div>

        <small><b>TOTAL:</b> <?php print $regionCount;?></small>

        <?php if($regionCount != 0){?>

          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm">
              <thead class="text-center thead-dark">
                <tr>
                  <th>ID</th>
                  <th>Region</th>
                  <th class="w-25">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php print $regionList ;?>
              </tbody>

            </table>
          </div>

        <?php }else{?>

          <div class="alert alert-warning" role="alert">
            No data yet...
          </div>

        <?php }?>

        <div class="spacer-20"></div>

      </div>

      <div class="col-lg-8">
        <h4>Cities</h4>

        <div class="row">

          <div class="col-lg-10">
            <form action="" method="post" class="form-inline">
              <label class="sr-only" for="">Regions</label>
              <select name="region" class="form-control mb-2 mr-sm-2 selectpicker show-tick" data-live-search="true" required>
                <?php print $option_region; ?>
              </select>

              <label class="sr-only" for="">City Name</label>
              <input name="city" type="text" class="form-control mb-2 mr-sm-2"  placeholder="City Name" required>

              <input name="addCity" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
            </form>
          </div>

          <div class="col-lg-2 text-right">
            <a href="<?php print base_url();?>/settings/locations" class="btn btn-primary fnt-12">
    					<!--<i class="fas fa-power-off marRight-10"></i>-->Reset
    				</a>
          </div>

        </div>


        <small><b>TOTAL:</b> <?php print $cityCount; ?></small>

        <?php if($cityCount != 0){?>

          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm">
              <thead class="text-center thead-dark">
                <tr>
                  <th class="w-10">ID</th>
                  <th class="w-30">Region</th>
                  <th>City</th>
                  <th class="w-5">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php print $cityList ;?>
              </tbody>

            </table>
          </div>

					<!-- pagination --->
					<?php print $pagination; ?>


      <?php }else{?>

        <div class="alert alert-warning" role="alert">
          No data yet...
        </div>

      <?php }?>

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
				<a href="<?php print base_url();?>/settings" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
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

<!-- Modal -->
<div class="modal fade" id="editRegion" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="">Edit Region</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" method="post">
      <div class="modal-body">
          <label for="">Please enter a new region name</label>
          <input name="id" id="regionId" type="hidden" class="form-control" value="">
          <input name="region" id="regionName" type="text" class="form-control" value="" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" name="editRegion" class="btn btn-primary" value="Confirm">
      </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" id="editCity" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="">Edit Region</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" method="post">
      <div class="modal-body">
					<label class="sr-only" for="">Regions</label>
					<select name="region" id="regionId" class="form-control mb-2 mr-sm-2 selectpicker show-tick" data-live-search="true" required>
						<?php print $option_region; ?>
					</select>
					<label class="sr-only" for="">City Name</label>
					<input name="id" id="cityId" type="hidden" class="form-control" value="">
					<input name="city" id="cityName" type="text" class="form-control mb-2 mr-sm-2"  placeholder="City Name" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" name="editCity" class="btn btn-primary" value="Confirm">
      </div>
    </form>
  </div>
</div>
</div>

<script>
  jQuery(document).ready(function(){

    jQuery(".btn-editRegion").each(function(){

        jQuery(this).on("click touch",function(e){

          e.preventDefault();
          var regionId = jQuery(this).attr("data-id");
          var regionName = jQuery(this).attr("data-name");

          jQuery("#editRegion #regionId").val(regionId);
          jQuery("#editRegion #regionName").val(regionName);
          jQuery('#editRegion').modal('show');

        });
    });

	  jQuery('#editRegion').on('hidden.bs.modal', function (e) {

	    jQuery("#editRegion #regionId").val("");
	    jQuery("#editRegion #regionName").val("");

	  });

		jQuery(".btn-editCity").each(function(){

				jQuery(this).on("click touch",function(e){

					e.preventDefault();
					var cityId = jQuery(this).attr("data-id");
					var cityName = jQuery(this).attr("data-name");
					var regionId = jQuery(this).attr("data-regionId");

					jQuery("#editCity #cityId").val(cityId);
					jQuery("#editCity #cityName").val(cityName);
					jQuery("#editCity #regionId").val(regionId);
					jQuery('#editCity').modal('show');

				});
		});

		jQuery('#editCity').on('hidden.bs.modal', function (e) {

			jQuery("#editCity #cityId").val("");
			jQuery("#editCity #cityName").val("");
			jQuery("#editCity #regionId").val("");

		});


  });
</script>
