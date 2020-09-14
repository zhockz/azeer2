
<div class="spacer-20"></div>

<!--header-->
<section id="dashboard-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

		<div class="row">

			<?php include "common/header2.php";?>

			<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
				<h2 class="title">Task <small class="fnt-18">History</small></h2>
			</div>
			<div class="col-lg-2"></div>
		</div>

		<?php if(isset($_GET['order_id']) && $_GET['order_id'] != ''){ ?>
			<label>Order Details</label>
			<div class="row fnt-14">
				<div class="col-lg-4">
					<p class="remMar"><b>Order ID :</b> <?php print $order_id; ?></p>
					<p class="remMar"><b>Customer Name :</b> <?php print $history_customer; ?></p>
					<p class="remMar"><b>Equipment Type :</b> <?php print $history_equip_type; ?></p>
					<p class="remMar"><b>Equipment Model :</b> <?php print $history_equip_name; ?></p>
					<p class="remMar"><b>Serial No. :</b> <?php print $history_serial_no; ?></p>
					<p class="remMar"><b>Manufacturer. :</b> <?php print $history_manufacturer; ?></p>
				</div>
				<div class="col-lg-4">
					<p class="remMar"><b>Created by :</b> <?php print $history_created_by; ?></p>
					<p class="remMar"><b>Date :</b> <?php print $history_created; ?></p>
					<p class="remMar"><b>Equipment's History :</b>
						<a href="<?php print $history_equip_link; ?>" class="btn btn-info btn-sm" rel="tooltip" data-placement="bottom" title="View" target="_new">
							<i class="far fa-eye"></i>
						</a>
					</p>
				</div>
				<div class="col-lg-4"></div>
			</div>

		<?php }?>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<?php if(isset($_GET['order_id']) && $_GET['order_id'] != ''){ ?>

	<section>
	  <div class="container">

			<div class="row">

				<div class="col-lg-6 align-self-end">
					<label>List of History</label>
					<p>TOTAL: <?php print $taskCount; ?></p>
				</div>

				<div class="col-lg-6 fnt-18"></div>

			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="text-center thead-dark">
						<tr>
							<th>#</th>
							<th class="w-15">Date</th>
							<th class="w-15">Status</th>
							<th>Engineer</th>
							<th>Updated By</th>
						</tr>
					</thead>
					<tbody>
						<?php print $taskList;?>
					</tbody>
				</table>
			</div>

				<!--pagination-->
			<?php //print $pagination; ?>

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
					<a href="<?php print base_url();?>/task/history" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
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

<?php }else{?>

	<section>
	  <div class="container">

			<div class="row">

				<div class="col-lg-6 align-self-end">
					<label>List of Tasks</label>
					<p>TOTAL: <?php print $taskCount; ?></p>
				</div>

				<div class="col-lg-6 fnt-18">

					<form action="" method="post">

						<div class="row">
							<div class="col-lg-5">
								<div class="form-group">
									<label class="col-form-label">Order No. :</label>
									<input name="order_id" type="text" class="form-control">
								</div>
								<div class="spacer-10"></div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label class="col-form-label">Status :</label>
									<select name="status" class="form-control selectpicker">
										<?php print $status_option; ?>
									</select>
								</div>
								<div class="spacer-10"></div>
							</div>
							<div class="col-lg-2 align-self-end">
								<input type="submit" name="submitSearch" class="btn btn-primary btn-azeer-bl w-100 fnt-12" value="Search">
								<div class="spacer-10"></div>
							</div>
							<div class="col-lg-2 align-self-end">
								<a  href="<?php print base_url();?>/task/history" class="btn btn-primary btn-azeer-bl w-100 fnt-12" >Reset</a>
								<div class="spacer-10"></div>
							</div>
						</div>
					</form>

				</div>
			</div>

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
							<th>Date</th>
							<th>Status</th>
							<th>Engineer</th>
							<th class="w-5">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php print $taskList;?>
					</tbody>
				</table>
			</div>

			<!--pagination-->
			<?php //print $pagination; ?>





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


<?php }?>
