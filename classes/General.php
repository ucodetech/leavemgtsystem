<?php

 /**
  * General
  */
 class General
 {

 	private  $_db,
           $_user,
           $_super;


  function __construct()
  {
    $this->_db = Database::getInstance();
   $this->_user = new User() ;
   $this->_super = new Admin();

  }

  public function superNow()
  {
   return $this->_super;
  }






 public function loggedAdmin(){
    $sql = "SELECT * FROM superusers WHERE sudo_lastLogin > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
   $data = $this->_db->query($sql);
	  if ($this->_db->count()) {
	  	return $this->_db->results();
	  }else{
	  	return false;
	  }
 }
 public function getImgSuper($superimgid){
        $data = $this->_db->get('super_profile', array('sudo_id', '=', $superimgid));
     	  if ($this->_db->count()) {
     	  	return $this->_db->first();
     	  }else{
     	  	return false;
     	  }
    }






  public function updateAdmin(){
       $super = $this->superNow()->getAdminId();
        $sql = "UPDATE superusers SET sudo_lastLogin = NOW() WHERE id = '$super' ";
        $this->_db->query($sql);
        return true;
    }


  public function totalCount($tablename){
    $sql = "SELECT * FROM $tablename";
    $count =  $this->_db->query($sql);
    if ($count->count()) {
      return $count->count();
    }else{
      return '0';
    }
  }


  public function verified_admin($status){
    $count =  $this->_db->get('superusers', array('sudo_verified', '=', $status));
    if ($count->count()) {
      return $count->count();
    }else{
      return '0';
    }
  }




  //Reply to user feedback
public function replyFeedback($userid, $message){
    $this->_db->insert('notifications', array(
      'user_id' => $userid,
      'type' => 'user',
      'message' => $message
    ));
    return true;
  }


public function updateFeedbackReplied($feedid){
    $this->_db->update('feedback','id', $feedid , array(
      'replied' => 1
    ));
    return true;
  }





  //alert course mate when new assignment is upload
  public function checkAlert($val){
    $sql = "UPDATE assignmentAlert SET alert = '$val', dataAdded = NOW() WHERE id = 0";
    $this->_db->query($sql);
    return true;

  }

  public function checkAlertc($val)
  {
    $sql = "SELECT alert FROM assignmentAlert WHERE alert = '$val'";
    $this->_db->query($sql);
    if ($this->_db->count()) {
      return $this->_db->first();
    }else {
      return false;
    }
  }




  public function warheadAuth($authID){
    $this->_db->get('superusers', array('id', '=', $authID));
    if ($this->_db->count()) {
      return $this->_db->first();
    }else {
      return false;
    }

  }

  public function fetchAdmins($val){
    $output = '';
    $imgPath = '../lms_Admin/';

    $this->_db->get('superusers', array('suspended', '=', $val));
    if ($this->_db->count()) {
      $dat = $this->_db->results();
    if ($dat) {
      $output .= '
      <table class="table table-striped table-hover" id="showAdmin">
        <thead>
          <tr>
            <th>#</th>
            <th>Profile</th>
            <th>Full Name</th>
            <th>Login Name</th>
            <th>File No.</th>
            <th>Department</th>
            <th>Date Added</th>
            <th>Last Login</th>
            <th>Email Verified</th>
            <th>Detail</th>
            <th>Trash</th>


          </tr>
        </thead>
        <tbody>
      ';
      foreach ($dat as $row) {

          $passport = '<img src="'.$imgPath.$row->profile_pic.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

        if($row->sudo_verified == 0){
            $msg ='<span class="text-danger align-self-center lead">No</span>';
        }else{

          $msg ='<span class="text-success align-self-center lead">Yes</span>';

        }
        $admin = new Admin();
        if($row->id == $admin->getAdminId()){
            $action ='<span class="text-success align-self-center lead">superuser</span>';
        }else{
          $action ='<a href="#" id="'.$row->id.'" title="Trash Student" class="btn btn-sm btn-danger deleteStudentIcon">Trash </a>';


        }
        $output .= '
            <tr>
              <td>'.$row->id.'</td>
                <td>'.$passport.'</td>
                     <td>'.$row->sudo_full_name.'</td>
                       <td>'.$row->sudo_username.'</td>
                       <td>'.$row->sudo_fileNo.'</td>
                         <td>'.$row->sudo_department.'</td>
                         <td>'.pretty_dates($row->sudo_dateAdded).'</td>
                         <td>'.pretty_dates($row->sudo_lastLogin).'</td>

                           <td>'.$msg.'</td>
                           <td>

                           <a href="detail/admin-detail/'.$row->id.'" id="'.$row->id.'" title="View Details" class="btn btn-sm btn-info">Detail </a>
                           </div>
                           &nbsp;&nbsp;

                           </td>
                           <td>
                           '.$action.'
                           </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
    }else{
      $output .= '<h3 class="text-center text-secondary align-self-center lead">No Admin In database</h3>';
    }
    return  $output;

  }

  }


  public function getadminDetail($admin_id)
    {
      $admin = $this->_db->get('superusers', array('id', '=', $admin_id));
      if ($admin->count()) {
        return  $admin->first();

      }else{
        return false;
      }
    }

public function updateAdminRecored($admin_id, $field, $value)
    {
    	$this->_db->update('superusers', 'id', $admin_id, array(
        	$field => $value

        ));

        return true;
    }


public function getDepartment()
{
  $dept = $this->_db->get('department', array('deleted', '=', 0));
  if ($dept->count()) {
      return $dept->results();
  }else {
    return false;
  }
}


public function getState()
{
  $state = $this->_db->get('states', array('deleted', '=', 0));
  if ($state->count()) {
      return $state->results();
  }else {
    return false;
  }
}


public function updateStudentRecored($user_id, $field, $value)
{
  $this->_db->update('users', 'id', $user_id, array(
          $field => $value

        ));

        return true;
}

public function InsertSignature($user_id, $user_signature)
{
  $this->_db->insert('adminSignatures',  array(
          'admin_id' => $user_id,
          'signature' => $user_signature

        ));

        return true;
}


public function getTotLeaveRequest()
{
  $sql = "SELECT  countRequest FROM leaveRequestCount";
  if ($this->_db->query($sql)) {
    $row =  $this->_db->first();
    return $row->countRequest;
  }
}



public function getTotStatusRequest($table,$field,$status)
{
  $data = $this->_db->get($table, array($field, '=', $status));
  if ($data->count()) {
    return $data->count();
  }else{
    return false;
  }
}


public function fetchEmployess(){
    $output = '';
    $imgPath = '../employeePortal/avaters/';


    $this->_db->get('users', array('deleted', '=', 0));
    if ($this->_db->count()) {
      $dat = $this->_db->results();
    if ($dat) {
      $output .= '
      <table class="table table-striped table-hover" id="showEmploye">
        <thead>
          <tr>
            <th>#</th>
            <th>Profile</th>
            <th>Full Name</th>
            <th>File No.</th>
            <th>Department</th>
            <th>Registered On</th>
            <th>Last Login</th>
            <th>Email Verified</th>
            <th>Detail</th>
            <th>Trash</th>


          </tr>
        </thead>
        <tbody>
      ';
      foreach ($dat as $row) {

          $passport = '<img src="'.$imgPath.$row->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

        if($row->verified == 0){
            $msg ='<span class="text-danger align-self-center lead">No</span>';
        }else{

          $msg ='<span class="text-success align-self-center lead">Yes</span>';

        }
        
        $output .= '
            <tr>
              <td>'.$row->id.'</td>
                <td>'.$passport.'</td>
                     <td>'.$row->full_name.'</td>
                       <td>'.$row->fileNo.'</td>
                         <td>'.$row->department.'</td>
                         <td>'.pretty_dates($row->dateJoined).'</td>
                         <td>'.pretty_dates($row->lastLogin).'</td>

                           <td>'.$msg.'</td>
                           <td>

                           <a href="details/employee-detail/'.$row->id.'" id="'.$row->id.'" title="View Details" class="btn btn-sm btn-info">Detail </a>
                           </div>
                           &nbsp;&nbsp;

                           </td>
                           <td>
                            <a href="'.$row->id.'" id="'.$row->id.'" title="Delete User" class="btn btn-sm btn-danger">Delete</a>
                           </div>
                           &nbsp;&nbsp;
                           </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
    }else{
      $output .= '<h3 class="text-center text-secondary align-self-center lead">No Employee yet</h3>';
    }
    return  $output;

  }

  }


//   public function getadminDetail($admin_id)
//     {
//       $admin = $this->_db->get('superusers', array('id', '=', $admin_id));
//       if ($admin->count()) {
//         return  $admin->first();

//       }else{
//         return false;
//       }
//     }

public function updateemployeeRecored($user_id, $field, $value)
    {
      $this->_db->update('users', 'id', $user_id, array(
          $field => $value

        ));

        return true;
    }





}//end of class
