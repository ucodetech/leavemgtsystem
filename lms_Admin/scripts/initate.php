<?php
require_once '../../core/init.php';
$general = new General();
$user = new Employee();

if(isset($_POST['action']) && $_POST['action'] == "fetch_data"){
    $output = '';

    $row = $user->loggedUsers();

   if ($row) {
     foreach ($row as $active) {

       ?>
       <div class="col-lg-6">

          <img src='../employeePortal/avaters/<?=$active->passport;?>' width='70px' height='70px' style='border-radius:50px;' alt='Passport'>
         <br>
           <?php
         echo strtok($active->full_name, ' ') . '- ID-' . $active->id ;
         ?>

       </div>
         <?php
     }
   }


}


if(isset($_POST['action']) && $_POST['action'] == "fetch_super"){
    $output = '';

    $supers = $general->loggedAdmin();

   if ($supers) {
     foreach ($supers as $active) {
        
       ?>
       <div class="col-lg-6">
        
           <img src="<?=$active->profile_pic?>"  width='70px' height='70px' style='border-radius:50px;'>
          <br>
         <?=strtok($active->sudo_full_name, ' ') . '- Permissions-' . $active->sudo_permission ?>
         

       </div>
         <?php
     }
   }

https://localhost/leavemgtsystem/lms_Admin/default.png
}


if (isset($_POST['action']) && $_POST['action'] == 'update_war') {
  $general->updateAdmin();

}


if(isset($_POST['action']) && $_POST['action'] == "totUsers"){
  $tot =  $general->totalCount('users');
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totfeed"){
  $tot =  $general->totalCount('feedback');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totHead"){
  $tot =  $general->totalCount('monitorHead');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totNotification"){
  $tot =  $general->totalCount('notifications');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totVemail"){
  $tot =  $user->verified_users(0);
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totVdemail"){
  $tot =  $user->verified_users(1);
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totPwdReset"){
  $tot =  $general->totalCount('pwdReset');
   echo $tot;
}
if(isset($_POST['action']) && $_POST['action'] == "totAUemail"){
  $tot =  $general->verified_admin(0);
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totAemail"){
  $tot =  $general->verified_admin(1);
   echo $tot;
}


if(isset($_POST['action']) && $_POST['action'] == "totLeaveRequests"){
  $tot =  $general->getTotLeaveRequest();
   echo $tot;
}

if(isset($_POST['action']) && $_POST['action'] == "totLeavePendings"){
  $tot1 =  $general->getTotStatusRequest('annaulLeaveRequest','pending',1);
  $tot2 =  $general->getTotStatusRequest('maternityLeave','pending',1);
  $tot3 =  $general->getTotStatusRequest('medicalLeave','pending',1);
  $tot4 =  $general->getTotStatusRequest('sabaticalLeave','pending',1);
  $tot5 =  $general->getTotStatusRequest('casaulLeave','pending',1);

  
  $tots = $tot1 + $tot2 + $tot3 + $tot4 + $tot5;
  echo $tots;
  
}
if(isset($_POST['action']) && $_POST['action'] == "totLeaveApproveds"){
  $tot1 =  $general->getTotStatusRequest('annaulLeaveRequest','approved',1);
  $tot2 =  $general->getTotStatusRequest('maternityLeave','approved',1);
  $tot3 =  $general->getTotStatusRequest('medicalLeave','approved',1);
  $tot4 =  $general->getTotStatusRequest('sabaticalLeave','approved',1);
  $tot5 =  $general->getTotStatusRequest('casaulLeave','approved',1);

  
  $tots = $tot1 + $tot2 + $tot3 + $tot4 + $tot5;
  echo $tots;
  
}
