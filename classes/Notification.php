<?php
/**
 * post class
 */
class Notification
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

public function notifi($fields = array())
{
	$this->_db->insert('notifications', $fields);
		
}

public function fetchNotifaction($userid){
   $output = '';
   $sql = "SELECT * FROM notifications WHERE user_id = '$userid' AND type = 'employee'";
   $checked = $this->_db->query($sql);
   if ($checked->count()) {
     $notifaction = $checked->results();
    foreach ($notifaction as $noti) {
      $output .= '
      <div class="alert alert-danger" role="alert">
        <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
        <span arid-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 lead">
        '.$noti->message.'
      </p>
      <hr class="my-2">
      <p class="mb-0 float-left">Reply From Admin</p>
      <p class="mb-0 float-right"><i class="lead">'.timeAgo($noti->dateCreated).'</i></p>
      <div class="clearfix"> </div>
    </div>
      ';
    }
    return $output;

  }else{
    echo '<h4 class="text-center text-white mt-5">No New Notifications</h4>';
  }
}


public function fetchNotifactionCount(){
   $user_id = $this->_user->data()->id;
   $output = '';
  $sql = "SELECT * FROM notifications WHERE user_id = '$user_id' AND type = 'employee'";
    $cou = $this->_db->query($sql);
   if ($cou->count()) {
      $count = $cou->count();
      $output .= '<span class="badge badge-pill badge-danger">'.$count.'</span>';

   }else{
    $count = 0;
    $output .= '<span class="badge badge-pill badge-danger">'.$count.'</span>';
   }
   return $output;

}

//Delete notification
  public function removeNotification($id){
    $sql = "DELETE FROM notifications WHERE id = '$id' AND type = 'employee'";
    $this->_db->query($sql);
    return true;
  }

  //FEtch notification from database admin
  public function fetchNotifactionAdmin(){
    $sql = "SELECT * FROM notifications WHERE type = 'Admin' ORDER BY id DESC";
     $this->_db->query($sql);
    if ($this->_db->count()) {
      return $this->_db->results();
    }else{
      return false;
  }
}


  public function fetchNotifactionCountAdmin(){
    $sql = "SELECT * FROM notifications WHERE type = 'Admin'";
     $this->_db->query($sql);
    if ($this->_db->count()) {
      return $this->_db->count();
    }else{
      return false;
  }
}
  //Delete notification
    public function removeNotificationAdmin($id){
      $this->_db->delete('notifactions', array('id', '=', $id));
      return true;
    }




}//end of class
