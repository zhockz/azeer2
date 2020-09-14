
<div class="spacer-40"></div>

<!--header-->
<section id="profile" class="">

  <div class="container">

    <div class="row">

      <?php include "common/header2.php";?>

      <div class="col-lg-10 d-flex justify-content-center justify-content-md-start">
        <h2 class="title">Customers <small class="fnt-18">Staffs</small></h2>
      </div>
      <div class="col-lg-2"></div>
    </div>

  </div>

</section>

<!--content-->
<div class="spacer-20"></div>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10">
        <label>List of Staff in Charge</label>
        <p>TOTAL: <?php print $UserCount; ?></p>
      </div>
      <div class="col-lg-2">
        <a href="<?php print base_url();?>/customers/staffs/add?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-md w-100 fnt-12">Add Staffs</a>
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

<!-- form -->
<section>
  <div class="container">
    <form action="" method="post">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="">Name :</label>
            <input name="name" type="text" class="form-control" value="<?php print $user['name']?>">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label for="">Email :</label>
            <input name="email" type="email" class="form-control" value="<?php print $user['email']?>">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label for="">Mobile :</label>
            <input name="mobile" type="text" class="form-control" value="<?php print $user['mobile']?>">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <label for="">Job Title :</label>
            <input name="job_title" type="text" class="form-control" value="<?php print $user['job_title']?>">
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <div class="spacer-30"></div>
            <input name="id" type="hidden" class="btn btn-primary fnt-12 w-100" value="<?php print $_GET['staff']?>">
            <input name="submitStaff" type="submit" class="btn btn-primary fnt-12 w-100" value="Edit">
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<div class="spacer-80"></div>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <a href="<?php print base_url();?>/dashboard" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
          Dashboard
        </a>
        <div class="spacer-20"></div>
        <a href="<?php print base_url();?>/customers/view?id=<?php print $_GET['id']; ?>" class="btn btn-primary btn-lg btn-block btn-azeer-bl">
          <!--<i class="fas fa-arrow-circle-left marRight-10"></i>-->Back
        </a>
        <div class="spacer-20"></div>
      </div>
      <div class="col-lg-3"></div>
      <div class="col-lg-3"></div>
      <div class="col-lg-3"></div>
    </div>
</div>
</section>
