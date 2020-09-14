
<div class="spacer-40"></div>

<!--header-->
<section id="unathorized-<?php print $_SESSION['roles'];?>" class="">

	<div class="container">

	<div class="row">

		<?php include "common/header2.php";?>

	</div>

	</div>

</section>

<div class="spacer-40"></div>

<!--content-->

<section>

    <div class="container">

      <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
          <div class="jumbotron">
            <h1 class="display-4">Error 401 | Unathorized Access!</h1>
            <p class="lead">Your are not allowed to access the previous page. Please go back to your dashboard or try to login again.</p>

          </div>

        </div>
        <div class="col-lg-1"></div>

      </div>

    </div>


</section>
