<?php
    require_once '../core/init.php';
    $admin = new Admin();
    $adminEmail = $admin->getAdminEmail();

    if (!isLoggedInAdmin()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('sudo-login');

    }


    // if (isOTPset($adminEmail)) {
    //   Redirect::to('otp-verify');
    // }


    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

  $count = new Employee();



?>
    
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      
	<?php if (hasPermissionSuper()): ?>
		<span class="text-left text-underline text-success float-right"><u>You are logged in as a Superuser </u></span>
	<?php elseif(hasPermissionHOD()): ?>
		<span class="text-left text-underline text-success float-right"><u>You are logged in as Head Of Department</u></span>

	<?php elseif(hasPermissionHR()): ?>	
	<span class="text-left  text-underline text-success float-right"><u>You are logged in as a Human Resource Manager</u></span>

	<?php elseif(hasPermissionMedical()): ?>	
	<span class="text-left text-underline text-success float-right"><u>You are logged in as Medical Director</u></span>

	<?php endif ?>
      </div><br><hr>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      	<?php if (hasPermissionMedical() || hasPermissionHR()): ?>
      	
      	<div class="row shadow-lg p-3" >
      		<h2 class="text-center p-3">Medical Leave Requesets</h2>
      		<hr>
      		<div class="table-responsive text-center"  id="showMedicalleaveRequest">
      			
      		</div>
      	</div>

      	<div class="row shadow-lg p-3" >
      		<h2 class="text-center p-3">Maternity Leave Requesets</h2>
      		<hr>
      		<div class="table-responsive text-center"  id="showMaternityleaveRequest">
      			
      		</div>
      	</div>
	<?php endif ?>

	<?php if (hasPermissionSuper() || hasPermissionHR() || hasPermissionHOD()): ?>
		
      	<div class="row shadow-lg p-3" >
      		<h2 class="text-center p-3">Annual Leave Requesets</h2>
      		<hr>
      		<div class="table-responsive text-center"  id="showAnnaulleaveRequest">
      			
      		</div>
      	</div>
      	
      	<div class="row shadow-lg p-3" >
      		<h2 class="text-center p-3">Study Leave Requesets</h2>
      		<hr>
      		<div class="table-responsive text-center"  id="showStudyleaveRequest">
      			
      		</div>
      	</div>
		<div class="row shadow-lg p-3" >
			<h2 class="text-center p-3">Causal Leave Requesets</h2>
      		<hr>
      		<div class="table-responsive text-center"  id="showCausalleaveRequest">
      			
      		</div>
      	</div>
      	<div class="row shadow-lg p-3" >
      		<h2 class="text-center p-3">Sabatical Leave Requesets</h2>
      		<hr>
      		<div class="table-responsive text-center"  id="showSabaticalleaveRequest">
      			
      		</div>
      	</div>
    	<?php endif ?>

      </div>
  </div>
</div>


<?php require_once APPROOT. '/includes/footerportal.php';?>
	
	<script>
		$(document).ready(function(){

				annaulLeave();
				studyLeave();
				MedicalLeave();
				MaternityLeave();
				CausalLeave();
				SabaticalLeave();
		


			function annaulLeave(){
				action = 'fetchAnnualRequest';
				$.ajax({
					url:'scripts/request-process.php',
					method:'post',
					data:{action: action},
					success:function(response){
						$('#showAnnaulleaveRequest').html(response);
						$('#showAnnualLeave').DataTable({
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
					},
					error:function(){
						alert('something went wrong annaual leave');
					}
				});
			};


			function studyLeave(){
				action = 'fetchStudyRequest';
				$.ajax({
					url:'scripts/request-process.php',
					method:'post',
					data:{action: action},
					success:function(response){
						$('#showStudyleaveRequest').html(response);
						//$('#showMaternityLeave').DataTable({
					    //  "paging": true,
			      //       "lengthChange": false,
			      //       "searching": true,
			      //       "ordering": true,
			      //       "order": [0,'desc'],
			      //       "info": true,
			      //       "autoWidth": false,
			      //       "responsive": true,
			      //        "lengthMenu": [[10,10, 25, 50, -1], [10, 25, 50, "All"]]
					    // });
					},
					error:function(){
						alert('something went wrong study leave');
					}
				});
			};

			function MedicalLeave(){
				action = 'fetchMedicalRequest';
				$.ajax({
					url:'scripts/request-process.php',
					method:'post',
					data:{action: action},
					success:function(response){
						$('#showMedicalleaveRequest').html(response);
						$('#showMedicalLeave').DataTable({
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
					},
					error:function(){
						alert('something went wrong study leave');
					}
				});
			};




			function MaternityLeave(){
				action = 'fetchMaternityRequest';
				$.ajax({
					url:'scripts/request-process.php',
					method:'post',
					data:{action: action},
					success:function(response){
						$('#showMaternityleaveRequest').html(response);
						$('#showMaternityLeave').DataTable({
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
					},
					error:function(){
						alert('something went wrong study leave');
					}
				});
			};



			function CausalLeave(){
				action = 'fetchCausalRequest';
				$.ajax({
					url:'scripts/request-process.php',
					method:'post',
					data:{action: action},
					success:function(response){
						$('#showCausalleaveRequest').html(response);
					},
					error:function(){
						alert('something went wrong study leave');
					}
				});
			};

			function SabaticalLeave(){
				action = 'fetchSabaticalRequest';
				$.ajax({
					url:'scripts/request-process.php',
					method:'post',
					data:{action: action},
					success:function(response){
						$('#showSabaticalleaveRequest').html(response);
						$('#showSabaticalLeave').DataTable({
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
					},
					error:function(){
						alert('something went wrong study leave');
					}
				});
			};









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








		})
	</script>
	<script type="text/javascript" src="notify.js"></script>
