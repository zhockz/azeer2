
<div class="spacer-40"></div>

<!--header-->
<section id="userAdd-<?php print $_SESSION['roles'];?>" class="">

  <div class="container">

    <div class="row">

      <?php include "common/header2.php";?>

      <div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
        <h2 class="title">Customers <small class="fnt-18">New Customer</small></h2>
      </div>
      <div class="col-lg-2"></div>

    </div>

  </div>

</section>

<div class="spacer-20"></div>

<form action="" method="post" enctype="multipart/form-data">

  <section>

    <div class="container fnt-18">
      <!-- message -->
      <?php if($result != ""){?>
        <div class="alert alert-<?php print $result;?> fnt-12" role="alert">
          <?php print $message;?>
        </div>
      <?php }?>

      <div class="row">

        <!-- column 1 -->
        <div class="col-lg-2">
          <center>
            <img id="preview" src="<?php print base_url();?>/assets/imgs/default-logo.jpg" class="img-fluid img-50"/>
          </center>

          <!--
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
       -->

         <div class="spacer-20"></div>

        </div>

        <!-- Column 2 -->
        <div class="col-lg-5">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Name :</label>
            <div class="col-sm-8">
              <input name="name" type="text" class="form-control" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email :</label>
            <div class="col-sm-8">
              <input name="email" type="email" class="form-control" value="" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status :</label>
            <div class="col-sm-8">
              <select name="status" class="form-control selectpicker show-tick" data-live-search="true" required>
                <?php print $option_status; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Password :</label>
            <div class="col-sm-8">
              <input name="password" type="password" class="form-control" required>
            </div>
         </div>
         <div class="form-group row">
           <label class="col-sm-4 col-form-label">Contact No. :</label>
           <div class="col-sm-8">
             <input name="telephone" type="text" class="form-control" value="" required>
           </div>
         </div>
         <div class="form-group row">
           <label class="col-sm-4 col-form-label">Fax No. :</label>
           <div class="col-sm-8">
             <input name="fax" type="text" class="form-control" value="" >
           </div>
         </div>
        </div>

        <!-- Column 3 -->
        <div class="col-lg-5">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Address :</label>
            <div class="col-sm-8">
              <input name="address" type="text" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">PO Box :</label>
            <div class="col-sm-8">
              <input name="po_box" type="text" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Region :</label>
            <div class="col-sm-8">
              <select name="region" id="region" class="form-control selectpicker" data-live-search="true">
                <?php print $option_region; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">City :</label>
            <div class="col-sm-8">
              <select name="city" id="city" class="form-control selectpicker" disabled data-live-search="true">
                <?php print $option_city; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Zipcode :</label>
            <div class="col-sm-8">
              <input name="zipcode" type="text" class="form-control" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Website :</label>
            <div class="col-sm-8">
              <input name="website" type="text" class="form-control" value="">
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
          <a href="<?php print base_url();?>/customers" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
            Back
          </a>
          <div class="spacer-20"></div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
          <input name="job_title" type="hidden" class="form-control" value="">
          <input name="mobile" type="hidden" class="form-control" value="">
          <input name="emp_id" type="hidden" class="form-control" value="">
          <input name="roles" type="hidden" class="form-control" value="4">
          <input type="submit" name="addNewUser" class="btn btn-primary btn-lg btn-block btn-azeer-bl" value="Save">
          <div class="spacer-20"></div>
        </div>
      </div>
  </div>
  </section>

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
