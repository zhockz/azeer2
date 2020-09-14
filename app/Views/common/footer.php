	<?php  $checkNotif = view_cell('\App\Controllers\CommonController::notifEquipDue'); ?>

		<!-- JavaScript -->
		<!-- Bootstrap JS -->
		<!--
		<script src="<?php print base_url();?>/assets/js/popper.min.js"></script>
		<script src="<?php print base_url();?>/assets/js/bootstrap.min.js"></script>
		-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="<?php print base_url();?>/assets/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php print base_url();?>/assets/js/tempusdominus-bootstrap-4.min.js"></script>

		<!-- Fontawesome JS -->
		<script src="https://kit.fontawesome.com/c169c568b6.js" crossorigin="anonymous"></script>

		<!-- Notify JS -->
		<script src="<?php print base_url();?>/assets/js/notify.min.js"></script>

		<?php if(isset($_SESSION['roles']) && $_SESSION['roles'] <= 3){?>
			<?php if($checkNotif > 0){ ?>

				<script>
					jQuery(document).ready(function(){
						$.notify.addStyle('foo', {
						  html:'<div class="card w-75"><div class="card-header"><div class="row"><div class="col-9 align-self-center"><h5>Equipments Notification</h5></div><div class="col-3 align-self-center"><i class="far fa-times-circle fnt-16 notif-close" onClick="closeNotify();"></i></div></div></div><div class="card-body"><center><i class="fas fa-exclamation-triangle notif-img"></i><div class="spacer-10"></div><p style="color:#656565;">Upcoming Visits: <?php print $checkNotif;?></p><div class="spacer-6"></div><a href="<?php print base_url();?>/customers/equipments/all" class="btn btn-warning btn-sm fnt-12 fnt-wht w-100">VIEW</a></center></div></div>',
						});
						$.notify({
						  title: '',
						  button: ''
						}, {
						  style: 'foo',
						  autoHide: false,
						  clickToHide: false,
							showAnimation: 'fadeIn',
		  				showDuration: 1000,
							hideAnimation: 'slideUp',
							hideDuration: 300,
						});
					});
					function closeNotify() {
					  $('.notifyjs-wrapper').trigger('notify-hide');
					}
				</script>
			<?php }?>
		<?php }?>

		<!-- Custom JS -->
		<script src="<?php print base_url();?>/assets/js/custom.js"></script>

	</body>
</html>
