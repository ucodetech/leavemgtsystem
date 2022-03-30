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

    $category = new Category();

    $signed = $user->getSignature($user->data()->id);
    $leave = new Leave();
    $userid = $user->data()->id;


    if (isset($_POST['uploadSignature'])) {

        $userid = $user->data()->id;

        $file_signature = '';
           $file = $_FILES["file_signature"]['name'];
           $RandomNum = rand(0, 10000);
           $FileName = str_replace(' ','-',strtolower($_FILES['file_signature']['name']));
           $FileType = $_FILES['file_signature']['type']; //"File/png", File/jpeg etc.
           $FileTemp = $_FILES["file_signature"]["tmp_name"];
           $FileSize = $_FILES['file_signature']['size'];
           $FileExt = substr($FileName, strrpos($FileName, '.'));
           $FileExt = str_replace('.','',$FileExt);
           $valid = array('png', 'jpeg', 'jpg');
           $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
           $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
           $output_dir = 'avaters/'.$NewFileName;//Path for file

          if ($FileSize > 1000000) {
            echo  $show->showMessage('danger', 'file size should be less than 1MB', 'warning');
            return false;
          }
          if (!in_array(strtolower($FileExt), $valid)) {
              echo  $show->showMessage('danger', 'Invalid Extension', 'warning');
              return false;

          }

          $file_signature = $NewFileName;

           // if (!is_dir($output_dir)) {
           //   mkdir($output_dir='uploads', 755, true);
           //
           // }

        if (move_uploaded_file($FileTemp ,$output_dir)) {

             Database::getInstance()->insert('signatures', array(
              'user_id' => $userid,
              'empSignature' => $file_signature
            ));
              ?>
                <script>
                  window.location = 'lms-dashboard';
                </script>
              <?

        }else{
         echo 'Unable to move file';
        }


    }


       if (isset($_POST['uploadPassport'])) {

        $userid = $user->data()->id;

        $file_passport = '';
           $file = $_FILES["file_passport"]['name'];
           $RandomNum = rand(0, 10000);
           $FileName = str_replace(' ','-',strtolower($_FILES['file_passport']['name']));
           $FileType = $_FILES['file_passport']['type']; //"File/png", File/jpeg etc.
           $FileTemp = $_FILES["file_passport"]["tmp_name"];
           $FileSize = $_FILES['file_passport']['size'];
           $FileExt = substr($FileName, strrpos($FileName, '.'));
           $FileExt = str_replace('.','',$FileExt);
           $valid = array('png', 'jpeg', 'jpg');
           $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
           $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
           $output_dir = 'avaters/'.$NewFileName;//Path for file

          if ($FileSize > 1000000) {
            echo  $show->showMessage('danger', 'file size should be less than 1MB', 'warning');
            return false;
          }
          if (!in_array(strtolower($FileExt), $valid)) {
              echo  $show->showMessage('danger', 'Invalid Extension', 'warning');
              return false;

          }

          $file_passport = $NewFileName;

           // if (!is_dir($output_dir)) {
           //   mkdir($output_dir='uploads', 755, true);
           //
           // }

        if (move_uploaded_file($FileTemp ,$output_dir)) {

             Database::getInstance()->update('users','id', $userid, array(
              'passport' => $file_passport
            ));
              ?>
                <script>
                  window.location = 'lms-dashboard';
                </script>
              <?

        }else{
         echo 'Unable to move file';
        }


    }

?>
<style>
  #showActive span{
  text-align: center;
  font-size: 2rem;
  color: green;
}
</style>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="text-right float-right">
          <?php if (hasPermissionEmployee()): ?>
            <span class="text-info shadow-lg"><u>You are logged in as Employee</u></span><br>
          <?php endif ?>

        </div>
        <?php if ($signed===false || $user->data()->passport == 'default.png'): ?>
         <p class="text-center text-danger">Please Scan and Upload Your Signature and passport!</p>

          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4">
                    <button type="submit" class="btn btn-info" id="updatePassportBtn">Update Passport</button>

              </div>
              <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" id="updateSignatureBtn">Update Signature</button>

              </div>
            </div>
          </div>

         <hr>
         <form id="showMeSignatureForm" action="#" method="post" enctype="multipart/form-data" style="display: none;">
          <div class="row">
              <div class="form-group col-lg-4">
                <div class="custom-file">
                   <input type="file" name="file_signature" id="file_signature"
                   class="custom-file-input form-control-lg">
                    <label for="file_signature" class="custom-file-label">Select File (signature)</label>
               </div>
            </div>

             <div class="form-group col-lg-4">
                <button type="submit" class="btn btn-info btn-block " name="uploadSignature" id="uploadSignature"><i class="fa fa-sign-up"></i>&nbsp;Upload</button>
             </div>

           </div>
              </form>
            <form id="showMePassportForm" action="#" method="post" enctype="multipart/form-data" style="display: none;">
          <div class="row">
              <div class="form-group col-lg-4">
                <div class="custom-file">
                   <input type="file" name="file_passport" id="file_passport"
                   class="custom-file-input form-control-lg">
                    <label for="file_passport" class="custom-file-label">Select File (passport)</label>
               </div>
            </div>

             <div class="form-group col-lg-4">
                <button type="submit" class="btn btn-primary btn-block " name="uploadPassport" id="uploadPassport"><i class="fa fa-sign-up"></i>&nbsp;Upload</button>
             </div>
           </div>
              </form>
               <div class="form-group col-lg-4 showFiles  shadow-lg" id="showFile">
              image preview

             </div>
      <?php endif ?>

      </div><!-- /.container-fluid -->
    </div><br>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

         <div class="row shadow-lg">
           <div class="col-lg-6 shadow-lg">
             <p class="activeLeave bg-success"><i class="fa fa-spinner fa-lg"></i>&nbsp;Active Leave</p><hr>
              <span id="showActive"></span>
           </div>

           <div class="col-lg-6 shadow-lg">
           <p class="pendingLeave bg-warning"><i class="fa  fa-circle-o-notch fa-lg"></i>&nbsp;Leave Request Status</p><hr>
           <div class="row">
            <div class="col-md-6">
              <form action="#" method="post" enctype="multipart/form-data" id="requestStatus">

              <div class="form-group">
              <label for="requestStatusCheck">Type of Leave applied:<sup class="text-danger">*</sup></label>
                <select name="requestStatusCheck" id="requestStatusCheck" class="form-control form-control-lg">
                <option value="">Select Type Of Applied</option>

                    <?php
                    $leaves = $category->getCategory();
                    foreach($leaves as $leavCate ):
                      ?>
                  <option value="<?=$leavCate->category;?>"><?=$leavCate->category;?></option>
                    <?php endforeach; ?>
                </select>
              </div>
          </form>
            </div>
            <div class="col-md-6">
              <label for="showStatus">Status:</label>
                <span id="showStatus"></span>
              </div>
           </div>

           </div>
           <div class="col-lg-6 shadow-lg">
             <p class="rejectedLeave bg-danger"><i class="fa fa-clock fa-lg"></i>&nbsp;Timer</p>
             <hr>
             <?php
                 $getDate = $leave->getActiveLeave('activeLeaves',$user->data()->id);
                if ($getDate) {

                if ($getDate->dateReturningToDuty != '0000-00-00') {
                  $dateToday = date('Y-m-d');

                      if ($dateToday == $getDate->dateOfProceedingOnLeave || $dateToday > $getDate->dateOfProceedingOnLeave) {
                         ?>
                           <div id="DateCountdown" data-date="<?=$getDate->dateReturningToDuty;?>" style="width: auto; height: auto; padding: 0px; box-sizing: border-box; background-color: #E0E8EF"></div><br><br><br>
                        <?
                      }else{
                        ?>
                        <span class="text-info">Count down will start on <?=pretty_dates($getDate->dateOfProceedingOnLeave)?></span>
                        <?
                      }

                }
              }
                ?>

            <div id="showError"></div>

           </div>
           <div class="col-lg-6 shadow-lg">
            <p class="requestLeave bg-secondary"><i class="fa fa-arrows-v fa-lg"></i>&nbsp;Request Leave</p><hr>
             <?php if ($signed===true || $user->data()->passport != 'default.png'): ?>
            <div class="row p-2">
              <div class="col-md-12 pb-2">
                <button class="btn btn-info btn-block btn-lg shadow-lg" id="requestShowLeaveBtn">Request For Leave</button>
                 <button class="btn btn-info btn-block shadow-lg" id="CloserequestLeaveBtn" style="display: none;">Close Leave Form</button>
              </div>
                <br><hr>

              <div class="col-lg-12" >
                <?php include 'annualleave.php' ?>
            </div>
            </div>
            <?php else:?>
              <span class="text-center text-danger text-lg">Update Your signature and Passport before you can apply for any leave!</span>
            <?php endif; ?>


           </div>

         </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>

<?php
    require_once APPROOT . '/includes/footerportal1.php';

?>
<script>

  $('#updatePassportBtn').click(function(e){
    e.preventDefault();
    $('#showMePassportForm').toggle();
  });

  $('#updateSignatureBtn').click(function(e){
    e.preventDefault();
    $('#showMeSignatureForm').toggle();
  });

  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#showFile').html('<img src="'+e.target.result+'" alt="signature" class="img-fluid img-thumbnail" width="150">');
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#file_signature").change(function() {
  readURL(this);
});
$("#file_passport").change(function() {
  readURL(this);
});


$(document).ready(function(){
  var gifPath = '../images/gif/trans.gif';

  $("#DateCountdown").TimeCircles();

    $('#typeOfLeave').change(function(){
      typeOfLeave = $('#typeOfLeave').val();

            switch (typeOfLeave) {
               case 'Annual Leave':
                     $('#organisationBox').css('display', 'none');
                     $('#dueToDeliverBox').css('display', 'none');
                     $('#expirationDateBox').css('display', 'none');
               break;

               case 'Maternity Leave':
                      $('#typeOfEmployBox').css('display','none');
                      $('#phoneNoBox').css('display','none');
                      $('#signatureBox').css('display','none');
                      $('#salaryGradeLevelBox').css('display','none');
                      $('#DateARBox').css('display','none');
                      $('#dateReturningLeaveBox').css('display','none');
                      $('#expirationDateBox').css('display','none');
                      $('#organisationBox').css('display','none');
                      $('#addressBox').css('display','none');
                      $('#rankBox').css('display','none');
               break;

               case 'Sabbatical Leave':
                     $('#DateARBox').css('display','none');
                     $('#dueToDeliverBox').css('display', 'none');
               break;

               case 'Casual Leave':
                      $('#showError').append("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i>&nbsp;<span>Coming soon</span></div>");
               break;

               case 'Medical Leave': $('#showError').append("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i>&nbsp;<span>Coming soon</span></div>");
               break;

               case 'Study Leave': window.location = 'lms_studyleave.php';
               break;

               default: location.reload();
            }


    });

  $('#requestBtn').click(function(e){
    e.preventDefault();

    typeOfLeave = $('#typeOfLeave').val();

     switch (typeOfLeave) {
               case 'Annual Leave':
                      fullname  = $('#fullname').val();
                      fileNo = $('#fileNo').val();
                      department = $('#department').val();
                      typeOfEmploy = $('#typeOfEmploy').val();
                      phoneNo = $('#phoneNo').val();
                      signature = $('#signature').val();
                      salaryGradeLevel = $('#salaryGradeLevel').val();
                      rank = $('#rank').val();
                      DateAR = $('#DateAR').val();
                      dateProceedLeave = $('#dateProceedLeave').val();
                      dateReturningLeave = $('#dateReturningLeave').val();
                      address = $('#address').val();
                      action = 'Aleave';
                    $.ajax({
                      url:'scripts/leave-request.php',
                      method:'post',
                      data:{action:action, fullname:fullname,fileNo: fileNo, department : department,typeOfEmploy : typeOfEmploy, phoneNo : phoneNo, signature : signature, salaryGradeLevel : salaryGradeLevel, rank : rank, DateAR : DateAR, dateProceedLeave : dateProceedLeave, dateReturningLeave : dateReturningLeave, address : address  },
                      beforeSend:function(){
                          $('#requestBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;please wait...');
                        },
                      success:function(response){
                        if ($.trim(response)==='success') {
                           $('#requestLeaveForm')[0].reset();
                          $('#showError').html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i>&nbsp;<span>Your Leave request have been sent! always check your mail box for response!</span></div>");
                            $('#requestLeaveBox').css('display','none');
                             setTimeout(function(){
                                location.reload();
                              },6000);


                        }else{
                          $('#showError').html(response);
                        }
                      }
                    });//ajax call

               break;

               case 'Maternity Leave':
                       dateProceedLeave = $('#dateProceedLeave').val();
                        dueToDeliver = $('#dueToDeliver').val();
                        action = 'Matleave';

                      $.ajax({
                        url:'scripts/leave-requestMater.php',
                        method:'post',
                        data:{action:action, dueToDeliver : dueToDeliver, dateProceedLeave : dateProceedLeave},
                        beforeSend:function(){
                            $('#requestBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;please wait...');
                          },
                        success:function(response){
                          if ($.trim(response)==='success') {
                             $('#requestLeaveForm')[0].reset();
                            $('#showError').html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i>&nbsp;<span>Your Leave request have been sent! always check your mail box for response!</span></div>");
                              $('#requestLeaveBox').css('display','none');
                              setTimeout(function(){
                                location.reload();
                              },6000);

                          }else{
                            $('#showError').html(response);
                          }
                        }
                      });//ajax call
               break;

               case 'Sabbatical Leave':
                      fullname  = $('#fullname').val();
                      fileNo = $('#fileNo').val();
                      department = $('#department').val();
                      typeOfEmploy = $('#typeOfEmploy').val();
                      phoneNo = $('#phoneNo').val();
                      signature = $('#signature').val();
                      salaryGradeLevel = $('#salaryGradeLevel').val();
                      rank = $('#rank').val();
                      dateProceedLeave = $('#dateProceedLeave').val();
                      dateReturningLeave = $('#dateReturningLeave').val();
                      address = $('#address').val();
                      expirationDate = $('#expirationDate').val();
                      organisation = $('#organisation').val();
                      action = 'Sableave';
                    $.ajax({
                      url:'scripts/leave-requestSab.php',
                      method:'post',
                      data:{action:action, fullname:fullname,fileNo: fileNo, department : department, typeOfEmploy : typeOfEmploy, phoneNo : phoneNo, signature : signature, salaryGradeLevel : salaryGradeLevel, rank : rank,  dateProceedLeave : dateProceedLeave, dateReturningLeave : dateReturningLeave, address : address, expirationDate : expirationDate, organisation : organisation},
                      beforeSend:function(){
                          $('#requestBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;please wait...');
                        },
                      success:function(response){
                        if ($.trim(response)==='success') {
                           $('#requestLeaveForm')[0].reset();
                          $('#showError').html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i>&nbsp;<span>Your Leave request have been sent! always check your mail box for response!</span></div>");
                            $('#requestLeaveBox').css('display','none');

                             setTimeout(function(){
                                location.reload();
                              },6000);


                        }else{
                          $('#showError').html(response);
                        }
                      }
                    });//ajax call

               break;

               case 'Casual Leave':

               break;

               case 'Medical Leave': $('#showError').append("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-warning'></i>&nbsp;<span>Coming soon</span></div>");
               break;

               case 'Study Leave': window.location = 'lms_studyleave.php';
               break;

               default: location.reload();
            }



  });

  function showPendingRequest(){
    action = 'showPendingServerSide';
    $.ajax({
      url:'scripts/inits.php',
      method:'post',
      data:{action:action},
      success:function(response){
        $('#showPending').html(response);
      }
    })
  }
 $('#requestStatusCheck').change(function(e){
    e.preventDefault();

    requestStatusCheck = $('#requestStatusCheck').val();

     switch (requestStatusCheck) {
               case 'Annual Leave':
                    actionStatus = 'Aleave';
                    $.ajax({
                      url:'scripts/inits.php',
                      method:'post',
                      data:{actionStatus:actionStatus},
                      beforeSend:function(){
                          $('#showStatus').html('<img src="'+gifPath+'" alt="loader">&nbsp;Check...');
                        },
                      success:function(response){
                         $('#requestStatus')[0].reset();
                          $('#showStatus').html("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-circle'></i>&nbsp;<span>"+response+"</span><br><span>("+requestStatusCheck+")</span></div>");
                             // setTimeout(function(){
                             //    location.reload();
                             //  },6000);
                      }
                    });//ajax call

               break;

               case 'Maternity Leave':

                     actionStatus = 'Matleave';

                    $.ajax({
                      url:'scripts/inits.php',
                      method:'post',
                      data:{actionStatus:actionStatus},
                      beforeSend:function(){
                          $('#showStatus').html('<img src="'+gifPath+'" alt="loader">&nbsp;Check...');
                        },
                      success:function(response){
                         $('#requestStatus')[0].reset();
                          $('#showStatus').html("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-circle'></i>&nbsp;<span>"+response+"</span><br><span>("+requestStatusCheck+")</span></div>");
                             // setTimeout(function(){
                             //    location.reload();
                             //  },6000);
                      }
                    });//ajax call
               break;

               case 'Sabbatical Leave':

                      actionStatus = 'Sableave';
                   $.ajax({
                      url:'scripts/inits.php',
                      method:'post',
                      data:{actionStatus:actionStatus},
                      beforeSend:function(){
                          $('#showStatus').html('<img src="'+gifPath+'" alt="loader">&nbsp;Check...');
                        },
                      success:function(response){
                         $('#requestStatus')[0].reset();
                          $('#showStatus').html("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-circle'></i>&nbsp;<span>"+response+"</span><br><span>("+requestStatusCheck+")</span></div>");
                             // setTimeout(function(){
                             //    location.reload();
                             //  },6000);
                      }
                    });//ajax call

               break;

               case 'Casual Leave':
                  actionStatus = 'casLeave';
                      $.ajax({
                      url:'scripts/inits.php',
                      method:'post',
                      data:{actionStatus:actionStatus},
                      beforeSend:function(){
                          $('#showStatus').html('<img src="'+gifPath+'" alt="loader">&nbsp;Check...');
                        },
                      success:function(response){
                         $('#requestStatus')[0].reset();
                          $('#showStatus').html("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-circle'></i>&nbsp;<span>"+response+"</span><br><span>("+requestStatusCheck+")</span></div>");
                             // setTimeout(function(){
                             //    location.reload();
                             //  },6000);
                      }
                    });//ajax call
               break;

               case 'Medical Leave':
                      actionStatus = 'medicLeave';
                      $.ajax({
                      url:'scripts/inits.php',
                      method:'post',
                      data:{actionStatus:actionStatus},
                      beforeSend:function(){
                          $('#showStatus').html('<img src="'+gifPath+'" alt="loader">&nbsp;Check...');
                        },
                      success:function(response){
                         $('#requestStatus')[0].reset();
                          $('#showStatus').html("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-circle'></i>&nbsp;<span>"+response+"</span><br><span>("+requestStatusCheck+")</span></div>");
                             // setTimeout(function(){
                             //    location.reload();
                             //  },6000);
                      }
                    });//ajax call
               break;

               // case 'Study Leave':
               //        actionStatus = 'studLeave';
               //        $.ajax({
               //        url:'scripts/inits.php',
               //        method:'post',
               //        data:{actionStatus:actionStatus},
               //        beforeSend:function(){
               //            $('#showStatus').html('<img src="'+gifPath+'" alt="loader">&nbsp;Check...');
               //          },
               //        success:function(response){
               //           $('#requestStatus')[0].reset();
               //            $('#showStatus').html("<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='fa fa-circle'></i>&nbsp;<span>"+response+"</span><br><span>("+requestStatusCheck+")</span></div>");
               //               // setTimeout(function(){
               //               //    location.reload();
               //               //  },6000);
               //        }
               //      });//ajax call
               // break;

               default: location.reload();
            }

  });


  setInterval(function(){
    showActiveRequest();
  },1000);

  showActiveRequest();


function showActiveRequest(){
    action = 'showActiveServerSide';
    $.ajax({
      url:'scripts/inits.php',
      method:'post',
      data:{action:action},
      success:function(response){
        console.log(response);
        $('#showActive').html(response);
      }
    })
  }



// update last lastLogin
update_employee();

        function update_employee()
        {
            var action = 'update_emp';
            $.ajax({
               url:"scripts/inits.php",
               method:"POST",
               data:{action:action},
               success:function(response)
               {
                 console.log(response);

               },
               error:function(){alert("something went wrong ")}

            });
        }
   setInterval(function(){
     update_employee();
  }, 1000);



})


</script>
<script src="form-action.js"></script>
<script type="text/javascript" src="notificationjs.js"></script>
