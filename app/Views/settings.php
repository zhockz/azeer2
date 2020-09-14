
<div class="spacer-40"></div>

<!--header-->
<section id="settings-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

		<div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
			<h2 class="title">Settings</h2>
		</div>
		<div class="col-lg-2"></div>
	</div>

	</div>

</section>

<div class="spacer-40"></div>

<!--content-->
<!--navigation-->
<?php
	include "common/dashnav-settings.php";
?>

<div class="spacer-80"></div>

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
