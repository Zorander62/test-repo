<?php 

      @$UserEmail = $_SESSION['email'];
      $Dbinfo = $Fcall->Targeted_information('users','username',$UserEmail);
      $Userdetails = $Fcall->Targeted_information('patients','email',$Dbinfo['username']);

 ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
                <button class="btn btn-primary btn-sm ms-auto">Settings</button>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email address</label>
                    <input class="form-control" type="text" value="<?php echo $Dbinfo['username']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Phone</label>
                    <input class="form-control" type="email" value="<?php echo $Userdetails['phone_number']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">First name</label>
                    <input class="form-control" type="text" value="<?php echo $Userdetails['first_name']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Last name</label>
                    <input class="form-control" type="text" value="<?php echo $Userdetails['last_name']; ?>">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Contact Information</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Address</label>
                    <input class="form-control" type="text" value="<?php echo $Userdetails['address']; ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">City</label>
                    <input class="form-control" type="text" value="<?php echo $Userdetails['city']; ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Country</label>
                    <input class="form-control" type="text" value="<?php echo $Userdetails['country']; ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Date of Birth</label>
                    <input class="form-control" type="text" value="<?php echo $Userdetails['date_of_birth']; ?>">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Medical History</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Other Medical Details</label>
                    <input class="form-control" type="text" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source.">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-profile">
            <div class="card-body text-center">
              <h5 class="mb-4">Upload Your Profile Picture</h5>
              <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" name="profile_picture" class="form-control-file" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    