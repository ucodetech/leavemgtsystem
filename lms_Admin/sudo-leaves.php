<?php
    require_once '../core/init.php';
     $admin = new Admin();
    $adminEmail = $admin->getAdminEmail();

    if (!isLoggedInAdmin()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('sudo-login');

    }
    if (!hasPermissionSuper()) {
      Session::flash('denied', 'You do not have permission access that page!');
      Redirect::to('sudo-dashboard');
    }
    // if (isOTPset($adminEmail)) {
    //   Redirect::to('otp-verify');
    // }

    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid myPage">
       <?php echo $title ;?>

      </div>
       <div id="showError">

       </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
   			<div class="container-fluid shadow-lg p-2">
				<div class="table-responsive" id="showActivesLeaves">

				</div>
   			</div>



    </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>
<?php //include APPROOT . '/lod_Admin/modals.php';?>
<?php require_once APPROOT . '/includes/footerportal.php';?>

<script>




$(document).ready(function(){
	var gifPath = '../images/gif/tra.gif';

		// fetch bboks
		fetch_leaves();

		function fetch_leaves(){
			action = 'fetch_leave';
			$.ajax({
				url:'scripts/inits.php',
				method:'post',
				data:{action:action},
				success:function(response){
				$('#showActivesLeaves').html(response);
				$('#showActivesLeave').DataTable({
			     "paging": true,
	            "lengthChange": false,
	            "searching": true,
	            "ordering": true,
	            "order": [0,'desc'],
	            "info": true,
	            "autoWidth": false,
	            "responsive": true,
	             "lengthMenu": [[10,10, 25, 50, -1], [10, 25, 50, "All"]]
			    });

				}
			})
		}


	$(document).on('click', '.StudentDetailsIcon', function(e){
			e.preventDefault();
			student_id =  $(this).attr('id');
			$.ajax({
				url:'script/student-process.php',
				method:'post',
				data: {student_id : student_id},
				success:function(response){
					$('#showStudentDetail').html(response);
				}
			});
		});


 // delete note
    $("body").on("click", ".deleteStudentIcon", function(e){
        e.preventDefault();
        delstudent_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You can view the student in trash and restore or delete permenatly!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Move it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'script/student-process.php',
                method: 'POST',
                data: {delstudent_id: delstudent_id},
                success:function(response){
                  Swal.fire(
                    'Student Recored Trashed!',
                    'Student Recored Sent to Trash Can! <a href="admin-trash">Trash Can</a>',
                    'success'
                  );
                  fetch_books();
                }
              });

            }
          });

    });



// update last lastLogin
update_admin_login();

        function update_admin_login()
        {
            var action = 'update_war';
            $.ajax({
               url:"scripts/initate.php",
               method:"POST",
               data:{action:action},
               success:function(response)
               {
                 console.log(response);

               },
               error:function(){alert("something went wrong admin update")}

            });
        }
   setInterval(function(){
     update_admin_login();
  }, 1000);




	});
</script>
 --><script type="text/javascript" src="notify.js"></script>
<!-- <script type="text/javascript" src="activity.js"></script>
 -->