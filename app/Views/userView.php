
<div class="spacer-40"></div>

<!--header-->
<section id="profile" class="">

  <div class="container">

    <div class="row">

      <?php include "common/header2.php";?>

      <div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
        <h2 class="title">Settings <small class="fnt-18">View Administrator</small></h2>
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

        <!-- Column 1 -->
        <div class="col-lg-2">
          <center>
            <?php if($user['img_profile'] == ''){?>

              <img src="<?php print base_url();?>/assets/imgs/default-user.jpg" class="img-fluid img-50"/>

            <?php }else{?>

              <img src="<?php print base_url();?>/assets/imgs/uploads/profile/<?php print $user['img_profile']; ?>" class="img-fluid img-50"/>

            <?php }?>
          </center>

          <label class="col-form-label">UID : <?php print $user['id']; ?></label>

          <div class="spacer-20"></div>
        </div>

        <!-- Column 2 -->
        <div class="col-lg-5">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Employee No. :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $user['emp_id']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Name :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $user['name']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $user['email']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Job Title :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $user['job_title']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $status; ?></p>
            </div>
          </div>
        </div>

        <!-- Column 3 -->
        <div class="col-lg-5">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Address :</label>
            <div class="col-sm-8">
                <p class="form-control-plaintext"><?php print $user['address']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Region :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $region; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">City :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $city; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Zipcode :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext"><?php print $user['zipcode']; ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Mobile No. :</label>
            <div class="col-sm-8">
              <p class="form-control-plaintext">+966 <?php print $user['mobile']; ?></p>
            </div>
          </div>
        </div>

      </div>

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
          <a href="<?php print base_url();?>/settings/users" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
            <!--<i class="fas fa-arrow-circle-left marRight-10"></i>-->Back
          </a>
          <div class="spacer-20"></div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
          <?php if(isset($_SESSION['roles']) && $_SESSION['roles'] <= 2){ ?>
            <a href="<?php print base_url();?>/settings/users/admin/edit?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
              <!--<i class="fas fa-edit marRight-10"></i>-->Edit
            </a>
          <div class="spacer-20"></div>
          <?php }?>
        </div>
      </div>
  </div>
  </section>

</form>
