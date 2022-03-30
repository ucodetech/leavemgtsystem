<?php 

/**
 * Leave
 */
class Leave 
{
		private $_db,
				$_user,
				$_admin;

	function __construct()
	{
		$this->_db = Database::getInstance();
		$this->_user = New User();
		$this->_admin = new Admin();
		
	}


public function MakeRequest($table, $field = array())
{
	$this->_db->insert($table, $field);	
	
}
public function admin(){
	return $this->_admin;
}
public function fetchRequests($table)
{
	if (hasPermissionSuper() || hasPermissionHR()) {
		return $this->_db->get($table, array('deleted', '=', 0));
	}else{
		$department = $this->admin()->data()->sudo_department;
		return $this->_db->get($table, array('department', '=', $department));
	}
	
	
}


public function fetchRequestsById($table, $requestId)
{
	$data = $this->_db->get($table, array('id', '=', $requestId));
	if ($data->count()) {
		return $data->first();
	}else{
		return false;
	}
}


public function getAnnaulLeave()
{
	$data = $this->fetchRequests('annaulLeaveRequest');
	$output = '';
	if ($data->count()) {
		$row =  $data->results();
		$output .= '<table class="table table-stripped table-condensed" id="showAnnualLeave">
					<thead>
						<th>ID</th>
						<th>Employee Name</th>
						<th>File No</th>
						<th>Department</th>
						<th>Date Proceeding On Leave</th>
						<th>Date Returning to Duty</th>
						<th>Approved</th>
						<th>Details</th>
						<th>Delete</th>
					</thead>
					<tbody>';
		foreach ($row as $alr) {
				if ($alr->approved == 0) {
					$yes = '<span class="text-danger">No</span>';
				}else{
					$yes = '<span class="text-success">Yes</span>';
				}
				
				
					$output .=' <tr>
							<td>'.$alr->id.'</td>
							<td>'.$alr->full_name.'</td>
							<td>'.$alr->file_no.'</td>
							<td>'.$alr->department.'</td>
							<td>'.$alr->dateOfProceedingOnLeave.'</td>
							<td>'.$alr->dateReturningToDuty.'</td>
							<td>'.$yes.'</td>
							<td>
								<a href="details/annual-Leave/'.$alr->id.'" class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i>Detail</a>
							</td>
							<td>
								<a href="#" id="'.$alr->id.'" class="btn btn-danger btn-sm deleteAnnualBtn" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i>Delete</a>
							</td>
						</tr>';
					
			
		}
	$output .= '</tbody>
				</table>';

	return $output;
	}else{
		return '<span class="text-center text-info text-lg">No Data In Database Table Yet</span>';
	}
	
}

public function getSabaticalLeave()
{
	$data = $this->fetchRequests('sabaticalLeave');
	$output = '';
	if ($data->count()) {
		$row =  $data->results();
		$output .= '<table class="table table-stripped table-condensed" id="showSabaticalLeave">
					<thead>
						<th>ID</th>
						<th>Employee Name</th>
						<th>File No</th>
						<th>Department</th>
						<th>Date Proceeding On Leave</th>
						<th>Date Returning to Duty</th>
						<th>Approved</th>
						<th>Details</th>
						<th>Delete</th>
					</thead>
					<tbody>';
		foreach ($row as $alr) {
				if ($alr->approved == 0) {
					$yes = '<span class="text-danger">No</span>';
				}else{
					$yes = '<span class="text-success">Yes</span>';
				}
				
				
					$output .=' <tr>
							<td>'.$alr->id.'</td>
							<td>'.$alr->full_name.'</td>
							<td>'.$alr->file_no.'</td>
							<td>'.$alr->department.'</td>
							<td>'.$alr->dateOfProceedingOnLeave.'</td>
							<td>'.$alr->expirationDate.'</td>
							<td>'.$yes.'</td>
							<td>
								<a href="details/sabatical-Leave/'.$alr->id.'" class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i>Detail</a>
							</td>
							<td>
								<a href="#" id="'.$alr->id.'" class="btn btn-danger btn-sm deleteSabaticalBtn" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i>Delete</a>
							</td>
						</tr>';
					
			
		}
	$output .= '</tbody>
				</table>';

	return $output;
	}else{
		return '<span class="text-center text-info text-lg">No Data In Database Table Yet</span>';
	}
	
}
public function getMaternityLeave()
{
	$sql = "SELECT * FROM maternityLeave WHERE pending  = 1 ";
	$data = $this->_db->query($sql);
	$output = '';
	if ($data->count()) {
		$row =  $data->results();
		$output .= '<table class="table table-stripped table-condensed" id="showMaternityLeave">
					<thead>
						<th>ID</th>
						<th>Employee Name</th>
						<th>File No</th>
						<th>Department</th>
						<th>Date Proceeding On Leave</th>
						<th>Approved</th>
						<th>Details</th>
						<th>Delete</th>
					</thead>
					<tbody>';
			foreach ($row as $alr) {
				$user = new User($alr->user_id);
				$employee_fullname = $user->getEmpFullName();
				$employee_fileNo = $user->getEmpFileNo();
				$employee_department =  $user->getEmpDepartment();
				if ($alr->approved == 0) {
					$yes = '<span class="text-danger">No</span>';
				}else{
					$yes = '<span class="text-success">Yes</span>';
				}
				
				
					$output .=' <tr>
							<td>'.$alr->id.'</td>
							<td>'.$employee_fullname.'</td>
							<td>'.$employee_fileNo.'</td>
							<td>'.$employee_department.'</td>
							<td>'.$alr->leaveFrom.'</td>
							<td>'.$yes.'</td>
							<td>
								<a href="details/maternity-Leave/'.$alr->id.'" class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i>Detail</a>
							</td>
							<td>
								<a href="#" id="'.$alr->id.'" class="btn btn-danger btn-sm deleteMaternityBtn" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i>Delete</a>
							</td>
						</tr>';
					
			
		}
	$output .= '</tbody>
				</table>';

	return $output;
	}else{
		return '<span class="text-center text-info text-lg">No Data In Database Table Yet</span>';
	}
	
}

public function getMedicalLeave()
{
	$sql = "SELECT * FROM medicalLeave WHERE pending  = 1 ";
	$data = $this->_db->query($sql);

	$output = '';
	if ($data->count()) {
		$row =  $data->results();
		$output .= '<table class="table table-stripped table-condensed" id="showMedicalLeave">
					<thead>
						<th>ID</th>
						<th>Employee Name</th>
						<th>File No</th>
						<th>Department</th>
						<th>Date Proceeding On Leave</th>
						<th>Approved</th>
						<th>Details</th>
						<th>Delete</th>
					</thead>
					<tbody>';
			foreach ($row as $alr) {
				$user = new User($alr->user_id);
				$employee_fullname = $user->getEmpFullName();
				$employee_fileNo = $user->getEmpFileNo();
				$employee_department =  $user->getEmpDepartment();

				if ($alr->approved == 0) {
					$yes = '<span class="text-danger">No</span>';
				}else{
					$yes = '<span class="text-success">Yes</span>';
				}
				
					$output .=' <tr>
							<td>'.$alr->id.'</td>
							<td>'.$employee_fullname.'</td>
							<td>'.$employee_fileNo.'</td>
							<td>'.$employee_department.'</td>
							<td>'.$alr->leaveFrom.'</td>
							<td>'.$yes.'</td>
							<td>
								<a href="details/medical-Leave/'.$alr->id.'" class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i>Detail</a>
							</td>
							<td>
								<a href="#" id="'.$alr->id.'" class="btn btn-danger btn-sm deleteMaternityBtn" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i>Delete</a>
							</td>
						</tr>';
					
			
		}
	$output .= '</tbody>
				</table>';

	return $output;
	}else{
		return '<span class="text-center text-info text-lg">No Data In Database Table Yet</span>';
	}
	
}


public function checkUserExist($table,$fileNo)
{
	// $check = $this->_db->get('annaulLeaveRequest', array('file_no', '=', $fileNo));
	$sql = "SELECT * FROM $table WHERE file_no = '$fileNo' AND pending = 0 ";
	$check = $this->_db->query($sql);
	if ($check->count()) {
		return true;
	}else{
		return false;
	}
}

public function checkUserExistById($table,$userid)
{
	// $check = $this->_db->get('annaulLeaveRequest', array('file_no', '=', $fileNo));
	$sql = "SELECT * FROM $table WHERE user_id = '$userid' AND pending = 0 ";
	$check = $this->_db->query($sql);
	if ($check->count()) {
		return true;
	}else{
		return false;
	}
}

public function checkUserOnLeave($fileNo)
{
	$check = $this->_db->get('activeLeaves', array('file_no', '=', $fileNo));
	if ($check->count()) {
		return true;
	}else{
		return false;
	}
}


public function checkUserOnLeaveId($userid)
{
	$check = $this->_db->get('activeLeaves', array('user_id', '=', $userid));
	if ($check->count()) {
		return true;
	}else{
		return false;
	}
}


public function getLeaveRequestDetail($table, $detail)
{
	$check = "SELECT * FROM $table WHERE id = '$detail'";
	$query = $this->_db->query($check);
	if ($query->count()) {
		return $query->first();
	}else{
		return false;
	}
}

public function getUserLeaveRequestStatus($table, $fileno)
{
	$check = "SELECT * FROM $table WHERE file_no = '$fileno' ";
	$query = $this->_db->query($check);

	if ($query->count()) {
		$row = $query->first();

		return 'You are currently on <br> '.'<span class="text-center">'.$row->typeOfLeave.'</span>';
	}else{

		return '<span>No Active Leave Yet</span>';
	}
}

public function checkLeaveStatus($getFrom,$field, $id)
{
	$check = "SELECT * FROM $getFrom WHERE $field = '$id'";
	$query = $this->_db->query($check);

	$output = '';
	if ($query->count()) {
		$row = $query->first();
		if ($row->pending == 1) {
			$output .= 'Request is pending!';
		}elseif ($row->approved == 1) {
			$output .= 'Request is approved and running!';
		}
		return $output;

	}else{
		return 'You did\'t apply for this particular leave!';
	}
}


public function updateLeaveMat($leavid,$medicsignature)
{
	$date = date('Y-m-d');

	$this->_db->update('maternityLeave', 'id', $leavid, array(
		'medicalOfficerSignature' => $medicsignature,
		'medicalOfficer_DateSignature' => $date
	));
	return true;
}

public function insertIntoActiveLeave($table, $field = array())
{
	$this->_db->insert($table, $field);
}

public function updateLeaveMatHR($leavid)
{
	$date = date('Y-m-d');

	

	$data = $this->_db->get('maternityLeave', array('id', '=', $leavid));
	if ($data->count()) { 
		$row = $data->first();

		$userid = $row->user_id;
		$user = new User($userid);
		$userFileNo =  $user->data()->fileNo;
		$userID = $user->data()->id;


		$typeOfLeave  = 'Maternity Leave'; 
		$file_no  = $userFileNo;
		$user_id  = $userID;
		$dateOfProceedingOnLeave  = $row->leaveFrom;
		
		

		$this->_db->insert('activeLeaves',array(
			'typeOfLeave' => $typeOfLeave,
			'file_no' => $file_no,
			'user_id' => $user_id,
			'dateOfProceedingOnLeave' => $row->leaveFrom,
			'dateReturningToDuty' => '0000-00-00',
			'approved' => 1 
		));


	$this->_db->update('maternityLeave', 'id', $leavid, array(
		'approved' => 1,
		'pending' => 0
	));

	}

	return true;
}


public function getActiveLeave($table,$userid)
{
	
	$data = $this->_db->get($table, array('user_id', '=', $userid));
	if ($data->count()) { 
		return  $data->first();
	}else{
		return false;
	}

}

public function fetchActiveLeaves()
{
	$data = $this->_db->get('activeLeaves', array('approved', '=', 1));
	if ($data->count()) { 
		$row =  $data->results();
		$output = '';
		$output .= '<table class="table table-stripped table-condensed" id="showActivesLeave">
					<thead>
						<th>ID</th>
						<th>Employee Name</th>
						<th>File No</th>
						<th>Type Of Leave</th>
						<th>Date Proceeded to Leave</th>
						<th>Date Returning</th>
						<th>Details</th>
						<th>Delete</th>
					</thead>
					<tbody>';
				foreach ($row as $alr) {
				$user = new User($alr->user_id);
				$employee_fullname = $user->getEmpFullName();
				$employee_fileNo = $user->getEmpFileNo();
				$employee_department =  $user->getEmpDepartment();
				
					$output .=' <tr>
							<td>'.$alr->id.'</td>
							<td>'.$employee_fullname.'</td>
							<td>'.$employee_fileNo.'</td>
							<td>'.$alr->typeOfLeave.'</td>
							<td>'.pretty_dates($alr->dateOfProceedingOnLeave).'</td>
							<td>'.pretty_dates($alr->dateReturningToDuty).'</td>
							<td>
								<a href="details/medical-Leave/'.$alr->id.'" class="btn btn-sm btn-primary"><i class="fa fa-info-circle"></i>Detail</a>
							</td>
							<td>
								<a href="#" id="'.$alr->id.'" class="btn btn-danger btn-sm deleteMaternityBtn" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i>Delete</a>
							</td>
						</tr>';
					
			
		}
	$output .= '</tbody>
				</table>';

	return $output;
	}else{
		return '<span class="text-center text-info text-lg">No Data In Database Table Yet</span>';
	}
}

public function approveLeave($table,$id, $field = array())
{
	$this->_db->update($table,'id',$id, $field);
}


public function SendactiveLeave($typeOfLeave,$empFileNo,$empId,$leaveFrom,$leaveTo)
{
	$this->_db->insert('activeLeaves', array(
			'typeOfLeave' => $typeOfLeave,
			'file_no' => $empFileNo,
			'user_id' => $empId,
			'dateOfProceedingOnLeave' => $leaveFrom,
			'dateReturningToDuty' => $leaveTo,
			'approved' => 1 
		));
}

}//end of class