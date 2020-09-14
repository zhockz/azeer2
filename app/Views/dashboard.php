
<div class="spacer-40"></div>

<!--header-->
<section id="dashboard-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">WELCOME <small class="fnt-18"><?php print $name;?>!</small></h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-40"></div>

<!--content-->
<!--navigation-->
<?php
	if($_SESSION['roles'] == 1 || $_SESSION['roles'] == 2){ include "common/dashnav-admin.php";}
	if($_SESSION['roles'] == 3){ include "common/dashnav-engineer.php";}
	if($_SESSION['roles'] == 4){ include "common/dashnav-customer.php";}
?>

<div class="spacer-80"></div>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<?php if($_SESSION['roles'] == 1 || $_SESSION['roles'] == 2){?>
					<a href="<?php print base_url();?>/settings" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
						<!--<i class="fas fa-power-off marRight-10"></i>-->Settings
					</a>
					<div class="spacer-20"></div>
				<?php }?>

				<a href="<?php print base_url();?>/logout" class="btn btn-primary btn-lg btn-w-100 btn-azeer-bl">
					<!--<i class="fas fa-power-off marRight-10"></i>-->Sign Out
				</a>
				<div class="spacer-20"></div>
			</div>
			<div class="col-lg-3"></div>
			<div class="col-lg-3"></div>
			<div class="col-lg-3"></div>
		</div>
</div>
</section>
