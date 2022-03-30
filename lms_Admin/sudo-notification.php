<?php
    require_once '../core/init.php';
    $admin = new Admin();
    $adminEmail = $admin->getAdminEmail();
    $admin_id = $admin->data()->id;

    if (!isLoggedInAdmin()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('sudo-login');

    }
    if (!hasPermissionSuper()) {
      Session::flash('message', 'Access Denied! You can\'t access that page!');
      Redirect::to('sudo-dashboard');

    }
    // if (isOTPset($adminEmail)) {
    //   Redirect::to('otp-verify');
    // }


    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';




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
        <div class="row" id="notification">

        </div>

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php  require_once APPROOT .'/includes/footerportal.php';?>

<script type="text/javascript" src="notify.js"></script>
