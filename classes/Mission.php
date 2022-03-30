<?php

 /**
  * mission
  */
 class Mission
 {

 	private  $_db,
           $_user,
           $_super;


  function __construct()
  {
    $this->_db = Database::getInstance();
   $this->_user = new User() ;
   $this->_super = new Commander();

  }

  public function superNow()
  {
   return $this->_super;
  }

  //Get gender percentage
public function genderPer(){
  $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender ";
  $data = $this->_db->query($sql);
	  if ($data->count()) {
	  	return $data->results();
	  }else{
	  	return false;
	  }
}

// verified and unverified percenta
public function verifiedPer(){
  $sql = "SELECT verified, COUNT(*) AS number FROM users  GROUP BY verified ";
   $data = $this->_db->query($sql);
	  if ($data->count()) {
	  	return $data->results();
	  }else{
	  	return false;
	  }
}




 public function loggedAdmin(){
    $sql = "SELECT * FROM superusers WHERE super_last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
   $data = $this->_db->query($sql);
	  if ($this->_db->count()) {
	  	return $this->_db->results();
	  }else{
	  	return false;
	  }
 }
 public function getImgSuper($superimgid){
        $data = $this->_db->get('superprofile', array('war_id', '=', $superimgid));
     	  if ($this->_db->count()) {
     	  	return $this->_db->first();
     	  }else{
     	  	return false;
     	  }
    }


  public function updateWar(){
       $super = $this->superNow()->getSuperId();
        $sql = "UPDATE superusers SET super_last_login = NOW() WHERE id = '$super' ";
        $this->_db->query($sql);
        return true;
    }


  public function totalCount($tablename){
    $sql = "SELECT * FROM $tablename";
    $count =  $this->_db->query($sql);
    if ($count->count()) {
      return $count->count();
    }else{
      return false;
    }
  }

  public function verified_users($status){
    $count =  $this->_db->get('users', array('verified', '=', $status));
    if ($count->count()) {
      return $count->count();
    }else{
      return false;
    }
  }

  //hits
  public function hits(){
    $sql = " SELECT hits FROM visitors";
    $data =  $this->_db->query($sql);
    if ($this->_db->count()) {
      return $this->_db->first();
    }else{
      return false;
    }
  }

  public function selectSubscribers(){
      $data = $this->_db->get('update_subscribers', array('deleted', '=', 0));
      if ($data->count()) {
        return $data->results();
      }else{
        return false;
      }
  }

  public function selectUsers($val){
    $data = $this->_db->get('users', array('deleted', '=', $val));
    if ($data->count()) {
      return $data->results();
    }else{
      return false;
    }
  }

public function fetchUserDetail($id){
    $data = $this->_db->get('users', array('id', '=', $id));
    if ($data->count()) {
      return $data->first();
    }else{
      return false;
    }
}
public function userAction($id, $val){
      $sql = "UPDATE users SET deleted = '$val' WHERE id = '$id' ";
      $this->_db->query($sql);
      return true;

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




  //select users with permissioin fpi
  public function selectFpiUsers(){
    $sql = "SELECT * FROM users WHERE comp_permission = 'courseMate' AND deleted = 0 ";
      $this->_db->query($sql);
      if ($this->_db->count()) {
        return $this->_db->results();
      }else {
        return false;
      }

  }

  //get cousers
  public function getCourses(){
    $this->_db->get('Courses', array('deleted', '=', 0));
    if ($this->_db->count()) {
      return $this->_db->results();
    }else {
      return false;
    }

  }

  //get cousers by id
  public function getCoursesId($id){
    $this->_db->get('Courses', array('id', '=', $id));
    if ($this->_db->count()) {
      return $this->_db->first();
    }else {
      return false;
    }
  }
  //add project source code
  public function addProject($table, $fields =  array()){
    if (!$this->_db->insert($table, $fields)) {
      throw new \Exception("Error Processing Request", 1);

    }
  }

  //fetch projects
  public function fetchProject($table, $val){
    $this->_db->get($table, array('deleted', '=', $val));
    if ($this->_db->count()) {
      return $this->_db->results();
    }else {
      return false;
    }

  }

public function getProjectById($id)
{
  $this->_db->get('comp_ass', array('id', '=', $id));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else {
    return false;
  }

}

public function updateProject($assName, $id)
{
  $this->_db->update('comp_ass','id', $id, array(
    'ass_name' => $assName
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


  //delete user permenatly
  public function deleteUserP($id){
    $this->_db->delete('users', array('id', '=', $id));
    return true;
  }

  public function slugCheck($slug_url){
    $sql = "SELECT * FROM tutorials WHERE slug_url LIKE '$slug_url%' ";
    $this->_db->query($sql);
    if ($this->_db->count()) {
      return $this->_db->results();
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


  public function loggedUsers(){
    $sql = "SELECT * FROM users WHERE lastLogin > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
    $data = $this->_db->query($sql);
  	  if ($data->count()) {
  	  	return $data->results();
  	  }else{
  	  	return false;
  	  }
  }

  public function getImg($imgid){
        $this->_db->get('userprofile', array('user_id', '=', $imgid));
  		  if ($this->_db->count()) {
  		  	return $this->_db->first();
  		  }else{
  		  	return false;
  		  }
    }


public function fetchUsers(){
  $output = '';
  $imgPath = '../users/avaters/avaters';
  $imgPathD = '../users/avaters';


  $this->_db->get('users', array('deleted', '=', 0));
  if ($this->_db->count()) {
    $dat = $this->_db->results();
  if ($dat) {
    $output .= '
    <table class="table table-striped table-hover" id="show">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>E-Mail</th>
          <th>Phone Number</th>
          <th>Email Verified</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
    foreach ($dat as $row) {
      // $profi = $this->getImg($row->id);
    $data = $this->_db->get('userprofile', array('user_id', '=', $row->id));
    $profi = $data->results();
    foreach ($profi as $pic) {
      if ($pic->status == 0) {
        $yes = '<img src="'.$imgPath.$pic->user_id.'.jpg"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';
      }else{
        $yes = "<img src='".$imgPathD."/default.png' width='70px' height='70px' style='border-radius:50px;' alt='Default Image'>";
      }
    }
      if($row->verified == 0){
          $msg ='<span class="text-danger align-self-center lead">No</span>';
      }else{

        $msg ='<span class="text-success align-self-center lead">Yes</span>';

      }
      $output .= '
          <tr>
            <td>'.$row->id.'</td>
              <td>'.$yes.'</td>
                   <td>'.$row->full_name.'</td>
                     <td>'.$row->email.'</td>
                       <td>'.$row->phone_number.'</td>
                         <td>'.$msg.'</td>
                         <td>
                         <a href="#" id="'.$row->id.'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                         <a href="#" id="'.$row->id.'" title="Trash User" class="text-danger deleteUserIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

                         </td>
          </tr>
          ';
    }



    $output .= '
      </tbody>
    </table>';
  }else{
    $output .= '<h3 class="text-center text-secondary align-self-center lead">No user In database</h3>';
  }
  echo $output;

}

}







   }//end of class
