
<div class="spacer-40"></div>

<!--header-->
<section id="taskView" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
				<h2 class="title"><?php print $title_head; ?></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<?php if($_SESSION['roles'] <= 2){ ?>

	<form action="" method="post">
		<section class="fnt-16">
		  <div class="container">

				<!-- message -->
				<?php if($result != ""){?>
					<div class="alert alert-<?php print $result;?> fnt-12" role="alert">
						<?php print $message;?>
					</div>
				<?php }?>

					<!--Order Details-->
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Order No.:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $orderId; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Order Date:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $orderDate; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Status:</label>
								<div class="col-sm-8">
									<select name="status" class="form-control selectpicker" data-live-search="true">
										<?php print $taskStatus_option; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Engineer Name:</label>
								<div class="col-sm-8">
									<select name="eng_uid" class="form-control selectpicker" data-live-search="true">
										<?php print $eng_option;?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Service Schedule-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Service Date & Time:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Arrival Date</th>
									<th class="align-middle">Arrival Time</th>
									<th class="align-middle">Start Time</th>
									<th class="align-middle">End Time</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $arrival_date; ?>
									</td>
									<td class="text-center">
										<?php print $arrival_time; ?>
									</td>
									<td class="text-center">
										<?php print $start_time; ?>
									</td>
									<td class="text-center">
										<?php print $end_time; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Customer:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $customer; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contact:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $contact_name; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contractor:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $contact_name; ?>">
								</div>
							</div>
						</div>
					</div>

					<!--Equipment-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Equipment:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Type</th>
									<th class="align-middle">Model</th>
									<th class="align-middle">Serial No.</th>
									<th class="align-middle">Issue</th>
									<!--<th class="align-middle">Status</th>-->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $equip_type; ?>
									</td>
									<td class="text-center">
										<?php print $equip_name; ?>
									</td>
									<td class="text-center">
										<?php print $serial_no; ?>
									</td>
									<td class="text-center">
										<?php print $issue; ?>
									</td>
									<!--
									<td class="text-center">
										<?php print $equip_status; ?>
									</td>
									-->
								</tr>
							</tbody>
						</table>
					</div>

					<!--Sevice Type-->
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Service Type:</label>
								<div class="col-sm-8">
									<select name="sc_type" class="form-control selectpicker" data-live-search="true">
										<?php print $sc_option;?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Installation No.:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $install_no; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>

					<!--Manufacturer-->
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Manufacturer:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $manufacturer; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Image Before Repairing:</label>
								<center>
									<?php if($img_before == ''){?>
										<img id="before-img" src="<?php print base_url();?>/assets/imgs/default-noimg.png" class="img-fluid"/>
									<?php }else{?>
										<img id="before-img" src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_before; ?>" class="img-fluid" data-toggle="modal" data-target="#before-img-modal"/>
										<div id="before-img-modal" class="modal fade bd-example-modal-lg">
											<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Image Before Repairing</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body remPad">
														<img src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_before; ?>" class="img-fluid"/>
													</div>
												</div>
											</div>
										</div>
									<?php }?>
								</center>

							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Image After Repairing:</label>

								<center>
									<?php if($img_after == ''){?>
										<img id="after-img" src="<?php print base_url();?>/assets/imgs/default-noimg.png" class="img-fluid"/>
									<?php }else{?>
										<img id="after-img" src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_after; ?>" class="img-fluid" data-toggle="modal" data-target="#after-img-modal"/>
										<div id="after-img-modal" class="modal fade bd-example-modal-lg">
											<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Image After Repairing</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body remPad">
														<img src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_after; ?>" class="img-fluid"/>
													</div>
												</div>
											</div>
										</div>
									<?php }?>
								</center>
							</div>
						</div>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Notes-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Notes:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Troubleshoot</th>
									<th class="align-middle">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $assessment; ?>
									</td>
									<td class="text-center">
										<?php print $action; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Spare Parts-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Recommended/Replaced Spare Parts:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="w-5 align-middle">#</th>
									<th class="w-15 align-middle">Part Number</th>
									<th class="align-middle">Description</th>
									<th class="w-5 align-middle">Quantity</th>
								</tr>
							</thead>
							<tbody>
								<?php print $rows_parts; ?>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Test Tools-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Test Tools:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="w-5 align-middle">#</th>
									<th class="align-middle">Name</th>
									<th class="align-middle">Serial No.</th>
									<th class="w-10 align-middle">Calibration Due Date</th>
								</tr>
							</thead>
							<tbody>
								<?php print $rows_tools; ?>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Attachements-->
					<div class="form-group">
						<label class="col-form-label">Attachments:</label>
							<?php if($img_attach == ''){?>
								<input type="text" readonly class="form-control-plaintext" value="No Attachment yet...">
							<?php }else{?>
								<a href="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_attach; ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
							<?php }?>
					</div>
		  </div>
		</section>

		<div class="spacer-40"></div>

		<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 align-self-end">
					<a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Dashboard
					</a>
					<div class="spacer-20"></div>
					<a href="<?php print base_url();?>/<?php print $recentTaskPage; ?>" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Back
					</a>
				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3">
					<?php if($printPdfStatus == 1){?>
						<div class="spacer-20"></div>
						<a href="<?php print base_url();?>/print?order_id=<?php print $orderId;?>&pdf=1" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl" target="_new">
							Print
						</a>
					<?php }?>
						<div class="spacer-20"></div>
					<input name="updateTask" type="submit" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl" value="Save">
					</a>
				</div>
			</div>
		</div>
	</section>
	</form>

	<div class="spacer-40"></div>

<?php } ?>

<?php if($_SESSION['roles'] == 3){ ?>

	<form action="" method="post" enctype="multipart/form-data">
		<section class="fnt-16">
  		<div class="container">

				<!-- message -->
				<?php if($result != ""){?>
					<div class="alert alert-<?php print $result;?> fnt-12" role="alert">
						<?php print $message;?>
					</div>
				<?php }?>

				<?php if($eng_assigned_uid != $_SESSION['uid']) {?>
					<div class="alert alert-warning fnt-12" role="alert">
						This task was not assigned to you. You won't able to save any changes unless you change the Engineer field under your name.
					</div>
				<?php }?>

					<!--Order Details-->
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Order No.:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $orderId; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Order Date:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $orderDate; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Status:</label>
								<div class="col-sm-8">
									<select name="status" class="form-control selectpicker" data-live-search="true">
										<?php print $taskStatus_option; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Engineer Name:</label>
								<div class="col-sm-8">
									<select id="eng_uid" name="eng_uid" class="form-control selectpicker" data-live-search="true">
										<?php print $eng_option;?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Service Schedule-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Service Date & Time:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="row">
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Arrival Date:</label>
								<div class="input-group date dateOnly" id="arrival_date" data-target-input="nearest">
										<input name="arrival_date" type="text" class="form-control datetimepicker-input" data-target="#warrantyDate" value="<?php print $arrival_date; ?>"/>
										<div class="input-group-append" data-target="#arrival_date" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Arrival Time:</label>
								<div class="input-group date timeOnly" id="arrival_time" data-target-input="nearest">
										<input name="arrival_time" type="text" class="form-control datetimepicker-input" data-target="#arrival_time" value="<?php print $arrival_time; ?>"/>
										<div class="input-group-append" data-target="#arrival_time" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
										</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Start Time:</label>
								<div class="input-group date timeOnly" id="start_time" data-target-input="nearest">
										<input name="start_time" type="text" class="form-control datetimepicker-input" data-target="#start_time" value="<?php print $start_time; ?>"/>
										<div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
										</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">End Time:</label>
								<div class="input-group date timeOnly" id="end_time" data-target-input="nearest">
										<input name="end_time" type="text" class="form-control datetimepicker-input" data-target="#end_time" value="<?php print $end_time; ?>"/>
										<div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="far fa-clock"></i></div>
										</div>
								</div>
							</div>
						</div>
					</div>

					<div class="spacer-10"></div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Customer:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $customer; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contact:</label>
								<div class="col-sm-8">
									<input name="contact_name" type="text"  class="form-control" value="<?php print $contact_name; ?>" required>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contractor:</label>
								<div class="col-sm-8">
									<input name="contractor" type="text"  class="form-control" value="<?php print $contractor; ?>" required>
								</div>
							</div>
						</div>
					</div>

					<!--Equipment-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Equipment:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Type</th>
									<th class="align-middle">Model</th>
									<th class="align-middle">Serial No.</th>
									<th class="align-middle">Issue</th>
									<!--<th class="align-middle">Status</th>-->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $equip_type; ?>
									</td>
									<td class="text-center">
										<?php print $equip_name; ?>
									</td>
									<td class="text-center">
										<?php print $serial_no; ?>
									</td>
									<td class="text-center">
										<?php print $issue; ?>
									</td>
									<!--
									<td class="text-center">
										<?php print $equip_status; ?>
									</td>
								-->
								</tr>
							</tbody>
						</table>
					</div>

					<!--Sevice Type-->
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Service Type:</label>
								<div class="col-sm-8">
									<select name="sc_type" class="form-control selectpicker" data-live-search="true">
										<?php print $sc_option;?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Installation No.:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $install_no; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>

					<!--Manufacturer-->
					<div class="row">

						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Manufacturer:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $manufacturer; ?>">
								</div>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Image Before Repairing:</label>
								<center>
									<?php if($img_before == ''){?>
										<img id="before-img" src="<?php print base_url();?>/assets/imgs/default-noimg.png" class="img-fluid"/>
									<?php }else{?>
										<img id="before-img" src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_before; ?>" class="img-fluid" class="img-fluid" data-toggle="modal" data-target="#before-img-modal"/>
										<div id="before-img-modal" class="modal fade bd-example-modal-lg">
											<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Image Before Repairing</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body remPad">
														<img src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_before; ?>" class="img-fluid"/>
													</div>
												</div>
											</div>
										</div>
									<?php }?>

									<div class="spacer-10"></div>

									<button type="button" id="btnUploadImg_before" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12 img-50">
										<i class="fas fa-camera"></i>
										Upload Image
									</button>
									<div class="spacer-10"></div>
									<button type="button" id="btnDelete_before" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12 img-50">
										<i class="fas fa-trash-alt"></i>
										Delete Image
									</button>
									<div class="form-group hideThis">
										<div class="custom-file">
											<input type="file" name="img_before" class="custom-file-input" id="uploadImg_before">
											<input type="text" name="img_profile_before" class="form-control" disabled id="file_before">
										</div>
								 </div>
								</center>
							</div>
						</div>

						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Image After Repairing:</label>
								<center>
									<?php if($img_after == ''){?>
										<img id="after-img" src="<?php print base_url();?>/assets/imgs/default-noimg.png" class="img-fluid"/>
									<?php }else{?>

										<img id="after-img" src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_after; ?>" class="img-fluid" data-toggle="modal" data-target="#after-img-modal"/>
										<div id="after-img-modal" class="modal fade bd-example-modal-lg">
											<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Image After Repairing</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body remPad">
														<img src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_after; ?>" class="img-fluid"/>
													</div>
												</div>
											</div>
										</div>

									<?php }?>

									<div class="spacer-10"></div>

									<button type="button" id="btnUploadImg_after" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12 img-50">
										<i class="fas fa-camera"></i>
										Upload Image
									</button>
									<div class="spacer-10"></div>
									<button type="button" id="btnDelete_after" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12 img-50">
										<i class="fas fa-trash-alt"></i>
										Delete Image
									</button>
									<div class="form-group hideThis">
										<div class="custom-file">
											<input type="file" name="img_after" class="custom-file-input" id="uploadImg_after">
											<input type="text" name="img_profile_after" class="form-control" disabled id="file_after">
										</div>
								 </div>
								</center>
							</div>
						</div>

					</div>

					<div class="spacer-10"></div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Notes-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Notes:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<label class="col-form-label">Troubleshoot:</label>
							<textarea name="assessment" class="form-control" rows="3"><?php print $assessment; ?></textarea>
						</div>
						<div class="col-lg-6">
							<label class="col-form-label">Actions:</label>
							<textarea name="action" class="form-control" rows="3"><?php print $action; ?></textarea>
						</div>
					</div>

					<div class="spacer-10"></div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Spare Parts-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Recommended / Replaced Spare Parts:</label>
						</div>
						<div class="col-lg-8 text-right">

						</div>
					</div>

					<div id="sp-container">
						<div class="spare-parts">
							<div class="row">
								<div class="col-lg-4">
									<label class="col-form-label">Part Number:</label>
									<input id="part_number" type="text" class="form-control" value="">
								</div>
								<div class="col-lg-4">
									<label class="col-form-label">Description:</label>
									<textarea id="description" class="form-control" rows="1	"></textarea>
								</div>
								<div class="col-lg-2">
									<label class="col-form-label">QTY:</label>
									<input id="qty" type="number" class="form-control" value="">
								</div>
								<div class="col-lg-2 d-flex align-items-end">
									<button id="addParts" type="button" class="btn btn-primary fnt-12 w-100"><i class="fas fa-plus"></i> Add Parts</button>
								</div>
							</div>
							<div class="spacer-10"></div>
						</div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="w-5 align-middle">#</th>
									<th class="w-15 align-middle">Part Number</th>
									<th class="align-middle">Description</th>
									<th class="w-5 align-middle">Quantity</th>
									<th class="align-middle w-5">Action</th>
								</tr>
							</thead>
							<tbody id="partsList">
								<?php print $rows_parts; ?>
							</tbody>
						</table>
					</div>

					<div class="spacer-10"></div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Test Tools-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Test Tools:</label>
						</div>
						<div class="col-lg-8 text-right">

						</div>
					</div>

					<div id="tt-container">
						<div class="test-tools">
							<div class="row">
								<div class="col-lg-4">
									<label class="col-form-label">Name:</label>
									<input id="name" type="text" class="form-control" value="">
								</div>
								<div class="col-lg-4">
									<label class="col-form-label">Serial No.:</label>
									<input id="serial_tools" type="text" class="form-control" value="">
								</div>
								<div class="col-lg-2">
									<label class="col-form-label">Calibration Date:</label>
									<div class="input-group date dateOnly calib_date" data-target-input="nearest">
											<input id="calib_date" type="text" class="form-control datetimepicker-input" data-target=".calib_date" value=""/>
											<div class="input-group-append" data-target=".calib_date" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
									</div>
								</div>
								<div class="col-lg-2 d-flex align-items-end">
									<button id="addTools" type="button" class="btn btn-primary fnt-12 w-100"><i class="fas fa-plus"></i> Add Tools</button>
								</div>
							</div>
							<div class="spacer-10"></div>
						</div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="w-5 align-middle">#</th>
									<th class="align-middle">Name</th>
									<th class="align-middle">Serial No.</th>
									<th class="w-10 align-middle">Calibration Due Date</th>
									<th class="align-middle w-5">Action</th>
								</tr>
							</thead>
							<tbody id="toolsList">
								<?php print $rows_tools; ?>
							</tbody>
						</table>
					</div>


					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Attachements-->
					<div class="form-group">
						<label class="col-form-label">Attachments:</label>
						<?php if($img_attach == ''){?>
							<input type="text" readonly class="form-control-plaintext" value="No Attachment yet...">
						<?php }else{?>
							<a href="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_attach; ?>" class="btn btn-primary" target="_new"><i class="fas fa-eye"></i></a>
							<div class="spacer-10"></div>
						<?php }?>

						<button type="button" id="btnUploadImg_attach" class="btn btn-md btn-primary btn-w-20 btn-azeer-bl fnt-12">
							<i class="fas fa-upload"></i>
							Upload Attachment
						</button>
						<div class="form-group hideThis">
							<div class="custom-file">
								<input type="file" name="img_attach" class="custom-file-input" id="uploadImg_attach">
								<input type="text" name="img_profile_attach" class="form-control" disabled id="file_attach">
							</div>
					 </div>
					</div>
		  </div>
		</section>

		<div class="spacer-40"></div>

		<section>
		<div class="container">

			<div class="row">
				<div class="col-lg-3 align-self-end">
					<a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Dashboard
					</a>
					<div class="spacer-20"></div>
					<a href="<?php print base_url();?>/<?php print $recentTaskPage; ?>" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Back
					</a>
				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3">
					<?php if($printPdfStatus == 1){?>
						<div class="spacer-20"></div>
						<a href="<?php print base_url();?>/print?order_id=<?php print $orderId;?>&pdf=1" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl" target="_new">
							Print
						</a>
					<?php }?>

					<?php

						$disableSave = 'disabled';
						if($_SESSION['roles'] == 3){
							if($eng_assigned_uid == $_SESSION['uid']) {
								$disableSave = '';
							}
						}

					?>
					<div class="spacer-20"></div>
					<input id="updateTask" name="updateTask" type="submit" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl" value="Save" <?php print $disableSave; ?>/>
					</a>
				</div>
			</div>
		</div>
	</section>
	</form>

	<div class="spacer-40"></div>

	<script>
		jQuery(document).ready(function(){

			<?php if($eng_assigned_uid != $_SESSION['uid']) {?>

				jQuery("#eng_uid").on("change", function(){
					var getEngId = jQuery(this).val();
					if(getEngId == <?php print $_SESSION['uid'];?>){
						jQuery("#updateTask").removeAttr("disabled");
					}
				});

			<?php }?>

			jQuery("#addParts").on("click touch", function(){
				var getPartNumber = jQuery('#part_number').val();
				var getDesc = jQuery('#description').val();
				var getQty = jQuery('#qty').val();

				if(getPartNumber != '' && getDesc != '' && getQty != ''){
					$.ajax({
							type: 'POST',
							url: "<?php print base_url();?>/ajax",
							headers: {'X-Requested-With': 'XMLHttpRequest'},
							data:{
								order_id:"<?php print $_GET['order_id']; ?>",
								part_number:getPartNumber,
								description:getDesc,
								qty:getQty,
								action:'addParts'
							},
							success: function(data){
								if(data != 0){
									jQuery("#partsList").html('');
									jQuery("#partsList").html(data);
									jQuery('#part_number').val('');
									jQuery('#description').val('');
									jQuery('#qty').val('');
								}
							}
					});
				}

			});

			jQuery("#addTools").on("click touch", function(){
				var getName = jQuery('#name').val();
				var getSerialTools = jQuery('#serial_tools').val();
				var getCalibDate = jQuery('#calib_date').val();

				if(getName != '' && getSerialTools != '' && getCalibDate != ''){
					$.ajax({
							type: 'POST',
							url: "<?php print base_url();?>/ajax",
							headers: {'X-Requested-With': 'XMLHttpRequest'},
							data:{
								order_id:"<?php print $_GET['order_id']; ?>",
								name:getName,
								serial_tools:getSerialTools,
								calib_date:getCalibDate,
								action:'addTools'
							},
							success: function(data){
								if(data != 0){
									jQuery("#toolsList").html('');
									jQuery("#toolsList").html(data);
									jQuery('#name').val('');
									jQuery('#serial_tools').val('');
									jQuery('#calib_date').val('');
								}
							}
					});
				}

			});

			jQuery("#btnDelete_before").on("click touch", function(){
				$.ajax({
						type: 'POST',
						url: "<?php print base_url();?>/ajax",
						headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							order_id:"<?php print $_GET['order_id']; ?>",
							name:"img_before",
							action:'delimg'
						},
						success: function(data){
							if(data == 1){
								jQuery("#before-img").attr("src","<?php print base_url();?>/assets/imgs/default-noimg.png");
							}
						}
				});
			});

			jQuery("#btnDelete_after").on("click touch", function(){
				$.ajax({
						type: 'POST',
						url: "<?php print base_url();?>/ajax",
						headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							order_id:"<?php print $_GET['order_id']; ?>",
							name:"img_after",
							action:'delimg'
						},
						success: function(data){
							if(data == 1){
								jQuery("#after-img").attr("src","<?php print base_url();?>/assets/imgs/default-noimg.png");
							}
						}
				});
			});

		});

		function delParts(elem){
			var r = confirm("Do you really wants to delete a spare part?");
			if (r == true) {
				$.ajax({
						type: 'POST',
						url: "<?php print base_url();?>/ajax",
						headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							order_id:"<?php print $_GET['order_id']; ?>",
							partsId:elem,
							action:'delParts'
						},
						success: function(data){
							if(data != 0){
								jQuery("#partsList").html('');
								jQuery("#partsList").html(data);
							}else{
								jQuery("#partsList").html('');
							}
						}
				});
			}
		}

		function delTools(elem){
			var r = confirm("Do you really wants to delete a tool?");
			if (r == true) {
				$.ajax({
						type: 'POST',
						url: "<?php print base_url();?>/ajax",
						headers: {'X-Requested-With': 'XMLHttpRequest'},
						data:{
							order_id:"<?php print $_GET['order_id']; ?>",
							toolsId:elem,
							action:'delTools'
						},
						success: function(data){
							if(data != 0){
								jQuery("#toolsList").html('');
								jQuery("#toolsList").html(data);
							}else{
								jQuery("#toolsList").html('');
							}
						}
				});
			}
		}

	</script>

<?php } ?>

<?php if($_SESSION['roles'] == 4){ ?>
	<form action="">
		<section class="fnt-16">
		  <div class="container">

				<!-- message -->
				<?php if($result != ""){?>
					<div class="alert alert-<?php print $result;?> fnt-12" role="alert">
						<?php print $message;?>
					</div>
				<?php }?>

					<!--Order Details-->
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Order No.:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $orderId; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Order Date:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $orderDate; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Status:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $taskStatusName;?>">
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Engineer Name:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $engName;?>">
								</div>
							</div>
						</div>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Service Schedule-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Service Date & Time:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Arrival Date</th>
									<th class="align-middle">Arrival Time</th>
									<th class="align-middle">Start Time</th>
									<th class="align-middle">End Time</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $arrival_date; ?>
									</td>
									<td class="text-center">
										<?php print $arrival_time; ?>
									</td>
									<td class="text-center">
										<?php print $start_time; ?>
									</td>
									<td class="text-center">
										<?php print $end_time; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Customer:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $customer; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contact:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $contact_name; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Contractor:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $contact_name; ?>">
								</div>
							</div>
						</div>
					</div>

					<!--Equipment-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Equipment:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Type</th>
									<th class="align-middle">Model</th>
									<th class="align-middle">Serial No.</th>
									<th class="align-middle">Issue</th>
									<!--<th class="align-middle">Status</th>-->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $equip_type; ?>
									</td>
									<td class="text-center">
										<?php print $equip_name; ?>
									</td>
									<td class="text-center">
										<?php print $serial_no; ?>
									</td>
									<td class="text-center">
										<?php print $issue; ?>
									</td>
									<!--
									<td class="text-center">
										<?php print $equip_status; ?>
									</td>
									-->
								</tr>
							</tbody>
						</table>
					</div>

					<!--Sevice Type-->
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Service Type:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $scName;?>">
								</div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Installation No.:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $install_no; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-2"></div>
					</div>

					<!--Manufacturer-->
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Manufacturer:</label>
								<div class="col-sm-8">
									<input type="text" readonly class="form-control-plaintext" value="<?php print $manufacturer; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Image Before Repairing:</label>
								<center>
									<?php if($img_before == ''){?>
										<img id="before-img" src="<?php print base_url();?>/assets/imgs/default-noimg.png" class="img-fluid"/>
									<?php }else{?>
										<img id="before-img" src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_before; ?>" class="img-fluid" data-toggle="modal" data-target="#before-img-modal"/>
										<div id="before-img-modal" class="modal fade bd-example-modal-lg">
											<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Image Before Repairing</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body remPad">
														<img src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_before; ?>" class="img-fluid"/>
													</div>
												</div>
											</div>
										</div>
									<?php }?>
								</center>

							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label class="col-form-label">Image After Repairing:</label>

								<center>
									<?php if($img_after == ''){?>
										<img id="after-img" src="<?php print base_url();?>/assets/imgs/default-noimg.png" class="img-fluid"/>
									<?php }else{?>
										<img id="after-img" src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_after; ?>" class="img-fluid" data-toggle="modal" data-target="#after-img-modal"/>
										<div id="after-img-modal" class="modal fade bd-example-modal-lg">
											<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Image After Repairing</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body remPad">
														<img src="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_after; ?>" class="img-fluid"/>
													</div>
												</div>
											</div>
										</div>
									<?php }?>
								</center>
							</div>
						</div>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Notes-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Notes:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="align-middle">Troubleshoot</th>
									<th class="align-middle">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-center">
										<?php print $assessment; ?>
									</td>
									<td class="text-center">
										<?php print $action; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Spare Parts-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Recommended/Replaced Spare Parts:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="w-5 align-middle">#</th>
									<th class="w-15 align-middle">Part Number</th>
									<th class="align-middle">Description</th>
									<th class="w-5 align-middle">Quantity</th>
								</tr>
							</thead>
							<tbody>
								<?php print $rows_parts; ?>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Test Tools-->
					<div class="row">
						<div class="col-lg-4">
							<label class="col-form-label">Test Tools:</label>
						</div>
						<div class="col-lg-8"></div>
					</div>

					<div class="table-responsive fnt-12">
						<table class="table table-striped table-bordered table-hover table-sm">
							<thead class="text-center thead-dark">
								<tr>
									<th class="w-5 align-middle">#</th>
									<th class="align-middle">Name</th>
									<th class="align-middle">Serial No.</th>
									<th class="w-10 align-middle">Calibration Due Date</th>
								</tr>
							</thead>
							<tbody>
								<?php print $rows_tools; ?>
							</tbody>
						</table>
					</div>

					<div class="">
						<hr style="border-color:white;"></hr>
					</div>

					<!--Attachements-->
					<div class="form-group">
						<label class="col-form-label">Attachments:</label>
							<?php if($img_attach == ''){?>
								<input type="text" readonly class="form-control-plaintext" value="No Attachment yet...">
							<?php }else{?>
								<a href="<?php print base_url();?>/assets/imgs/uploads/attachment/<?php print $img_attach; ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
							<?php }?>
					</div>
		  </div>
		</section>

		<div class="spacer-40"></div>

		<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 align-self-end">
					<a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Dashboard
					</a>
					<div class="spacer-20"></div>
					<a href="<?php print base_url();?>/<?php print $recentTaskPage; ?>" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Back
					</a>
				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3"></div>
				<div class="col-lg-3">
					<?php if($printPdfStatus == 1){?>
						<div class="spacer-20"></div>
						<a href="<?php print base_url();?>/print?order_id=<?php print $orderId;?>&pdf=1" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl" target="_new">
							Print
						</a>
					<?php }?>
				</div>
			</div>
		</div>
	</section>
	</form>

	<div class="spacer-40"></div>

<?php } ?>
