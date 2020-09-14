
<div class="spacer-40"></div>

<!--header-->
<section  class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Customers <small class="fnt-18">Equipments</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<!--equipment search-->
<section>
  <div class="row">


  </div>
</section>

<!--equipment add-->
<section>
  <div class="row">


  </div>
</section>

<!--equipment list-->
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10">
        <label>List of Equipments</label>
        <p>TOTAL: <?php print $equipmentCount; ?></p>
        <p><i class="fas fa-stop" style="color:#ffc107;"></i> Upcoming Due | <i class="fas fa-stop" style="color:red;"></i> Over Due</p>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover table-sm">
        <thead class="text-center thead-dark">
          <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Type</th>
            <th>Model Name</th>
            <th>Serial No.</th>
            <th>Manufacturer</th>
            <th>1st Visit</th>
            <th>2nd Visit</th>
            <th>Status</th>
            <th class="w-10">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php print $equipmentList;?>
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
				<a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
					Dashboard
				</a>
				<div class="spacer-20"></div>
			</div>
			<div class="col-lg-3"></div>
			<div class="col-lg-3"></div>
			<div class="col-lg-3"></div>
		</div>
</div>
</section>
