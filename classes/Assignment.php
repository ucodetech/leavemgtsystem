<?php
/**
 * post class
 */
class Assignment
{
  private  $_db,
           $_user;


  function __construct()
  {
    $this->_db = Database::getInstance();
   $this->_user = new User() ;

  }

  public function userNow()
  {
   return $this->_user;
  }


public function selectAssignment($val){
  $this->_db->get('comp_ass', array('deleted', '=', $val));
  if ($this->_db->count()) {
    return $this->_db->results();
  }else{
    return false;
  }
}
public function getCoursesId($id){
   $this->_db->get('Courses', array('id', '=', $id));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }

}


public function updateAssignment($downs, $id)
{
    $sql = "UPDATE comp_ass SET downloads = ? WHERE id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$downs, $id]);
    return true;
}

public function fetchDownloads(){
  $val = 0;
  $sql = "SELECT * FROM proDownCount";
  if ($this->_db->query($sql)) {
    if ($this->_db->count()) {
      return $this->_db->results();
    }
    
  }

}

public function fetchDown($id){
  $sql = "SELECT downloads FROM comp_ass WHERE id = '$id' ";
  $this->_db->query($sql);
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }
  
}
public function getSourceCode($file_id)
{
  $this->_db->get('comp_ass', array('source_code', '=', $file_id));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
    
  }

}

public function updateDownloads($down, $downusers,$fetid)
{
  $this->_db->update('comp_ass', 'id', $fetid, array(
    'downloads' => $down,
    'users' => $downusers

  ));
   return true;
}
public function insertUsers($userid, $full_name, $downloadid, $courseid)
{
  $this->_db->insert('proDownCount', array(
    'user_id' => $userid,
    'user_name' => $full_name,
    'download_id' => $downloadid,
    'course_id' => $courseid
  ));
  return true;
}

public function checkUserD($id, $courseid)
{
  $sql = "SELECT * FROM  proDownCount  WHERE user_id = '$id' AND course_id = '$courseid'";
  $this->_db->query($sql);
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }

}

public function selectAssignmentID($name){
  $sql = "SELECT * FROM comp_ass WHERE source_code = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$name]);
  $fileID = $stmt->fetch(PDO::FETCH_OBJ);
  return $fileID;
}
//alert course mates on new  post
public function checkAlert($field,$table){
  $sql = "SELECT $field FROM $table WHERE id = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $fet = $stmt->fetch(PDO::FETCH_OBJ);
  return $fet;
}


}//end of class