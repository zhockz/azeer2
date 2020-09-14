


	<section id="login" class="h-100">
	<div class="container h-100">
		<div class="row h-100">
			<div class="col-lg-5 align-self-center fnt-wht">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<center><img src="assets/imgs/azeer-logo-big.png" class="img-fluid img-50"/></center>
					</div>
					<div class="col-lg-1"></div>
				</div>
			</div>

			<div class="col-lg-2 d-none d-lg-block">
				<div class="vl"></div>
			</div>

			<div class="col-lg-5 align-self-center fnt-wht">
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-4">
						<center><img src="assets/imgs/azeer-users.png" class="img-fluid img-50"/></center>
					</div>
					<div class="col-lg-4"></div>
				</div>

				<div class="spacer-20"></div>

				<div class="row">

					<div class="col-lg-1"></div>

					<div class="col-lg-10">

					<?php if(isset($result)){?>
						<div class="alert alert-<?php print $result;?>" role="alert">
							<ul>
								<?php foreach($message as $row){ ?>
								<li><?php print $row;?></li>
								<?php }?>
							</ul>
						</div>

					<?php }?>

						<?php if($login == true){?>

							<form action="" method="POST">
								<div class="form-group">
									<div class="input-group mb-2">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<center>
													<img src="assets/imgs/icons/lock-icon.png" class="icons"/>
												</center>
											</div>
										</div>
										<input name="newPassword" type="password" class="form-control" placeholder="New Password" required>
									</div>
								</div>

								<div class="spacer-10"></div>

								<div class="row">
									<div class="col-lg-6">
										<input name="submitNewPassword" type="submit" class="btn btn-primary btn-w-100" value="SUBMIT"/>

										<div class="spacer-10"></div>
									</div>

									<div class="col-lg-6">
										<a href="<?php print base_url();?>" class="btn btn-primary btn-w-100 btn-azeer-bl">
										CANCEL</a>
									</div>
								</div>

							</form>

						<?php }else{ ?>

							<form action="" method="POST">
								<div class="form-group">
									<div class="input-group mb-2">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<center>
													<i class="far fa-envelope"></i>
												</center>
											</div>
										</div>
										<input name="email" type="email" class="form-control" placeholder="Email" required>
									</div>
								</div>

								<div class="spacer-10"></div>

								<div class="row">
									<div class="col-lg-6">
										<input name="submit" type="submit" class="btn btn-primary btn-w-100 btn-azeer-bl" value="SUBMIT"/>

										<div class="spacer-10"></div>
									</div>

									<div class="col-lg-6">
										<a href="<?php print base_url();?>" class="btn btn-primary btn-w-100 btn-azeer-bl">
										CANCEL</a>
									</div>
								</div>

							</form>

						<?php } ?>
						<div class="spacer-40"></div>
					</div>

					<div class="col-lg-1"></div>
				</div>


			</div>
		</div>
	</div>


</section>
