<div class="container shadow-lg" id="requestLeaveBox" style="display:none;">
	<form action="#" method="post" enctype="multipart/form-data" id="requestLeaveForm">
		<div class="row">
			<div class="form-group col-md-12">
			<label for="typeOfLeave">Type of Leave:<sup class="text-danger">*</sup></label>
				<select name="typeOfLeave" id="typeOfLeave" class="form-control form-control-lg">
				<option value="">Select Type Of leave</option>

						<?php 
						$leaves = $category->getCategory();
						foreach($leaves as $leavCate ):
						  ?>
					<option value="<?=$leavCate->category;?>"><?=$leavCate->category;?></option>
						<?php endforeach; ?>
				</select>
			</div>
		</div><hr>
		<div class="row" id="otherForm">
			<div class="form-group col-md-4">
				<label for="fullname">Full Name: <sup class="text-danger">*</sup></label>
				<input type="disabled" id="fullname" name="fullname" class="form-control" readonly value="<?=$user->data()->full_name?>">
			</div>
			<div class="form-group col-md-4">
				<label for="fileNo">File No: <sup class="text-danger">*</sup></label>
				<input type="disabled" id="fileNo" name="fileNo" class="form-control" readonly value="<?=$user->data()->fileNo?>">
			</div>
			<div class="form-group col-md-4">
				<label for="department">Deparment:<sup class="text-danger">*</sup></label>
				<input type="disabled" id="department" name="department" class="form-control" readonly value="<?=$user->data()->department?>">
			</div>
			
			<div class="form-group col-md-4" id="typeOfEmployBox">
				<label for="typeOfEmploy">Type of Employment:<sup class="text-danger">*</sup></label>
				<input type="disabled" id="typeOfEmploy" name="typeOfEmploy" class="form-control" readonly value="<?=$user->data()->typeOfEmploy?>">
			</div>
			<div class="form-group col-md-4" id="phoneNoBox">
				<label for="phoneNo">Phone No:<sup class="text-danger">*</sup></label>
				<input type="disabled" id="phoneNo" name="phoneNo" class="form-control" readonly value="<?=$user->data()->phone_number?>">
			</div>
			<div class="form-group col-md-4" id="signatureBox">
				<label for="singature">Signature:<sup class="text-danger">*</sup></label>
				<input type="disabled" id="signature" name="signature" class="form-control" readonly value="<?=$signed->empSignature?>">
			</div>
			

			<div class="form-group col-md-4" id="salaryGradeLevelBox">
				<label for="salaryGradeLevel">Grade Level:<sup class="text-danger">*</sup></label>
				<input type="text" id="salaryGradeLevel" name="salaryGradeLevel" class="form-control">
			</div>
			<div class="form-group col-md-4" id="rankBox"> <label for="rank">Rank: <sup class="text-danger">*</sup></label>
				<input type="text" id="rank" name="rank" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="DateARBox">
				<label for="DateAR">Date of Assumption/
					Resumption from last Leave:<sup class="text-danger">*</sup></label>
				<input type="date" id="DateAR" name="DateAR" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="dateProceedLeaveBox">
				<label for="dateProceedLeave">Date Proceeding on Leave:<sup class="text-danger">*</sup></label>
				<input type="date" id="dateProceedLeave" name="dateProceedLeave" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="dateReturningLeaveBox">
				<label for="dateReturningLeave">Date Returning to Duty:<sup class="text-danger">*</sup></label>
				<input type="date" id="dateReturningLeave" name="dateReturningLeave" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="expirationDateBox">
				<label for="expirationDate">Exipration Date:<sup class="text-danger">*</sup></label>
				<input type="date" id="expirationDate" name="expirationDate" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="organisationBox">
				<label for="organisation">The Organisation:<sup class="text-danger">*</sup></label>
				<input type="text" id="organisation" name="organisation" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="dueToDeliverBox">
				<label for="dueToDeliver">Due to Deliver:<sup class="text-danger">*</sup></label>
				<input type="date" id="dueToDeliver" name="dueToDeliver" class="form-control" >
			</div>
			<div class="form-group col-md-4" id="addressBox">
				<label for="address">Address while On leave:<sup class="text-danger">*</sup></label>
				<textarea  id="address" name="address" class="form-control"></textarea>
			</div>
			<div class="clear-fix"></div>
			<div class="form-group col-md-12">
				<button type="submit" class="btn btn-info btn-block" id="requestBtn">Request</button>
			</div>

		</div>
	</form>
</div>
         