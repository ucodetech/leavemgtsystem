<?php
require_once '../../core/init.php';
//add new note ajax request
$user = new User();
$notify = new Notification();
$user_id = $user->data()->id;


// //Fetch Notes Ajax request
// if (isset($_POST['action']) && $_POST['action'] == 'display_notes') {
//   $output = '';
//   $userid = $officer->officer_id;
//   $notes =  $user->getNotes($userid);
  
//   if (!$notes) {
//     echo '<h3 class="text-center text-secondary">You do not have any notes! write your first note now!</h3>';
//   }else{
//     $output .= '
//     <table id="showNotes" class="table table-striped table-sm">
//       <thead>
//         <tr>
//           <th>#</th>
//           <th>Title</th>
//           <th>Note</th>
//           <th>Action</th>
//         </tr>
//         <tbody>
//     ';
//     $x = 0;
//     foreach ($notes as $note) {
//       $x = $x + 1;
//     $output .= '
//     <tr>
//       <td>'.$x.'</td>
//       <td>'.$note->title.'</td>
//       <td>'.wrap($note->note).'...</td>
//       <td>
//         <a href="#" id="'.$note->id.'"  title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

//           <a href="#"  id="'.$note->id.'" title="Edit Note" class="text-info editBtn" data-toggle="modal" data-target="#editNoteModal"><i class="fa fa-edit fa-lg"></i> </a>&nbsp;

//             <a href="#" id="'.$note->id.'" title="Move Note to trash" class="text-danger deleteBtn"><i class="fa fa-trash fa-lg"></i> </a>
//       </td>
//     </tr>
//     ';

//     }
//     $output .='
//     </tbody>
//   </thead>
// </table>
//     ';
//     echo $output;
//   }

// }

// //Edit note
// if (isset($_POST['edit_id'])) {
//     $id = $_POST['edit_id'];
//     $note = $user->editNote($id);

//     echo json_encode($note);
// }

// //Update Note Now
// if (isset($_POST['action']) && $_POST['action'] == 'update_note') {
//   $id = $user->test_input($_POST['editId']);
//   $title = $user->test_input($_POST['title']);
//   $note = $user->test_input($_POST['note']);
//   $user->updateNote($id, $title, $note);
//   $user->notification($officer->officer_id, 'Admin', 'Updated Note');

// }

// //Move Note to trash can
// if (isset($_POST['del_id'])) {
//   $id = $_POST['del_id'];
//   $user->deleteNote($id);
//  $user->notification($officer->officer_id, 'Admin', 'Note Deleted');

// }


// //Fetch Notes deleted Ajax request
// if (isset($_POST['action']) && $_POST['action'] == 'display_deleted') {
//   $output = '';
//   $userid = $officer->officer_id;
//   $notes =  $user->getNoteDeleted($userid);
//   if (!$notes) {
//     echo '<h3 class="text-center text-secondary">Nothing in the trash can! <a href="dashboard"><i class="fa fa-tachometer fa-lg" aria-hidden="true"></i> Dashboard</a></h3>';
//   }else{
//     $output .= '
//     <table id="showNotes" class="table table-striped table-sm">
//       <thead>
//         <tr>
//           <th>#</th>
//           <th>Title</th>
//           <th>Note</th>
//           <th>Action</th>
//         </tr>
//         <tbody>
//     ';
//     $x = 0;
//     foreach ($notes as $note) {
//       $x = $x + 1;
//     $output .= '
//     <tr>
//       <td>'.$x.'</td>
//       <td>'.$note->title.'</td>
//       <td>'.wrap($note->note).'...</td>
//       <td>
//         <a href="#" id="'.$note->id.'"  title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

//       <a href="#" id="'.$note->id.'" title="Delete Note" class="text-danger deleteBtn"><i class="fa fa-trash fa-lg"></i> </a> &nbsp;

//       <a href="#" id="'.$note->id.'" title="Restore Note" class="text-warning restoreBtn"><i class="fa fa-refresh fa-lg" aria-hidden="true"></i> </a>
//       </td>
//     </tr>
//     ';

//     }
//     $output .='
//     </tbody>
//   </thead>
// </table>
//     ';
//     echo $output;
//   }

// }
// //Move Note to trash can
// if (isset($_POST['restore_id'])) {
//   $id = $_POST['restore_id'];
//   $user->restoreNote($id);
//   $user->notification($officer->officer_id, 'Admin', 'Note Restored');

// }
//delete note
// if (isset($_POST['delp_id'])) {
//   $id = $_POST['delp_id'];
//   $user->deleteNoteP($id);
//   $user->notification($officer->officer_id, 'Admin', 'Note Deleted From Trash');

// }

// //Display note Details
// if (isset($_POST['info_id'])) {
//   $id = $_POST['info_id'];

//   $detail = $user->editNote($id);
//   $user->notification($officer->officer_id, 'Admin', 'Viewed note Detail');

//   echo json_encode($detail);
// }

// //Display note Details
// if (isset($_POST['infoD_id'])) {
//   $id = $_POST['infoD_id'];

//   $detail = $user->editNote($id);
//   $user->notification($officer->officer_id, 'Admin', 'Viewed Note in trash');

//   echo json_encode($detail);
// }

// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {
   $notifaction = $notify->fetchNotifaction($user_id);
 
    echo $notifaction;
  }



  

  if (isset($_POST['action']) && $_POST['action'] == 'checkNotifaction') {
     $noti = $notify->fetchNotifactionCount();
     echo  $noti;
       
  }


//remove notifatications
if (isset($_POST['notifacation_id'])) {
  $id = $_POST['notifacation_id'];
  ;
  $notify->removeNotification($id);

}
