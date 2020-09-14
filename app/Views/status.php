
<div class="spacer-40"></div>

<!--header-->
<section id="status-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Settings <small class="fnt-18">Status</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<section>

  <div class="container">

    <div class="row">
      <div class="col-lg-3">
        <h4>User</h4>
        <form action="" method="post" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">User Status Name</label>
          <input name="status" type="text" class="form-control mb-2 mr-sm-2" placeholder="Status Name" required>
          <input name="addUserStatus" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th class="w-25">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php print $userStatus;?>
            </tbody>
          </table>
        </div>
        <div class="spacer-20"></div>
      </div>

      <div class="col-lg-3">
        <h4>Task</h4>
        <form action="" method="post" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">Task Status Name</label>
          <input name="status" type="text" class="form-control mb-2 mr-sm-2" placeholder="Status Name" required>
          <input name="addTaskStatus" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th class="w-25">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php print $taskStatus; ?>
            </tbody>
          </table>
        </div>
        <div class="spacer-20"></div>
      </div>

      <div class="col-lg-3">
        <h4>Equipment</h4>
        <form action="" method="post" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">Equipment Status Name</label>
          <input name="status" type="text" class="form-control mb-2 mr-sm-2" placeholder="Status Name" required>
          <input name="addEquipmentStatus" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th class="w-25">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php print $equipStatus ;?>
            </tbody>
          </table>
        </div>
        <div class="spacer-20"></div>
      </div>

      <div class="col-lg-3">
        <h4>Service Type</h4>
        <form action="" method="post" class="form-inline">
          <label class="sr-only" for="inlineFormInputName2">Service Type</label>
          <input name="status" type="text" class="form-control mb-2 mr-sm-2" placeholder="Status Name" required>
          <input name="addServiceStatus" type="submit" class="btn btn-primary mb-2 fnt-12" value="Add"/>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th class="w-25">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php print $scStatus ;?>
            </tbody>
          </table>
        </div>
        <div class="spacer-20"></div>
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
<div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="">Edit Status</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" method="post">
      <div class="modal-body">
          <label for="">Please enter a new name</label>
          <input name="id" id="statId" type="hidden" class="form-control" value="">
          <input name="type" id="statType" type="hidden" class="form-control" value="">
          <input name="status" id="statName" type="text" class="form-control" value="" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" name="editStatus" class="btn btn-primary" value="Confirm">
      </div>
    </form>
  </div>
</div>
</div>


<script>
  jQuery(document).ready(function(){

    jQuery(".btn-editStatus").each(function(){

        jQuery(this).on("click touch",function(e){

          e.preventDefault();
          var statId = jQuery(this).attr("data-id");
          var statName = jQuery(this).attr("data-name");
          var statType = jQuery(this).attr("data-type");

          jQuery("#editStatus #statId").val(statId);
          jQuery("#editStatus #statName").val(statName);
          jQuery("#editStatus #statType").val(statType);
          jQuery('#editStatus').modal('show');

        });
    });

	  jQuery('#editStatus').on('hidden.bs.modal', function (e) {

      jQuery("#editStatus #statId").val('');
      jQuery("#editStatus #statName").val('');
      jQuery("#editStatus #statType").val('');

	  });


  });
</script>
