<?php
    require_once '../core/init.php';
    $admin = new Admin();
    $adminEmail = $admin->getAdminEmail();
    $admin_id = $admin->data()->id;

    if (!isLoggedInAdmin()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('sudo-login');

    }

    // if (isOTPset($adminEmail)) {
    //   Redirect::to('otp-verify');
    // }


    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

  $count = new Employee();
  $show = new Show();
  $general = new General();
  $getSignature = $admin->adminGetSignatures($admin->data()->id);
  $success = '';
if (isset($_POST['uploadSignature'])) {

  if (isset($_FILES['signature'])) {
   
           $signature = '';
           $file = $_FILES["signature"]['name'];
           $RandomNum = rand(0, 10000);
           $FileName = str_replace(' ','-',strtolower($_FILES['signature']['name']));
           $FileType = $_FILES['signature']['type']; //"File/png", File/jpeg etc.
           $FileTemp = $_FILES["signature"]["tmp_name"];
           $FileSize = $_FILES['signature']['size'];
           $FileExt = substr($FileName, strrpos($FileName, '.'));
           $FileExt = str_replace('.','',$FileExt);
           $valid = array('png', 'jpeg', 'jpg');
           $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
           $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
           $output_dir = 'signatures/'.$NewFileName;//Path for file
         
          if ($FileSize > 1000000) {
             echo   'file size should be less than 1MB';
          return false;
          }
          if (!in_array(strtolower($FileExt), $valid)) {
              echo  'Invalid Extension';
            return false;

          }

          $signature = $NewFileName;

           // if (!is_dir($output_dir)) {
           //   mkdir($output_dir='uploads', 755, true);
           //
           // }

        if (move_uploaded_file($FileTemp ,$output_dir)) 
        $update = $general->InsertSignature($admin_id,$signature);
        if ($update) {
          $success .=  $show->showMessage('success', 'You have successfully updated your signature!', 'check');
          ?>
            <script>
              window.location = 'sudo-dashboard' ; 
            </script>
            <?php
        }else{
           $success .=  $show->showMessage('danger', 'update Failed!', 'warning');
        }
  }



}



?>
    
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      
  <?php if (hasPermissionSuper()): ?>
    <span class="text-left text-underline text-success float-right"><u>You are logged in as a Superuser </u></span>
  <?php elseif(hasPermissionHOD()): ?>
    <span class="text-left text-underline text-success float-right"><u>You are logged in as Head Of Department</u></span>

  <?php elseif(hasPermissionHR()): ?> 
  <span class="text-left  text-underline text-success float-right"><u>You are logged in as a Human Resource Manager</u></span>

  <?php elseif(hasPermissionMedical()): ?>  
  <span class="text-left text-underline text-success float-right"><u>You are logged in as Medical Director</u></span>

  <?php endif ?>
      </div><br><hr>
      <?= $success ?>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <?php if (!hasPermissionSuper()): ?>
            <?php if ($getSignature): ?>
            <span class="text-left">Signature is updated</span><br>
            <div class="showSignature float-left shadow-lg">
              <img src="signatures/<?=$getSignature->signature;?>" alt="Signature">
            </div>
            <?php else: ?>
                <span class="text-left">Update your Signature</span><hr>
                <form action="#" method="post" enctype="multipart/form-data">
                  <div class="row shadow-lg p-5">
                    <div class="form-group col-md-4 text-primary">
                      <label for="signature" id="file-label">
                        <i class="fas fa-upload upload-icon text-primary"></i>&nbsp;
                      Chose Image
                    </label>
                      <input type="file" name="signature" id="signature" style="display: none;" />
                    </div>
                    <div class="form-group col-md-4">
                      <input type="submit" name="uploadSignature" class="btn btn-info btn-lg" value="Upload Signature">
                    </div>
                    <div class="form-group col-md-4 shadow-lg">
                    <div id="previewSignature">preview</div>
                  </div>
                  </div>
                  
                </form>
          <?php endif ?>
                <?php endif ?>
               
   <?php if (hasPermissionSuper()): ?>

          <div class="row">
            <div class="col-lg-12">
              <div class="card-group">
              <div class="card border-danger shadow-lg border-2" style="flex-grow:1.4;">
                <div class="card-header bg-info">
                  <h3 class="m-0 text-white">
                    <i class="fa fa-users"></i>&nbsp; Active Users
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row" id="activeUsers">

                  </div>
                </div>
              </div>
              <div class="card border-danger shadow-lg border-2">
                <div class="card-header bg-info">
                  <h3 class="m-0 text-white">
                    <i class="fa fa-users"></i>&nbsp; Active Superusers
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row" id="activeAdmin">

                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-users fa-lg"></i>Total Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totUsers">

                    </h1>
                  </div>
                </div>
                <div class="card bg-success">
                  <div class="card-header">
                      <i class="fas fa-envelope fa-lg"></i>Verified Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVemails">

                    </h1>
                  </div>
                </div>
                <div class="card bg-danger">
                  <div class="card-header">
                  <i class="fas fa-envelope fa-lg"></i>Unverified Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVdemails">
                    </h1>
                  </div>
                </div>
                <div class="card bg-info">
                  <div class="card-header">
                  <i class="fas fa-circle fa-lg"></i> Total Leave Request
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totRequest">

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                
                
                <div class="card bg-danger">
                  <div class="card-header">
                  <i class="fas fa-envelope fa-lg"></i>Total Pending
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totPending">
                    </h1>
                  </div>
                </div>
                <div class="card bg-info">
                  <div class="card-header">
                  <i class="fas fa-circle fa-lg"></i> Total Approved
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totApproved">

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                
                <div class="card bg-success">
                  <div class="card-header">
                    <i class="fas fa-comment-dots fa-lg"></i>Total Feedback
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totFeedback">

                    </h1>
                  </div>
                </div>
                <div class="card bg-warning">
                  <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Total Notification
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totNotification">

                    </h1>
                  </div>
                </div>
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Total Notification From Admin
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totMonitor">

                    </h1>
                  </div>
                </div>
                <div class="card bg-secondary">
                  <div class="card-header">
                  <i class="fas fa-key fa-lg"></i>  Total Password Reset Request
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totpwD">

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        

  <?php endif ?>
        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    <!-- end of content -->
    </div>
    <!-- /.content-wrapper -->


<?php require_once APPROOT . '/includes/footerportal.php';?>
<script type="text/javascript">

  function readURL(input){
   
    if (input.files && input.files[0]) {
       var reader = new FileReader();
      reader.onload = function(e){
        $('#previewSignature').html('<img src="'+e.target.result+'" alt="signature" class="img-fluid img-thumbnail" width="150">');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('document').ready(function(){

$('#signature').change(function(){
  readURL(this);
})


// update last lastLogin
update_admin_login();

        function update_admin_login()
        {
            var action = 'update_war';
            $.ajax({
               url:"scripts/initate.php",
               method:"POST",
               data:{action:action},
               success:function(response)
               {
                 console.log(response);

               },
               error:function(){alert("something went wrong admin update")}

            });
        }
   setInterval(function(){
     update_admin_login();
  }, 1000);



//fetech active admins
fetch_admin_login();

setInterval(function(){
   fetch_admin_login();
}, 3000);

function fetch_admin_login()
{
    var action = 'fetch_super';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#activeAdmin').html(data);

       },
       error:function(){alert("something went wrong fetch admin")}

    });
}


//FEcth active users
    fetch_user_login();

    setInterval(function(){
       fetch_user_login();
    }, 3000);

    function fetch_user_login()
    {
        var action = 'fetch_data';
        $.ajax({
           url:"scripts/initate.php",
           method:"POST",
           data:{action:action},
           success:function(data)
           {
             $('#activeUsers').html(data);

           },
           error:function(){alert("something went wrong fetch user login")}

        });
    }
//Fetch total users

fetch_totUsers();

setInterval(function(){
   fetch_totUsers();
}, 5000);

function fetch_totUsers()
{
    var action = 'totUsers';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totUsers').html(data);

       },
       error:function(){alert("something went wrong tot users")}

    });
}

//Fetch total verified email

fetch_totVdemail();

setInterval(function(){
   fetch_totVdemail();
}, 5000);

function fetch_totVdemail()
{
    var action = 'totVdemail';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totVemails').html(data);

       },
       error:function(){alert("something went wrong to v email")}

    });
}

//Fetch total verified email

fetch_totnVemail();

setInterval(function(){
   fetch_totnVemail();
}, 5000);

function fetch_totnVemail()
{
    var action = 'totVemail';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totVdemails').html(data);

       },
       error:function(){alert("something went wrong tot v email 2")}

    });
}


//Fetch total notes

fetch_totNotes();

setInterval(function(){
   fetch_totNotes();
}, 5000);

function fetch_totNotes()
{
    var action = 'totNotes';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totNotes').html(data);

       },
       error:function(){alert("something went wrong tot notes")}

    });
}
//Fetch total feed back

fetch_totFeed();

setInterval(function(){
   fetch_totFeed();
}, 5000);

function fetch_totFeed()
{
    var action = 'totfeed';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totFeedback').html(data);

       },
       error:function(){alert("something went wrong tot feed")}

    });
}
//Fetch total notifactions

fetch_totNote();

setInterval(function(){
   fetch_totNote();
}, 5000);

function fetch_totNote()
{
    var action = 'totNotification';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totNotification').html(data);

       },
       error:function(){alert("something went wrong tot notif")}

    });
}

//Fetch total Admin

fetch_totMonitor();

setInterval(function(){
   fetch_totMonitor();
}, 5000);

function fetch_totMonitor()
{
    var action = 'totHead';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totMonitor').html(data);

       },
       error:function(){alert("something went wrong tot monitor")}

    });
}

//Fetch Password reset

fetch_totPwdReset();

setInterval(function(){
   fetch_totPwdReset();
}, 5000);

function fetch_totPwdReset()
{
    var action = 'totPwdReset';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totpwD').html(data);

       },
       error:function(){alert("something went wrong tot password reset")}

    });
}

//Fetch total users

fetch_totRequest();

setInterval(function(){
   fetch_totRequest();
}, 1000);

function fetch_totRequest()
{
    var action = 'totLeaveRequests';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totRequest').html(data);

       },
       error:function(){alert("something went wrong tot leave request")}

    });
}


//Fetch total users

fetch_totPending();

setInterval(function(){
   fetch_totPending();
}, 1000);

function fetch_totPending()
{
    var action = 'totLeavePendings';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totPending').html(data);

       },
       error:function(){alert("something went wrong tot leave pending")}

    });
}


//Fetch total users

fetch_totApproved();

setInterval(function(){
   fetch_totApproved();
}, 1000);

function fetch_totApproved()
{
    var action = 'totLeaveApproveds';
    $.ajax({
       url:"scripts/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totApproved').html(data);

       },
       error:function(){alert("something went wrong tot leave approved")}

    });
}



});

</script>
<!-- <script type="text/javascript" src="notify.js"></script> -->