<?php

  $readyOnly = "";
  if(isset($_SESSION['roles']) && $_SESSION['roles'] > 2){
    $readyOnly = "readonly disabled";
  }
?>

<div class="spacer-40"></div>

<!--header-->
<section id="edit-profile" class="">

  <div class="container">

    <div class="row">

      <?php include "common/header2.php";?>

      <div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
        <h2 class="title">PROFILE <small class="fnt-18">EDIT INFORMATION</small></h2>
      </div>
      <div class="col-lg-2"></div>

    </div>

  </div>

</section>

<div class="spacer-20"></div>

<!-- content -->
<?php if(isset($_SESSION['roles']) && $_SESSION['roles'] != ""){?>

  <?php if($_SESSION['roles'] == 1){?>
    <form action="" method="post" enctype="multipart/form-data">
      <section>
        <div class="container fnt-18">
          <?php if(!empty($responce)){?>
            <!--message-->
            <?php foreach ($responce as $row) { ?>
                <div class="alert alert-<?php print $row['result']; ?> fnt-12" role="alert">
                  <?php print $row['message']; ?>
                </div>
            <?php } ?>
          <?php }?>

          <div class="row">

            <!-- Column 1 -->
            <div class="col-lg-2">
              <center>
                <?php if($user['img_profile'] == ''){?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/default-user.jpg" class="img-fluid img-50"/>
                <?php }else{?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/uploads/profile/<?php print $user['img_profile']; ?>" class="img-fluid img-50"/>
                <?php }?>
              </center>

              <label class="col-form-label">UID : <?php print $user['id']; ?></label>

              <div class="spacer-10"></div>

              <button type="button" id="btnUploadImg" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12">
                <i class="fas fa-camera"></i>
                Upload Image
              </button>

              <div class="form-group hideThis">
                <div class="custom-file">
                  <input type="file" name="img" class="custom-file-input" id="uploadImg" accept="image/*">
                  <input type="text" name="img_profile" class="form-control" disabled id="file">
                </div>
             </div>

              <div class="spacer-10"></div>

             <button type="button" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12" data-toggle="modal" data-target="#changePassword">
               <i class="fas fa-unlock-alt"></i>
               Change Password
             </button>
              <div class="spacer-20"></div>
            </div>

            <!-- Column 2 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Name :</label>
                <div class="col-sm-8">
                  <input name="name" type="text" class="form-control" value="<?php print $user['name']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Email :</label>
                <div class="col-sm-8">
                  <input name="email" type="text" class="form-control" value="<?php print $user['email']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Role :</label>
                <div class="col-sm-8 fnt-12">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $roles; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Job Title :</label>
                <div class="col-sm-8">
                  <input name="job_title" type="text" class="form-control" value="<?php print $user['job_title']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Status :</label>
                <div class="col-sm-8">

                  <?php if(isset($_SESSION['roles']) && $_SESSION['roles'] > 2){ ?>
                      <input type="text" readonly class="form-control-plaintext fnt-12" value="<?php print $status; ?>">
                  <?php }else{ ?>
                    <select name="status" class="form-control selectpicker show-tick" data-live-search="true">
                      <?php print $option_status; ?>
                    </select>
                  <?php }?>


                </div>
              </div>

            </div>

            <!-- Column 3 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Address :</label>
                <div class="col-sm-8">
                  <input name="address" type="text" class="form-control" value="<?php print $user['address']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Region :</label>
                <div class="col-sm-8">
                  <select name="region" class="form-control selectpicker show-tick" data-live-search="true" required>
                    <?php print $option_region; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">City :</label>
                <div class="col-sm-8">
                  <select name="city" class="form-control selectpicker show-tick" data-live-search="true" required>
                    <?php print $option_city; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Zipcode :</label>
                <div class="col-sm-8">
                  <input name="zipcode" type="text" class="form-control" value="<?php print $user['zipcode']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Mobile No. :</label>
                <div class="col-sm-8">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text fnt-12">+966</div>
                    </div>
                    <input name="mobile" type="text" class="form-control" value="<?php print $user['mobile']; ?>" required>
                  </div>
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
              <a href="<?php print base_url();?>/profile" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
                Back
              </a>
              <div class="spacer-20"></div>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3 align-self-end">
              <input type="submit" name="updateProfile" class="btn btn-primary btn-lg btn-block btn-azeer-bl" value="Save">
              <div class="spacer-20"></div>
            </div>
          </div>
      </div>
      </section>

    </form>
  <?php } ?>

  <?php if($_SESSION['roles'] == 2){?>
    <form action="" method="post" enctype="multipart/form-data">
      <section>
        <div class="container fnt-18">
          <?php if(!empty($responce)){?>
            <!--message-->
            <?php foreach ($responce as $row) { ?>
                <div class="alert alert-<?php print $row['result']; ?> fnt-12" role="alert">
                  <?php print $row['message']; ?>
                </div>
            <?php } ?>
          <?php }?>

          <div class="row">

            <!-- Column 1 -->
            <div class="col-lg-2">
              <center>
                <?php if($user['img_profile'] == ''){?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/default-user.jpg" class="img-fluid img-50"/>
                <?php }else{?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/uploads/profile/<?php print $user['img_profile']; ?>" class="img-fluid img-50"/>
                <?php }?>
              </center>

              <label class="col-form-label">UID : <?php print $user['id']; ?></label>

              <div class="spacer-10"></div>

              <button type="button" id="btnUploadImg" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12">
                <i class="fas fa-camera"></i>
                Upload Image
              </button>

              <div class="form-group hideThis">
                <div class="custom-file">
                  <input type="file" name="img" class="custom-file-input" id="uploadImg" accept="image/*">
                  <input type="text" name="img_profile" class="form-control" disabled id="file">
                </div>
             </div>

              <div class="spacer-10"></div>

             <button type="button" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12" data-toggle="modal" data-target="#changePassword">
               <i class="fas fa-unlock-alt"></i>
               Change Password
             </button>
              <div class="spacer-20"></div>
            </div>

            <!-- Column 2 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Employee No. :</label>
                <div class="col-sm-8">
                  <input name="emp_id" type="text" class="form-control" value="<?php print $user['emp_id']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Name :</label>
                <div class="col-sm-8">
                  <input name="name" type="text" class="form-control" value="<?php print $user['name']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Email :</label>
                <div class="col-sm-8">
                  <input name="email" type="text" class="form-control" value="<?php print $user['email']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Role :</label>
                <div class="col-sm-8 fnt-12">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $roles; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Job Title :</label>
                <div class="col-sm-8">
                  <input name="job_title" type="text" class="form-control" value="<?php print $user['job_title']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Status :</label>
                <div class="col-sm-8">

                  <?php if(isset($_SESSION['roles']) && $_SESSION['roles'] > 2){ ?>
                      <input type="text" readonly class="form-control-plaintext fnt-12" value="<?php print $status; ?>">
                  <?php }else{ ?>
                    <select name="status" class="form-control selectpicker show-tick" data-live-search="true">
                      <?php print $option_status; ?>
                    </select>
                  <?php }?>

                </div>
              </div>
            </div>

            <!-- Column 3 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Address :</label>
                <div class="col-sm-8">
                  <input name="address" type="text" class="form-control" value="<?php print $user['address']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Region :</label>
                <div class="col-sm-8">
                  <select name="region" class="form-control selectpicker show-tick" data-live-search="true" required>
                    <?php print $option_region; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">City :</label>
                <div class="col-sm-8">
                  <select name="city" class="form-control selectpicker show-tick" data-live-search="true" required>
                    <?php print $option_city; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Zipcode :</label>
                <div class="col-sm-8">
                  <input name="zipcode" type="text" class="form-control" value="<?php print $user['zipcode']; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Mobile No. :</label>
                <div class="col-sm-8">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text fnt-12">+966</div>
                    </div>
                    <input name="mobile" type="text" class="form-control" value="<?php print $user['mobile']; ?>" required>
                  </div>
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
              <a href="<?php print base_url();?>/profile" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
                Back
              </a>
              <div class="spacer-20"></div>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3">
              <input type="submit" name="updateProfile" class="btn btn-primary btn-lg btn-block btn-azeer-bl" value="Save">
              <div class="spacer-20"></div>
            </div>
          </div>
      </div>
      </section>

    </form>
  <?php } ?>

  <?php if($_SESSION['roles'] == 3){?>
    <form action="" method="post" enctype="multipart/form-data">
      <section>
        <div class="container fnt-18">
          <?php if(!empty($responce)){?>
            <!--message-->
            <?php foreach ($responce as $row) { ?>
                <div class="alert alert-<?php print $row['result']; ?> fnt-12" role="alert">
                  <?php print $row['message']; ?>
                </div>
            <?php } ?>
          <?php }?>

          <div class="row">

            <!-- Column 1 -->
            <div class="col-lg-2">
              <center>
                <?php if($user['img_profile'] == ''){?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/default-user.jpg" class="img-fluid img-50"/>
                <?php }else{?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/uploads/profile/<?php print $user['img_profile']; ?>" class="img-fluid img-50"/>
                <?php }?>
              </center>

              <div class="spacer-10"></div>

              <button type="button" id="btnUploadImg" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12">
                <i class="fas fa-camera"></i>
                Upload Image
              </button>

              <div class="form-group hideThis">
                <div class="custom-file">
                  <input type="file" name="img" class="custom-file-input" id="uploadImg" accept="image/*">
                  <input type="text" name="img_profile" class="form-control" disabled id="file">
                </div>
             </div>

              <div class="spacer-10"></div>

             <button type="button" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12" data-toggle="modal" data-target="#changePassword">
               <i class="fas fa-unlock-alt"></i>
               Change Password
             </button>
              <div class="spacer-20"></div>
            </div>

            <!-- Column 2 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Employee No. :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext fnt-12" value="<?php print $user['emp_id']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Name :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['name']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Email :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['email']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Role :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $roles; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Job Title :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['job_title']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Status :</label>
                <div class="col-sm-8">
                  <select name="status" class="form-control selectpicker show-tick" data-live-search="true">
                    <?php print $option_status; ?>
                  </select>
                </div>
              </div>
            </div>

            <!-- Column 3 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Address :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['address']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Region :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $region; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">City :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $city; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Zipcode :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['zipcode']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Mobile No. :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['mobile']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Customer :</label>
                <div class="col-sm-8">
                  <p class="form-control-plaintext"><?php print $cus_name; ?></p>
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
              <a href="<?php print base_url();?>/profile" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
                Back
              </a>
              <div class="spacer-20"></div>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3">
              <input type="submit" name="updateProfile" class="btn btn-primary btn-lg btn-block btn-azeer-bl" value="Save">
              <div class="spacer-20"></div>
            </div>
          </div>
      </div>
      </section>

    </form>
  <?php } ?>

  <?php if($_SESSION['roles'] == 4){?>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <label class="remMar">List of Staff in Charge</label>
            <p class="remMar">TOTAL: <?php print $UserCount; ?></p>
          </div>
          <div class="col-lg-6">
            <p class="remMar">To add more "Staff in Charge" or changes in "Profile Information", please call our Support Team</p>
            <p class=""><i class="fas fa-phone-square-alt"></i> +966 (02) 123 4567</p>
            <!--
            <a href="" class="btn btn-primary btn-md w-100 fnt-12">
              <i class="fas fa-users"></i> Add Staffs
            </a>
            -->
            <div class="spacer-10"></div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover table-sm">
            <thead class="text-center thead-dark">
              <tr>
                <th class="w-5">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Job Title</th>
              </tr>
            </thead>
            <tbody>
              <?php print $userList;?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <div class="spacer-20"></div>

    <form action="" method="post" enctype="multipart/form-data">
      <section>
        <div class="container fnt-18">
          <?php if(!empty($responce)){?>
            <!--message-->
            <?php foreach ($responce as $row) { ?>
                <div class="alert alert-<?php print $row['result']; ?> fnt-12" role="alert">
                  <?php print $row['message']; ?>
                </div>
            <?php } ?>
          <?php }?>

          <div class="row">

            <!-- Column 1 -->
            <div class="col-lg-2">
              <center>
                <?php if($user['img_profile'] == ''){?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/default-logo.jpg" class="img-fluid img-50"/>
                <?php }else{?>
                  <img id="preview" src="<?php print base_url();?>/assets/imgs/uploads/profile/<?php print $user['img_profile']; ?>" class="img-fluid img-50"/>
                <?php }?>
              </center>

              <div class="spacer-10"></div>

              <button type="button" id="btnUploadImg" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12">
                <i class="fas fa-camera"></i>
                Upload Image
              </button>

              <div class="form-group hideThis">
                <div class="custom-file">
                  <input type="file" name="img" class="custom-file-input" id="uploadImg" accept="image/*">
                  <input type="text" name="img_profile" class="form-control" disabled id="file">
                </div>
             </div>

              <div class="spacer-10"></div>

             <button type="button" class="btn btn-md btn-primary btn-w-100 btn-azeer-bl fnt-12" data-toggle="modal" data-target="#changePassword">
               <i class="fas fa-unlock-alt"></i>
               Change Password
             </button>
              <div class="spacer-20"></div>
            </div>

            <!-- Column 2 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Name :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['name']; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Email :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['email']; ?>">
                  <!--<input name="email" type="text" class="form-control" value="<?php print $user['email']; ?>" required>-->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Status :</label>
                <div class="col-sm-8">
                  <?php if(isset($_SESSION['roles']) && $_SESSION['roles'] > 2){ ?>
                      <input type="text" readonly class="form-control-plaintext" value="<?php print $status; ?>">
                  <?php }else{ ?>
                    <select name="status" class="form-control selectpicker show-tick" data-live-search="true">
                      <?php print $option_status; ?>
                    </select>
                  <?php }?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Telephone No. :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['telephone']; ?>">
                  <!--<input name="telephone" type="text" class="form-control" value="<?php print $user['telephone']; ?>" required>-->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Fax No. :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['fax']; ?>">
                  <!--<input name="fax" type="text" class="form-control" value="<?php print $user['fax']; ?>" required>-->
                </div>
              </div>
            </div>

            <!-- Column 3 -->
            <div class="col-lg-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Address :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['address']; ?>">
                  <!--<input name="address" type="text" class="form-control" value="<?php print $user['address']; ?>" required>-->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">PO Box :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['po_box']; ?>">
                  <!--<input name="po_box" type="text" class="form-control" value="<?php print $user['po_box']; ?>" required>-->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Region :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $region; ?>">
                  <!--
                  <select name="region" class="form-control selectpicker show-tick" data-live-search="true" required>
                    <?php print $option_region; ?>
                  </select>
                -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">City :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $city; ?>">
                  <!--
                  <select name="city" class="form-control selectpicker show-tick" data-live-search="true" required>
                    <?php print $option_city; ?>
                  </select>
                  -->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Zipcode :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['zipcode']; ?>">
                  <!--<input name="zipcode" type="text" class="form-control" value="<?php print $user['zipcode']; ?>" required>-->
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Website :</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control-plaintext" value="<?php print $user['website']; ?>">
                  <!--<input name="website" type="text" class="form-control" value="<?php print $user['website']; ?>" required>-->
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
              <a href="<?php print base_url();?>/profile" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
                Back
              </a>
              <div class="spacer-20"></div>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3"></div>
            <div class="col-lg-3">
              <input type="submit" name="updateProfile" class="btn btn-primary btn-lg btn-block btn-azeer-bl" value="Save">
              <div class="spacer-20"></div>
            </div>
          </div>
      </div>
      </section>

    </form>
  <?php } ?>

<?php } ?>


<!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" method="post">
      <div class="modal-body">
          <label for="">Please enter a new your password</label>
          <input name="password" type="password" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" name="changePassword" class="btn btn-primary" value="Confirm">
      </div>
    </form>
  </div>
</div>
</div>
