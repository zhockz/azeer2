
<div class="spacer-40"></div>

<!--header-->
<section id="user-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Customers</h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--Search-->
<?php if($_SESSION['roles'] <= 3){?>
	<section>
	  <div class="container fnt-18">
	    <!--Search Form-->
	    <form action="" method="post">
	      <div class="row">
	        <div class="col-lg-6">
	          <div class="form-group">
	            <label class="col-form-label">Customer's Name:</label>
	            <input name="name" type="text" class="form-control" value="">
	          </div>
	        </div>
	        <div class="col-lg-2">
	          <div class="form-group">
	            <label class="col-form-label">Status:</label>
	              <select name="status" class="form-control selectpicker" data-live-search="true">
	              	<?php print $option_status; ?>
	              </select>
	          </div>
	        </div>
	        <div class="col-lg-2">
	          <div class="form-group">
	            <label class="col-form-label">City:</label>
	              <select name="city" class="form-control selectpicker" data-live-search="true">
	                <?php print $option_city; ?>
	              </select>
	          </div>
	        </div>
	        <div class="col-lg-1">
	          <div class="spacer-40"></div>
	          <div class="form-group">
	            <input name="submitSearch" type="submit" class="btn btn-primary btn-md w-100 fnt-12" value="Search">
	        	</div>
	        </div>
					<div class="col-lg-1">
						<div class="spacer-40"></div>
						<div class="form-group">
							<a href="<?php print base_url();?>/customers" class="btn btn-primary btn-md w-100 fnt-12">Reset</a>
						</div>
					</div>
	      </div>
	    </form>
	</section>

	<div class="spacer-20"></div>
<?php }?>
<!--content-->
<section>
  <div class="container">


      <div class="row">
        <div class="col-lg-10">
					<label>List of Customers</label>
					<p>TOTAL: <?php print $UserCount; ?></p>
        </div>
        <div class="col-lg-2">
					<?php if($_SESSION['roles'] <= 2){?>
	          <a href="<?php print base_url();?>/customers/add" class="btn btn-primary btn-md w-100 fnt-12">
							<i class="fas fa-user-plus marRight-10"></i> Add New Customer</a>
	          <div class="spacer-10"></div>
					<?php }?>
        </div>
      </div>

    <div class="table-responsive">

      <table class="table table-striped table-bordered table-hover table-sm">
        <thead class="text-center thead-dark">
          <tr>
						<th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Region</th>
            <th>City</th>
            <th>Telephone Number</th>
            <th>Status</th>
						<th>Date Created</th>
						<th>Date Login</th>
            <th class="w-10">Action</th>
          </tr>
        </thead>
        <tbody>
					<?php print $userList;?>
        </tbody>
      </table>
    </div>

  </div>
</section>

<div class="spacer-20"></div>

<!-- pagination --->
<section>
	<div class="container">
			<?php print $pagination; ?>
	</div>
</section>

<div class="spacer-20"></div>

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
