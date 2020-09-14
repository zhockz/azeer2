
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

						<!---
						<?php if($result == "success"){?>
							<div class="progress">
								<div id="progressBar" class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
							</div>

							<div class="spacer-10"></div>
						<?php }?>
						-->
					<?php }?>

						<form action="" method="post">
							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<center>
												<img src="assets/imgs/icons/user-icon.png" class="icons"/>
											</center>
										</div>
									</div>
									<input type="email" name="username" class="form-control" placeholder="Username" required>
								</div>
							</div>

							<div class="spacer-10"></div>

							<div class="form-group">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<img src="assets/imgs/icons/lock-icon.png" class="icons"/>
										</div>
									</div>
									<input type="password" name="password" class="form-control" placeholder="Password" required>
								</div>
							</div>

							<div class="spacer-10"></div>

							<div class="form-group">

								<div class="row">
									<!--
									<div class="col-md-6">

										<div class="form-check">
											<input type="checkbox" name="rememberMe" class="form-check-input" checked>
											<label class="form-check-label">Remember me</label>
										</div>

									</div>

									<div class="spacer-10"></div>
									-->
									<div class="col-md-6">
										<a href="<?php print base_url();?>/reset-password" class="fnt-wht">
											<i class="far fa-envelope"></i>
											Forget password
										</a>
										<div class="spacer-10"></div>
									</div>
									<div class="col-md-6"></div>
								</div>

							</div>

							<input type="submit" name="loginSubmit" class="btn btn-primary btn-w-100 btn-azeer-bl" value="LOGIN">

						</form>
						<div class="spacer-40"></div>
					</div>

					<div class="col-lg-1"></div>
				</div>


			</div>
		</div>
	</div>


</section>
