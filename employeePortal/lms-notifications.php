<?php
    require_once '../core/init.php';

    $user = new User();
    // $useremail = $user->getEmail();

    if (!isLoggedInUser()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('login');
      
    }


    // if (isOTPsetStudent($studentEmail)) {
    //   Redirect::to('otp-verify');
    // }

    require_once APPROOT . '/includes/headportal1.php';
    require_once APPROOT . '/includes/navportal1.php';



?>
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center" id="notification">

        </div>

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php  require_once APPROOT .'/includes/footerportal1.php';?>
<script type="text/javascript" src="notificationjs.js"></script>
