<?php
require_once '../../core/init.php';
//feed back ajax
$feed = new Feedback();
$notifi = new Notification();
$user = new User();
$userid = $user->data()->id;

if (isset($_POST['action']) && $_POST['action'] == 'sendFeedback') {
  $subject = Show::test_input($_POST['subject']);
  $feedback = Show::test_input($_POST['feedback']);
 

  if (empty($subject) || empty($feedback)) {
    echo Show::showMessage('danger', 'All Field are required');
  }else{
  	try {
  		$feed->feedBack(array(
        'subject' => $subject, 
        'feedback' => $feedback, 
        'user_id' => $userid
      ));
      $notifi->notifi(array(
        'user_id' => $userid,
        'type' => 'Admin',
        'message' => 'Sent Feedback!'
      ));
      
      echo 'success';
  	} catch (Exception $e) {
  		echo $show->showMessage('danger', $e->getMessage(), 'warning');
  		return false;
  	}

      
  }


}

//grant user permission
if (isset($_POST['user_idSend'])) {
    $user_id = (int)$_POST['user_idSend'];
    $user_id = preg_replace("[^0-9]", "", trim($_POST['user_id']));
    $update = $user->UpdatePermission($user_id);
    if ($update) {
      echo 'granted';
    }
}
