<?php
    require_once 'core/init.php';
    require APPROOT . '/includes/authhead.php';
 ?>


  <div class="container-fluid bg-dark">
    <div class="container" style="padding:12px;">
      <h2 class="text-center text-info text-bold text-upper">Welcome to Godfrey Okoye University Enugu  Leave Management System <hr class="invisible">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ab/GOUniversity_logo.jpg" alt="GOU LOGO">
      </h2>
    </div><hr>
    <div class="row">
      <div class="col-lg-6 p-5">
          <a href="employeePortal/login" class="btn btn-lg btn-info btn-block btn-lg" target="_blank"><i class="fa fa-user fa-lg"></i>&nbsp;Employee Portal</a>
      </div>
      <div class="col-lg-6 p-5">
          <a href="lms_Admin/sudo-login" class="btn btn-lg btn-block btn-danger btn-lg" target="_blank"><i class="fa fa-gear fa-lg"></i>&nbsp;Admin Panel</a>
      </div>
    </div>
  </div>




 <?php
     require 'includes/footer1.php';
  ?>
