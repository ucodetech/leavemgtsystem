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

$leaveRequest = $leave->getLeaveRequestDetail('annaulLeaveRequest',$detail);
if ($leaveRequest) {

			//this grabs leave details


	$full_name = $leaveRequest->full_name;
	$file_no = $leaveRequest->file_no;
	$department = $leaveRequest->department;
	$salary_grade_level = $leaveRequest->salary_grade_level;
	$rank = $leaveRequest->rank;
	$typeOfEmployment = $leaveRequest->typeOfEmployment;
	$dateOfARofDuty = $leaveRequest->dateOfARofDuty;
	$dateOfProceedingOnLeave = $leaveRequest->dateOfProceedingOnLeave;
	$dateReturningToDuty = $leaveRequest->dateReturningToDuty;
	$phoneNo = $leaveRequest->phoneNo;
	$address = $leaveRequest->address;
	$signatureOfEmployee = $leaveRequest->signatureOfEmployee;
	$signatureDate = $leaveRequest->signatureDate;
	$recommendationOfHOD = $leaveRequest->recommendationOfHOD;
	$HodSignature = $leaveRequest->HodSignature;
	$HodDateSigned = $leaveRequest->HodDateSigned;


	$fullname = strtok($full_name, '');
	$signatureDate = pretty_dates($signatureDate);
	$dateReturningToDuty = pretty_dates($dateReturningToDuty);
	$dateOfARofDuty = pretty_dates($dateOfARofDuty);
	$dateOfProceedingOnLeave = pretty_dates($dateOfProceedingOnLeave);

	$signatureOfEmployee = '<img src="../../../employeePortal/avaters/'.$signatureOfEmployee.'" width="108" class="img-fluid" alt="Employee signatures">';

	$personel_approvedFrom = $leaveRequest->personel_approvedFrom; 
	$personel_approvedTo = $leaveRequest->personel_approvedTo;

	$user = new User($file_no);

	$empID = $user->data()->id;

	// start from here tomorrow


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
		.drawLine{
			background: none;
			border-bottom: 2px solid #000;
			height: 5px;
			width: 30%;
		}
		input[type="text"], input[type="date"]{
			border: 0;
			background: none;
			border-bottom: 2px dotted #000;
		}
		input[type="text"]:hover, input[type="date"]:hover{
			background: none;
		}
		input[type="text"]:focus, input[type="date"]:focus{
			background: none;
		}
		input[type="text"]:visited, input[type="date"]:visited{
			background: none;
		}
		input[type="text"]:active, input[type="date"]:active{
			background: none;
		}

		.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
			cursor: not-allowed;
			border: 0;
			background: none;
			border-bottom: 2px dotted #000;
			opacity: 1;
		}


	</style> <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid myPage">
				Annual <?php echo $title;?> Request<br>
				<?=$msg;?>
			</div>
			<div id="showError">

			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<div class="container shadow-lg">
					<div class="text-center" style="line-height:1px;">
						<h2>THE FEDERAL POLYTECHNIC, IDAH</h2>
						<p>OFFICE OF THE REGISTRAR</p>
						<span>(PERSONNEL DIVISION)</span>
					</div><hr>
					<!-- detail row -->
					<form action="#" method="post" id="approveLeaveForm">
						<!--  employee detail and leave row -->

						<div class="mb-3 row">
							<!-- input start -->
							<label for="fullname" class="col-sm-2 col-form-label">Name of Staff:</label>
							<div class="col-sm-6">
								<input type="disabled" class="form-control" name="fullname" id="fullname" value="<?=$full_name;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="FileNo" class="col-sm-1 col-form-label">File Number:</label>
							<div class="col-sm-3">
								<input type="disabled" name="FileNo" class="form-control" id="FileNo" value="<?=$file_no;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="salaryGradeLevel" class="col-sm-2 col-form-label">Salary Grade Leave:</label>
							<div class="col-sm-4">
								<input type="disabled" name="salaryGradeLevel" class="form-control" id="salaryGradeLevel" value="<?=$salary_grade_level;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="rank" class="col-sm-2 col-form-label">Rank:</label>
							<div class="col-sm-4">
								<input type="disabled" name="rank" class="form-control" id="rank" value="<?=$rank;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="typeOfEmployment" class="col-sm-6 col-form-label">Type of employment (Temporary or Permanent):</label>
							<div class="col-sm-6">
								<input type="disabled" name="typeOfEmployment" class="form-control" id="typeOfEmployment" value="<?=$typeOfEmployment;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="dateOfARofDuty" class="col-sm-6 col-form-label">Date of Assumption of Duty/Resumption from last Leave:</label>
							<div class="col-sm-6">
								<input type="disabled" name="dateOfARofDuty" class="form-control" id="dateOfARofDuty" value="<?=$dateOfARofDuty;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="dateOfProceedingOnLeave" class="col-sm-6 col-form-label">Date Proceeding on Leave:</label>
							<div class="col-sm-6">
								<input type="disabled" name="dateOfProceedingOnLeave" class="form-control" id="dateOfProceedingOnLeave" value="<?=$dateOfProceedingOnLeave;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="dateReturningToDuty" class="col-sm-6 col-form-label">Date Returning to Duty:</label>
							<div class="col-sm-6">
								<input type="disabled" name="dateReturningToDuty" class="form-control" id="dateReturningToDuty" value="<?=$dateReturningToDuty;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="address" class="col-sm-2 col-form-label">Address while on leave:</label>
							<div class="col-sm-6">
								<input type="disabled" name="address" class="form-control" id="address" value="<?=$address;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="phoneNo" class="col-sm-2 col-form-label">Phone No:</label>
							<div class="col-sm-2">
								<input type="disabled" name="phoneNo" class="form-control" id="phoneNo" value="<?=$phoneNo;?>" readonly>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="signatureOfEmployee" class="col-sm-2 col-form-label">Signature:</label>
							<div class="col-sm-4 mb-3">
								<span><?=$signatureOfEmployee;?></span>
							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="signatureDate" class="col-sm-2 col-form-label">Date:</label>
							<div class="col-sm-4">
								<input type="disabled" name="signatureDate" class="form-control" id="signatureDate" value="<?=$signatureDate;?>" readonly>
							</div>
							<!-- input end -->

						</div>
						<!-- end employee detail and leave row -->
						<!-- recommendation of Head of Deparmtment row -->
						<hr class="hr">
						<div class="mb-3 row">
							<?php 
							if ($leaveRequest->recommendationOfHOD == null) {
								if (hasPermissionHR()) {
									?>
									<span class="text-danger text-md">Head of Deparmtment have not approved this leave request!</span>
									<?
								}elseif(hasPermissionHOD()){
									?>
									<!-- input start -->
									<label for="recommendationOfHOD" class="col-sm-4 col-form-label">Recommendation of Head of Department:</label>
									<div class="col-sm-8">
										<input type="text" name="recommendationOfHOD" class="form-control" id="recommendationOfHOD">
									</div>
									<!-- input end -->
									<?		
								}
							}else{
								if (hasPermissionHOD()) {
									?>
									<label for="recommendationOfHODUpdate" class="col-sm-4 col-form-label">Recommendation of Head of Department:</label>
									<div class="col-sm-8">
										<input type="text" name="recommendationOfHODUpdate" class="form-control" id="recommendationOfHODUpdate" value="<?=$recommendationOfHOD;?>">
									</div>
									<?
								}
								if (hasPermissionHR()) {
									?>
									<!-- input start -->
									<label for="recommendationOfHODs" class="col-sm-4 col-form-label">Recommendation of Head of Department:</label>
									<div class="col-sm-8">
										<input type="disabled" class="form-control" id="recommendationOfHODs" value="<?=$recommendationOfHOD;?>" readonly>
									</div>
									<!-- input end -->
									<?
								}

							}

							?>


							<!-- input start -->
							<label for="signatureOfHOD" class="col-sm-2 col-form-label">HOD Signature:</label>
							<div class="col-sm-4 mb-3">
								<?php 
								if ($leaveRequest->HodSignature == null) {
									if (hasPermissionHR()) {
										?>
										<span class="text-danger text-md">Not Approved yet</span>
										<?
									}elseif(hasPermissionHOD()){
										?>
										<input type="disabled" name="HodSignature" class="form-control" id="HodSignature" value="<?=$getSignature->signature;?>" readonly>
										<?		
									}
								}else{
									?>
									<img src="../../signatures/<?=$HodSignature?>" width="108" class="img-fluid" alt="HOD Signature">
									<?
								}

								?>


							</div>
							<!-- input end -->
							<!-- input start -->
							<label for="date" class="col-sm-2 col-form-label">Date:</label>
							<div class="col-sm-4">
								<?php 
								if ($leaveRequest->HodDateSigned == null) {
									if (hasPermissionHR()) {
										?>
										<span class="text-danger text-sm">No Date Yet</span>
										<?
									}elseif(hasPermissionHOD()){
										?>
										<input type="date" name="dateSigned" class="form-control" id="dateSigned">
										<?		
									}
								}else{
									if (hasPermissionHR()) {
		    							?>
		    							Current Date:<input type="disabled"  class="form-control"  value="<?=pretty_dates($leaveRequest->HodDateSigned);?>" readonly> <hr>
		    							<?
									}elseif(hasPermissionHOD()){
										?>
										Current Date:<input type="disabled"  class="form-control"  value="<?=pretty_dates($leaveRequest->HodDateSigned);?>" readonly> <hr>
										<input type="date" name="dateUpdated" class="form-control" id="dateUpdated" value="<?=pretty_dates($leaveRequest->HodDateSigned);?>">
										<?
									}
								}

								?>


							</div>
							<!-- input end -->
						</div>
						<hr class="invisible">
						<?php if (hasPermissionHOD()): ?>
							<?php if ($leaveRequest->HodSignature == null): ?>
								<center>
									<div class="col-md-6">
										<button class="btn btn-warning btn-block" id="approveRequestBtnHOD" type="submit"><i class="fa fa-check fa-lg"></i>&nbsp;Approve</button>
									</div><hr class="invisible">
									<div id="Errors"></div>
								</center>
								<?php else:?>
									<center>
										<div class="col-md-6">
											<button class="btn btn-danger btn-block" id="updateRequestBtnHOD" type="submit"><i class="fa fa-check fa-lg"></i>&nbsp;Edit</button>
										</div><hr class="invisible">
										<div id="Errors"></div>
									</center>
								<?php endif ?>

							<?php endif ?>

							<!-- end of recommendation of Head of Deparmtment -->
							<!-- recommendation of Head of Deparmtment row -->
							<?php if (hasPermissionHR()):?>
								<hr class="hr">
								<p class="text-center text-bold">Official Use(Personnel Division)
								<br>Approval
								</p>

								<?php if ($leaveRequest->approved == 1): ?>
								<div class="mb-3 row">
									<!-- input start -->
									<label for="leaveFrom" class="col-sm-2 col-form-label">Leave From:</label>
									<div class="col-sm-4">
										<input type="disabled" name="leaveFrom" class="form-control" id="leaveFrom" value="<?=$personel_approvedFrom;?>" readonly>
									</div>
									<!-- input end -->
									<!-- input start -->
									<label for="leaveTo" class="col-sm-2 col-form-label">To:</label>
									<div class="col-sm-4">
										<input type="disabled" name="leaveTo" class="form-control" id="leaveTo" value="<?=$personel_approvedTo;?>" readonly>
									</div>
									<!-- input end -->							    
								</div>
								<?php 
										$date = date('Y-m-d');
									if ($date == $leaveRequest->personel_DateSignature): ?>
										<p class="text-center text-danger">Update Leave From and To if neccessary!</p>
									<div class="mb-3 row">
									<!-- input start -->
									<input type="hidden" name="empId" id="empId" value="<?=$empID?>">

									<label for="leaveFromUpdate" class="col-sm-2 col-form-label">Leave From:</label>
									<div class="col-sm-4">
										<input type="date" name="leaveFromUpdate" class="form-control" id="leaveFromUpdate" >
									</div>
									<!-- input end -->
									<!-- input start -->
									<label for="leaveToUpdate" class="col-sm-2 col-form-label">To:</label>
									<div class="col-sm-4">
										<input type="date" name="leaveToUpdate" class="form-control" id="leaveToUpdate">
									</div>
									<!-- input end -->							    
								</div>
									<?php endif;?>
								<?php else: ?>
								<div class="mb-3 row">
									<!-- input start -->
									<label for="leaveFrom" class="col-sm-2 col-form-label">Leave From:</label>
									<div class="col-sm-4">
										<input type="date" name="leaveFrom" class="form-control" id="leaveFrom" >
									</div>
									<!-- input end -->
									<!-- input start -->
									<label for="leaveTo" class="col-sm-2 col-form-label">To:</label>
									<div class="col-sm-4">
										<input type="date" name="leaveTo" class="form-control" id="leaveTo">
									</div>
									<!-- input end -->							    
								</div>

								<?php endif;?>

							

								<center>
									<div class="col-md-6">
										<input type="hidden" name="empFileNo" id="empFileNo" value="<?=$file_no?>">
										<input type="hidden" name="empId" id="empId" value="<?=$empID?>">
										<input type="hidden" name="personel_registrarSignature" class="form-control" id="personel_registrarSignature" value="<?=$getSignature->signature?>">
										<img src="../../signatures/<?=$getSignature->signature?>" width="108" class="img-fluid" alt="HOD Signature">
										<hr class="hrs">
										<label for="personel_registrarSignature">For: Registrar</label>
									</div>
								</center>	<hr class="invisible">
								<?php if ($leaveRequest->approved != 1): ?>
								<center>
									<div class="col-md-6">
										<button class="btn btn-danger btn-block" id="approveRequestPersonnelBtn" type="submit"><i class="fa fa-check fa-lg"></i>&nbsp;Approve</button>
									</div><hr class="invisible">
									<div id="Error"></div>
								</center>
								<?php else: ?>
									<?php 
										$date = date('Y-m-d');
									if ($date == $leaveRequest->personel_DateSignature): ?>
								<center>
									<div class="col-md-6">
										<button class="btn btn-danger btn-block" id="updateRequestPersonnelBtn" type="submit"><i class="fa fa-check fa-lg"></i>&nbsp;Update Only for today</button>
									</div><hr class="invisible">
									<div id="Error"></div>
								</center>
								<?php else: ?>
									<center>
									<span class="text-info text-center lead">This Leave is currently running and no further action can be taken! Superuser</span>
								</center><hr>
								<?php endif ?>
								
								<?php endif;?>
							<?php endif;?>
							<!-- end of recommendation of Head of Deparmtment -->
						</form>
						<span class="text-sm mb-5">Distribution: Head Of Department</span>
						<!-- end of detail row -->
						<!-- end of container -->
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
	//approve hod
	$('#approveRequestBtnHOD').click(function(e){
		e.preventDefault();

		recommendationOfHOD  = $('#recommendationOfHOD').val();
		HodSignature = $('#HodSignature').val();
		dateSigned = $('#dateSigned').val();
		leaveIDAnnual = '<?=$detail?>';
		action = 'HodApprove';

		$.ajax({
			url:'../process.php',
			method:'post',
			data:{recommendationOfHOD:recommendationOfHOD, HodSignature:HodSignature, dateSigned:dateSigned, leaveIDAnnual:leaveIDAnnual, action:action},
			beforeSend:function(){
				$('#approveRequestBtnHOD').html('Please Wait...');
			},
			success:function(response){
				$('#Errors').html(response);
				setTimeout(function(){
					location.reload();
				},2000);
			},
			complete:function(){
				$('#approveRequestBtnHOD').html('<i class="fa fa-check fa-lg"></i>&nbsp;Approve');
			}
		})
	});

	//update hod
	$('#updateRequestBtnHOD').click(function(e){
		e.preventDefault();

		recommendationOfHODUpdate  = $('#recommendationOfHODUpdate').val();
		dateUpdated = $('#dateUpdated').val();
		leaveIDAnnual = '<?=$detail?>';
		action = 'HodUpdate';

		$.ajax({
			url:'../process.php',
			method:'post',
			data:{recommendationOfHODUpdate:recommendationOfHODUpdate, dateUpdated:dateUpdated, leaveIDAnnual:leaveIDAnnual, action:action},
			beforeSend:function(){
				$('#updateRequestBtnHOD').html('Updating...');
			},
			success:function(response){
				$('#Errors').html(response);
				setTimeout(function(){
					location.reload();
				},2000);
			},
			complete:function(){
				$('#updateRequestBtnHOD').html('<i class="fa fa-check fa-lg"></i>&nbsp;Update');
			}
		})
	});


	//approve personnel department
	$('#approveRequestPersonnelBtn').click(function(e){
		e.preventDefault();

		leaveFrom  = $('#leaveFrom').val();
		leaveTo = $('#leaveTo').val();
		personel_registrarSignature = $('#personel_registrarSignature').val();
		leaveIDAnnual = '<?=$detail?>';
		empFileNo = $('#empFileNo').val();
		empId = $('#empId').val();
		action = 'PersonnelApprove';

		$.ajax({
			url:'../process.php',
			method:'post',
			data:{leaveFrom:leaveFrom, leaveTo:leaveTo, personel_registrarSignature:personel_registrarSignature, leaveIDAnnual:leaveIDAnnual,empFileNo:empFileNo,empId:empId, action:action},
			beforeSend:function(){
				$('#approveRequestPersonnelBtn').html('Please Wait...');
			},
			success:function(response){
				$('#Error').html(response);
				setTimeout(function(){
					location.reload();
				},2000);
			},
			complete:function(){
				$('#approveRequestPersonnelBtn').html('<i class="fa fa-check fa-lg"></i>&nbsp;Approve');
			}
		})
	});



	//update personnel department
	$('#updateRequestPersonnelBtn').click(function(e){
		e.preventDefault();

		leaveFromUpdate  = $('#leaveFromUpdate').val();
		leaveToUpdate = $('#leaveToUpdate').val();
		leaveIDAnnual = '<?=$detail?>';
		empId = $('#empId').val();
		action = 'PersonnelUpdate';

		$.ajax({
			url:'../process.php',
			method:'post',
			data:{leaveFromUpdate:leaveFromUpdate, leaveToUpdate:leaveToUpdate,leaveIDAnnual:leaveIDAnnual,empId:empId,action:action},
			beforeSend:function(){
				$('#updateRequestPersonnelBtn').html('Updating...');
			},
			success:function(response){
				$('#Error').html(response);
				setTimeout(function(){
					location.reload();
				},2000);
			},
			complete:function(){
				$('#updateRequestPersonnelBtn').html('<i class="fa fa-check fa-lg"></i>&nbsp;Update');
			}
		})
	});




})
</script>