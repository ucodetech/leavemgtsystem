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
       <div class="container-fluid">
      
    <?php if (hasPermissionSuper()): ?>
    <span class="text-left text-underline text-success float-right"><u>You are  logged in as a Superuser </u></span>
   <?php elseif(hasPermissionHOD()): ?>
    <span class="text-left text-underline text-success float-right"><u>You are logged in as Head Of Department</u></span>

    <?php elseif(hasPermissionHR()): ?> 
    <span class="text-left   text-underlinetext-successfloat-right"><u>You are logged in as a Human Resource Manager</u></span>
    <?php endif ?>
      </div><br><hr>
      <!-- /.container-fluid -->
       <div id="showError">
        
       </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      	<div class="card shadow-lg">
      		<div class="card-body">
      			<div class="row">
      				<div class="col-lg-4">
      				<h3 class="text-center text-dark">Add Category</h3><hr>

      					<form action="#" method="post" id="addCategoryForm">
      						<div class="form-group">
      							<label for="category">Category Name: <sup class="text-danger">*</sup></label>
      							<input type="text" name="category" id="category" class="form-control form-control-lg" placeholder="Type Category">
      						</div>
      						<div class="form-group">
      							<button type="submit" id="categoryBtn" class="btn btn-info btn-block">Add Category</button>
      						</div>
      					</form>
      				</div>
      				<div class="col-lg-8">
      					<h3 class="text-center text-dark">Leave Categories</h3><hr> 
      					<div class="table-responsive shadow-lg" id="showCategory">
      						
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>


     </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- edit modal -->
  
  	
    <!-- End Add New note modal -->
      <!-- Add Note Modal -->
      <div class="modal fade" id="editCategory">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h4 class="modal-title text-light"> <i class="fas fa-edit fa-lg"></i> Edit Category</h4>
              <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="editCate">
              
            </div>
          </div>
        </div>

      </div>
    <!-- End Add New note modal -->

  <!-- end of edit modal -->
 
  
</div>
           
<?php
    require_once APPROOT . '/includes/footerportal.php';

?>

<script>
	$(document).ready(function(){
		$('#categoryBtn').click(function(e){
			e.preventDefault();
			$.ajax({
				url:'scripts/category-process.php',
				method:'post',
				data:$('#addCategoryForm').serialize()+'&action=addCategory',
				success:function(response){
					$('#showError').html(response);
					$('#addCategoryForm')[0].reset();
					fetch_category();
					
				}
			});
		});

fetch_category();
	
function fetch_category(){
	action = 'fetch_Category';
	$.ajax({
		url:'scripts/category-process.php',
		method:'post',
		data:{action: action},
		success:function(response){
			$('#showCategory').html(response);
			$('#showCate').DataTable({
			     "paging": true,
	            "lengthChange": false,
	            "searching": true,
	            "ordering": true,
	            "order": [0,'desc'],
	            "info": true,
	            "autoWidth": false,
	            "responsive": true,
      	       "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
			    });
		}
	});
}






    $("body").on("click", ".editIcon", function(e){
        e.preventDefault();
        edit_id = $(this).attr('id');
        $.ajax({
          url: 'scripts/category-process.php',
          method: 'POST',
          data: {edit_id: edit_id},
          success:function(response){
          $('#EditCateBtn').val('Edit Category');
         	$('#editCate').html(response);
          
          }
        });
    });

    //Update Category
    $("body").on('click', '#EditCateBtn',function(e){
        e.preventDefault();
        $.ajax({
          url: 'scripts/category-process.php',
          method: 'POST',
          data: $('#EditCategoryForm').serialize()+'&action=update_cate',
          success:function(response){
            Swal.fire({
              title: 'Category Updated Successfully!',
              type: 'success'
            });
            $('#EditCategoryForm')[0].reset();
              $('#editCategory').modal('hide');
				fetch_category();
          }
        });
      
    });

    // delete note
    $("body").on("click", ".trashIcon", function(e){
        e.preventDefault();
        del_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You can view the note in trash and restore or delete permenatly!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Move it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'scripts/category-process.php',
                method: 'POST',
                data: {del_id: del_id},
                success:function(response){
                  Swal.fire(
                    'Category Trashed!',
                    'Category Sent to Trash Can! <a href="trash">Trash Can</a>',
                    'success'
                  )
					fetch_category();
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
<script type="text/javascript" src="notify.js"></script>
