<?php

  $readyOnly = "";
  if(isset($_SESSION['roles']) && $_SESSION['roles'] > 2){
    $readyOnly = "readonly disabled";
  }
?>

<div class="spacer-40"></div>

<!--header-->
<section id="profile" class="">

  <div class="container">

    <div class="row">

      <?php include "common/header2.php";?>

      <div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
        <h2 class="title">Customers <small class="fnt-18">Edit Information</small></h2>
      </div>
      <div class="col-lg-2"></div>

    </div>

  </div>

</section>

<div class="spacer-20"></div>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10">
        <label>List of Staff in Charge</label>
        <p>TOTAL: <?php print $UserCount; ?></p>
      </div>
      <div class="col-lg-2">
        <a href="<?php print base_url();?>/customers/staffs/add?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-md w-100 fnt-12">
          <i class="fas fa-users"></i> Add Staffs
        </a>
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
            <th class="w-10">Action</th>
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

          <button type="button" id="btnUploadImg" class="btn btn-md btn-primary btn-w-100  fnt-12">
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

         <button type="button" class="btn btn-md btn-primary btn-w-100 fnt-12" data-toggle="modal" data-target="#changePassword">
           <i class="fas fa-unlock-alt"></i>
           Change Password
         </button>

         <div class="spacer-10"></div>
         <a href="<?php print base_url();?>/customers/equipments?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-md w-100 fnt-12">
           <i class="fas fa-cogs"></i> Equipments
         </a>
         <div class="spacer-10"></div>
         <a href="<?php print base_url();?>/customers/attachments?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-md w-100 fnt-12">
           <i class="fas fa-file-alt"></i> Attachments
         </a>
         <div class="spacer-20"></div>

          <div class="spacer-20"></div>

        </div>

        <!-- Column 2 -->
        <div class="col-lg-5">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">UID :</label>
            <div class="col-sm-8">
              <?php print $user['id']; ?>
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
            <label class="col-sm-4 col-form-label">Status :</label>
            <div class="col-sm-8">

              <?php if(isset($_SESSION['roles']) && $_SESSION['roles'] > 2){ ?>
                  <input type="text" readonly class="form-control-plaintext fnt-12" value="<?php print $status; ?>">
              <?php }else{ ?>
                <select name="status" class="form-control selectpicker" data-live-search="true">
                  <?php print $option_status; ?>
                </select>
              <?php }?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Telephone No. :</label>
            <div class="col-sm-8">
              <input name="telephone" type="text" class="form-control" value="<?php print $user['telephone']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Fax No. :</label>
            <div class="col-sm-8">
              <input name="fax" type="text" class="form-control" value="<?php print $user['fax']; ?>">
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
            <label class="col-sm-4 col-form-label">PO Box :</label>
            <div class="col-sm-8">
              <input name="po_box" type="text" class="form-control" value="<?php print $user['po_box']; ?>" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Region :</label>
            <div class="col-sm-8">
              <select name="region" id="region" class="form-control selectpicker" data-live-search="true" required>
                <?php print $option_region; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">City :</label>
            <div class="col-sm-8">
              <select name="city" id="city" class="form-control selectpicker" data-live-search="true" required>
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
            <label class="col-sm-4 col-form-label">Website :</label>
            <div class="col-sm-8">
              <input name="website" type="text" class="form-control" value="<?php print $user['website']; ?>">
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
          <a href="<?php print base_url();?>/customers/view?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
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

<script>
  jQuery(document).ready(function(){

    jQuery('#region').on('change', function(){
      var getRegion = jQuery(this).val();
      if(getRegion != 0 || getRegion != ''){
        $.ajax({
            type: 'POST',
            url: "<?php print base_url();?>/ajax",
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data:{
              id:getRegion,
              type:'getCity'
            },
            success: function(data){
              jQuery('#city').removeAttr('disabled');
              jQuery('#city').html('');
              jQuery('#city').html(data);
              jQuery('#city').selectpicker('refresh');

            }
        });
      }else{
        jQuery('#city').attr('disabled','disabled');
        jQuery('#city').html('');
        jQuery('#city').html('<option value="">Please Select</option>');
        jQuery('#city').selectpicker('refresh');

      }

    });

  });
</script>
