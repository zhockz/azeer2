
<div class="spacer-40"></div>

<!--header-->
<section id="dashboard-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Customers <small class="fnt-18">View Equipments</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<form>

  <section>
    <div class="container fnt-18">

        <div class="row">

          <!--column 1-->
          <div class="col-lg-4">
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Type :</label>
              <div class="col-sm-7">
                <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $equip_type; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Name :</label>
              <div class="col-sm-7">
                  <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $equip_name; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Manufacturer :</label>
              <div class="col-sm-7">
                <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $manufacturer; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Serial No. :</label>
              <div class="col-sm-7">
                <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $serial_no; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Customer :</label>
              <div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $customer; ?>">
              </div>
            </div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">Status :</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $status; ?>">
							</div>
						</div>
          </div>

          <!--column 2-->
          <div class="col-lg-4">
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">Installation No.:</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $install_no; ?>">
							</div>
						</div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Location :</label>
              <div class="col-sm-7">
                <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $location; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Region :</label>
              <div class="col-sm-7">
                <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $region; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">City :</label>
              <div class="col-sm-7">
                <input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $city; ?>">
              </div>
            </div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">Warranty End :</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $warranty; ?>">
							</div>
						</div>
          </div>

          <!--column 3-->
          <div class="col-lg-4">
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">SC No. :</label>
							<div class="col-sm-7">
                <p class="fnt-10 remMar">Service Contract No. :</p>
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $sc_no; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">SC Start :</label>
							<div class="col-sm-7">
                <p class="fnt-10 remMar">Service Contract Start :</p>
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $sc_start; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">SC End :</label>
							<div class="col-sm-7">
                <p class="fnt-10 remMar">Service Contract End :</p>
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $sc_end; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">1st Visit :</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $visit_1; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-5 col-form-label">2nd Visit :</label>
							<div class="col-sm-7">
								<input type="text" readonly class="form-control-plaintext fnt-14" value="<?php print $visit_2; ?>">
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
				<div class="col-lg-4">
					<label>Equpment's History</label>
					<p>TOTAL: <?php print $count; ?></p>
				</div>
				<div class="col-lg-7 align-self-end"></div>
				<div class="col-lg-1 align-self-end"></div>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-sm">
					<thead class="text-center thead-dark">
						<tr>
							<th class="align-middle text-center">#</th>
							<th class="align-middle text-center">Order ID</th>
							<th class="align-middle text-center">Engineer</th>
							<th class="align-middle text-center">Issue</th>
							<th class="align-middle text-center">Service Type</th>
							<th class="align-middle text-center">Assessment</th>
							<th class="align-middle text-center">Action</th>
							<th class="w-10 align-middle text-cente">Date</th>
							<th class="align-middle text-center">Status</th>
							<th class="w-5 align-middle text-cente"></th>
						</tr>
					</thead>
					<tbody>
						<?php print $taskList;?>
					</tbody>
				</table>
			</div>

			<?php //print $pagination;?>
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
					<?php if($_SESSION['roles'] <= 2){?>
	          <a href="<?php print base_url();?>/customers/equipments/edit?id=<?php print $_GET['id']; ?>&equipId=<?php print $id; ?>" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
	            <!--<i class="fas fa-power-off marRight-10"></i>-->Edit
	          </a>
					<?php }?>
        </div>
  		</div>
  </div>
  </section>

</form>
