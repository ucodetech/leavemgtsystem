<?php
    require_once '../../core/init.php';
   if (!isLoggedInAdmin()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('../../sudo-login');

    }

    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

    $msg = '';
    $general = new General();
    $admin = new Admin();
    $leave = new Leave();
    $getSignature = $admin->adminGetSignatures($admin->data()->id);


    if (isset($_GET['detail']) && !empty($_GET['detail'])) {
    	$detail = (int)$_GET['detail'];

    	$leaveRequest = $leave->getLeaveRequestDetail('maternityLeave',$detail);
			if ($leaveRequest) {

				//this grabs leave details


				
				$leaveFrom  = $leaveRequest->leaveFrom;
				$dueToDeliver =  $leaveRequest->dueToDeliver;
				$medicalOfficerSignature  = $leaveRequest->medicalOfficerSignature;
				$medicalOfficer_DateSignature =  $leaveRequest->medicalOfficer_DateSignature;
				$leaveFrom = pretty_dates($leaveFrom);
				$dueToDeliver = pretty_dates($dueToDeliver);
				if ($medicalOfficerSignature == null)
				 {
					$displaySignature = '<span class="text-danger">Medical Director Have Not approved this request!</span>';
					$displaymedicalOfficer_DateSignature = ' ';
				}else{
					$displaySignature = '<img src="../../../lms_Admin/signatures/'.$medicalOfficerSignature.'" alt="signature" width="205">';
;
					$displaymedicalOfficer_DateSignature = pretty_dates($medicalOfficer_DateSignature);
				}




				// this grabs user details 
				$user = new User($leaveRequest->user_id);
				$userfull = $user->data()->full_name;
				$displayName = explode(' ', $userfull);
				$fullname = $displayName[0];

				$passport = $user->data()->passport;
				$department = $user->data()->department;
				$full_name = $user->data()->full_name;
				$email = $user->data()->email;
				$gender = $user->data()->gender;
				$state = $user->data()->state;
				$phone_number = $user->data()->phone_number;
				$fileNo = $user->data()->fileNo;
				$typeOfEmploy = $user->data()->typeOfEmploy;
				
				$displyPassport = '../../../employeePortal/avaters/'.$passport;



				?>

				   <style>

#updateError{
    font-size: 1.0rem;
	text-align: left;
	border-radius: 20px;

}
#showError{
	position: fixed;
	z-index: 1;
	top:10%;
	right: 2%;
	width: 100%;
	height: auto;

}
.employeeProfile{
	width: 150px;
	height: 150px;
	border-radius: 20%;
	border: 5px double orangered;
}
				   </style> <!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
				    <!-- Content Header (Page header) -->
				    <div class="content-header">
				      <div class="container-fluid myPage">
				       Maternity <?php echo $title;?> Request<br>
				        <?=$msg ?>
				      </div>
				       <div id="showError">

				       </div><!-- /.container-fluid -->
				    </div>
				    <!-- /.content-header -->

				    <!-- Main content -->
				    <div class="content">
				      <div class="container-fluid">
				      	<div class="row p-2">
				      		<div class="col-lg-6 shadow-lg">
				      			<h2 class="text-center text-info">
				      				<?=$fullname;?>'s Details <hr>
				      			</h2>
				      			<div class="text-center">
				      				<img src="<?=$displyPassport;?>" alt="<?=$fullname;?>" class="img-fliud employeeProfile">
				      			</div><br>
				      			<div class="row">
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="Name:<?=$userfull?>" class="form-control form-control-lg" readonly>
				      				</div>
				      			
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="Email:<?=$email?>" class="form-control form-control-lg" readonly>
				      				</div>
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="File No:<?=$fileNo?>" class="form-control form-control-lg" readonly>
				      				</div>
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="Sex:<?=$gender?>" class="form-control form-control-lg" readonly>
				      				</div>
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="State:<?=$state?>" class="form-control form-control-lg" readonly>
				      				</div>
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="Dept:<?=$department?>" class="form-control form-control-lg" readonly>
				      				</div>
				      				<div class="form-group col-md-6">
				      					<input type="disabled" value="Type Of Emp:<?=$typeOfEmploy?>" class="form-control form-control-lg" readonly>
				      				</div>
				      			</div>
				      		</div>
				      		<div class="col-lg-6 shadow-lg">
				      			<h2 class="text-center text-info">
				      				Leave Details
				      			</h2><hr>
				      			<form action="#" id="approveLeave" method="post">
				      			<div class="row">
				      				<input type="hidden" name="leaveID" id="leaveID" value="<?=$detail;?>">
				      				<div class="form-group col-md-6">
				      					Leave From:<input type="disabled" value="<?=$leaveFrom?>" class="form-control form-control-lg" readonly>
				      				</div>
				      			
				      				<div class="form-group col-md-6">
				      					Due to Deliver On: <input type="disabled" value="<?=$dueToDeliver?>" class="form-control form-control-lg" readonly>
				      				</div>
				      				<?php if (!hasPermissionMedical()): ?>
				      					<div class="form-group col-md-6">
				      					Doctor's Signature:<span>
				      						<?=$displaySignature?>
				      						<br>
				      						<?=$displaymedicalOfficer_DateSignature?>
				      					</span>
				      				</div>		      				
				      				<?php endif ?>			      			
				      				

				      				<?php if (hasPermissionMedical()): ?>
				      					<div class="row">
				      					<div class="form-group col-lg-12">
				      						<input type="hidden" name="medicSignature" id="medicSignature" value="<?=$getSignature->signature;?>">
				      						<button class="btn btn-success approveRequestMedical" type="submit" id="approveRequestMedical">Approve Medic</button>
				      					</div>
				      				</div>
				      				<?php endif ?>
				      				
				      				<?php if (hasPermissionHR()): ?>
				      					<div class="row">
				      					<div class="form-group col-lg-6">
				      						<button class="btn btn-danger" type="submit" id="declineRequestHR">Decline Hr</button>
				      					</div>
				      					<div class="form-group col-lg-6">
				      						<button class="btn btn-info approveRequestHR" type="submit" id="approveRequestHR">Approve Hr</button>
				      					</div>
				      				</div>
				      				<?php endif ?>
				      				
				      			</div>
				      		</form>
				      			<hr>
				      			<?php if (hasPermissionHR()): ?>
				      				<?php if ($medicalOfficerSignature != null): ?>
			
				      				<span class="text-info">
				      				Recommendation for maternity leave. Mrs. <?=$full_name;?>&nbsp; Department of &nbsp; <?=$department;?>&nbsp; is due to deliver around &nbsp;<?=$dueToDeliver;?>&nbsp; Therefore Recommend that she be allowed to commence on maternity leave with effect on &nbsp;<?=$leaveFrom;?>&nbsp;
				      			</span>
				      			<?php endif ?>
				      			<?php endif; ?>
				      		</div>
				      	</div>
				      </div>
				  </div>
				</div>

				<?

			}

		}
			?>
<?php require_once APPROOT . '/includes/footerportal.php';?>

<script>
	$(document).ready(function(){
		//approve
		$('#approveRequestMedical').click(function(e){
			e.preventDefault();
			
			$.ajax({
				url:'../process.php',
				method:'post',
				data:$('#approveLeave').serialize()+'&action=leaveIDAccpt',
				beforeSend:function(){
					$('#approveRequestMedical').html('Please Wait...');
				},
				success:function(response){
					$('#showError').html(response);
				},
				complete:function(){
					$('#approveRequestMedical').html('Approve Medic');
				}
			})
		});



	$('#approveRequestHR').click(function(e){
			e.preventDefault();
			
			$.ajax({
				url:'../process.php',
				method:'post',
				data:$('#approveLeave').serialize()+'&action=leaveIDAccptHR',
				beforeSend:function(){
					$('#approveRequestHR').html('Please Wait...');
				},
				success:function(response){
					$('#showError').html(response);
				},
				complete:function(){
					$('#approveRequestHR').html('Approve HR');
				}
			})
		});	

//decline
$('#declineRequestHR').click(function(e){
			e.preventDefault();
			
			$.ajax({
				url:'../process.php',
				method:'post',
				data:$('#approveLeave').serialize()+'&action=leaveIDReject',
				beforeSend:function(){
					$('#declineRequestHR').html('Please Wait...');
				},
				success:function(response){
					$('#showError').html(response);
				},
				complete:function(){
					$('#declineRequestHR').html('Decline HR');
				}
			})
		})

	})
</script>