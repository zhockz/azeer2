
<div class="spacer-40"></div>

<!--header-->
<section id="equipments-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Settings <small class="fnt-18">Equipments</small></h2>
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
        <h4>Equipment Type</h4>
        <form action="" method="post" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">Equipment Type</label>
          <input name="equip_type" type="text" class="form-control mb-2 mr-sm-2" placeholder="Equipment Type" required>
          <input name="addEquipType" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
        </form>

        <div class="spacer-6"></div>

        <small><b>TOTAL:</b> <?php print $equipTypeCount;?></small>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th>ID</th>
                <th>Equipment Type</th>
                <th class="w-25">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php print $equipTypeList ;?>
            </tbody>

          </table>
        </div>

        <div class="spacer-20"></div>

      </div>

      <div class="col-lg-8">
        <h4>Equipment Name</h4>

        <div class="row">

          <div class="col-lg-10">
            <form action="" method="post" class="form-inline">
              <label class="sr-only" for="">Equipment Name</label>
              <select name="equip_type" class="form-control mb-2 mr-sm-2 selectpicker show-tick" data-live-search="true" required>
                <?php print $option_equipType; ?>
              </select>

              <label class="sr-only" for="">Equipment Name</label>
              <input name="equip_name" type="text" class="form-control mb-2 mr-sm-2"  placeholder="Equipment Name" required>

              <input name="addEquipName" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
            </form>
          </div>

          <div class="col-lg-2 text-right">
            <a href="<?php print base_url();?>/settings/equipments" class="btn btn-primary fnt-12">
    					<!--<i class="fas fa-power-off marRight-10"></i>-->Reset
    				</a>
          </div>

        </div>

        <small><b>TOTAL:</b> <?php print $equipNameCount; ?></small>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th class="w-10">ID</th>
                <th class="w-30">Equipment Type</th>
                <th>Equipment Type</th>
                <th class="w-5">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php print $equipNameList ;?>
            </tbody>

          </table>
        </div>

        <!-- pagination --->
        <?php print $pagination; ?>

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
<div class="modal fade" id="editEquipType" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Edit Equipment Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
            <label for="">Please enter a new equipment type name</label>
            <input name="id" id="equipTypeId" type="hidden" class="form-control" value="">
            <input name="equip_type" id="equipTypeName" type="text" class="form-control" value="" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="submit" name="editEquipType" class="btn btn-primary" value="Confirm">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editEquipName" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Edit Equipment Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
  					<label class="sr-only" for="">Equipment Name</label>
  					<select name="equip_type" id="equipTypeId" class="form-control mb-2 mr-sm-2 selectpicker show-tick" data-live-search="true" required>
  						<?php print $option_equipType; ?>
  					</select>
  					<label class="sr-only" for="">Equipment Name</label>
  					<input name="id" id="equipNameId" type="hidden" class="form-control" value="">
  					<input name="equip_name" id="equipName" type="text" class="form-control mb-2 mr-sm-2"  placeholder="Equipment Name" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="submit" name="editEquipName" class="btn btn-primary" value="Confirm">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  jQuery(document).ready(function(){

    jQuery(".btn-editEquipType").each(function(){

        jQuery(this).on("click touch",function(e){

          e.preventDefault();
          var equipTypeId = jQuery(this).attr("data-id");
          var equipTypeName = jQuery(this).attr("data-name");

          jQuery("#editEquipType #equipTypeId").val(equipTypeId);
          jQuery("#editEquipType #equipTypeName").val(equipTypeName);
          jQuery('#editEquipType').modal('show');

        });
    });

	  jQuery('#editEquipType').on('hidden.bs.modal', function (e) {

	    jQuery("#editEquipType #equipTypeId").val("");
	    jQuery("#editEquipType #equipTypeName").val("");

	  });

		jQuery(".btn-editEquipName").each(function(){

				jQuery(this).on("click touch",function(e){

					e.preventDefault();
					var equipNameId = jQuery(this).attr("data-id");
					var equipName = jQuery(this).attr("data-name");
					var equipTypeId = jQuery(this).attr("data-regionId");

					jQuery("#editEquipName #equipNameId").val(equipNameId);
					jQuery("#editEquipName #equipName").val(equipName);
					jQuery("#editEquipName #equipTypeId").val(equipTypeId);
					jQuery('#editEquipName').modal('show');

				});
		});

		jQuery('#editCity').on('hidden.bs.modal', function (e) {

			jQuery("#editCity #cityId").val("");
			jQuery("#editCity #cityName").val("");
			jQuery("#editCity #regionId").val("");

		});


  });
</script>
