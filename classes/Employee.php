
<?php

 /**
  * Employee
  */
 class Employee
 {

 	private  $_db,
           $_user,
           $_super;


  function __construct()
  {
    $this->_db = Database::getInstance();
    $this->_user = new User() ;

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



 public function getImgSuper($superimgid){
        $data = $this->_db->get('super_profile', array('sudo_id', '=', $superimgid));
     	  if ($this->_db->count()) {
     	  	return $this->_db->first();
     	  }else{
     	  	return false;
     	  }
    }


  public function verified_users($status){
    $count =  $this->_db->get('users', array('verified', '=', $status));
    if ($count->count()) {
      return $count->count();
    }else{
      return '0';
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




public function loggedUsers(){
    $sql = "SELECT * FROM users WHERE lastLogin > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
    $data = $this->_db->query($sql);
  	  if ($data->count()) {
  	  	return $data->results();
  	  }else{
  	  	return false;
  	  }
  }


public function updateuserRecored($user_id, $field, $value)
{
	$this->_db->update('users', 'id', $user_id, array(
    	$field => $value

    ));

    return true;
}




public function fetchusers(){
  $output = '';
  $imgPath = '../employeePortal/avaters/';


  $this->_db->get('users', array('deleted', '=', 0));
  if ($this->_db->count()) {
    $dat = $this->_db->results();
  if ($dat) {
    $output .= '
    <table class="table table-striped table-hover" id="showuser">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Matric Number</th>
          <th>Department</th>
          <th>Level</th>
          <th>Joined Date</th>
          <th>Last Login</th>
          <th>Email Verified</th>
          <th>Action</th>

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
                     <td>'.$row->matric_no.'</td>
                       <td>'.$row->department.'</td>
                        <td>'.$row->level.'</td>
                       <td>'.pretty_dates($row->dateJoined).'</td>
                       <td>'.pretty_dates($row->lastLogin).'</td>

                         <td>'.$msg.'</td>
                         <td>
                         <a href="detail/user-detail/'.$row->id.'" id="'.$row->id.'" title="View Details" class="text-primary"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                         <a href="#" id="'.$row->id.'" title="Trash user" class="text-danger deleteuserIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

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
  return  $output;

}

}

public function getuserDetail($user_id)
  {
    $user = $this->_db->get('users', array('id', '=', $user_id));
    if ($user->count()) {
      return  $user->first();

    }else{
      return false;
    }
  }

 public function getEmployeeDetail($detail)
  {
    $user = $this->_db->get('users', array('id', '=', $detail));
    if ($user->count()) {
      return  $user->first();

    }else{
      return false;
    }
  }


   }//end of class
