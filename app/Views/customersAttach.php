
<div class="spacer-40"></div>

<!--header-->
<section id="dashboard-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Customers <small class="fnt-18">Attachments</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-20"></div>

<!--content-->
<section>
	<div class="container">

			<section>
			  <div class="container">
					<form  action="" method="post" enctype="multipart/form-data">
				    <div class="row">
				      <div class="col-lg-9">
				        <label>List of Attachments</label>
				        <p>TOTAL: <?php print $attachCount; ?></p>
				      </div>

					      <div class="col-lg-3">
									<?php if($_SESSION['roles'] <= 2){ ?>
										<div class="input-group mb-2 mr-sm-2 d-flex justify-content-end">
											<button type="button" id="btnUpload" class="btn btn-md btn-primary fnt-12">
						            <i class="fas fa-paperclip"></i>
						            Upload Attachments
						          </button>
											<div class="input-group-append">
												<button type="button" id="btn-submit" class="btn btn-md btn-info fnt-12">
													<i class="fas fa-upload"></i>
												</button>
												<input id="uploadAttach" type="submit" name="fileUpload" class="hideThis"/>
											</div>
										</div>

					          <div class="form-group ">
					            <div class="custom-file">
					              <input type="file" name="upload[]" class="custom-file-input" id="uploadFiles" multiple required/>
					              <!--<input type="text" name="img_profile" class="form-control" disabled id="file">-->
					            </div>
					         	</div>
								 	<?php }?>
					      </div>

				    </div>
					</form>
			    <div class="table-responsive">
			      <table class="table table-striped table-bordered table-hover table-sm">
			        <thead class="text-center thead-dark">
			          <tr>
			            <th>#</th>
			            <th>Old Name</th>
									<th>New Name</th>
			            <th>Type</th>
			            <th class="w-20">Uploaded Date</th>
			            <th class="w-10">Action</th>
			          </tr>
			        </thead>
			        <tbody>
			          <?php print $attachList; ?>
			        </tbody>
			      </table>
			    </div>

					<!--pagination-->
					<?php print $pagination; ?>

			  </div>
			</section>


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
				<a href="<?php print base_url();?>/customers/view?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
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
		jQuery('.btn-delete').each(function(){
			jQuery(this).on("click touch",function(){
				var dataHref = jQuery(this).attr("data-href");
				var confirmThis = confirm("Are you sure you want to delete?");

				if(confirmThis == true){
					location.replace(dataHref);
				}

			});
		});
	});
</script>
