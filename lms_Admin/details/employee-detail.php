<?php
    require_once '../../core/init.php';
    if (!hasPermissionSuper()) {
        Redirect::to('../../admin-dashboard');
    }
    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

    $msg = '';
    $general = new General();
    $Employee = new Employee();

    if (isset($_GET['detail']) && !empty($_GET['detail'])) {
    	$detail = (int)$_GET['detail'];

    	$EmployeeDetail = $Employee->getEmployeeDetail($detail);
			if ($EmployeeDetail) {
				?>

				   <style>

#updateError{
    font-size: 1.0rem;
	text-align: left;
	border-radius: 20px;

}
#showError{
	position: fixed;
	z-index: 1;
	top:10%;
	right: 2%;
	width: 100%;
	height: auto;

}
				   </style> <!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
				    <!-- Content Header (Page header) -->
				    <div class="content-header">
				      <div class="container-fluid myPage">
				       <?php echo $title;?> <br>
				        <?=$msg ?>
				      </div>
				       <div id="showError">

				       </div><!-- /.container-fluid -->
				    </div>
				    <!-- /.content-header -->

				    <!-- Main content -->
				    <div class="content">
				      <div class="container-fluid">
				   		<?php
				   	$imgPath = '../../../employeePortal/avaters/';

      		  $passport = '<img src="'.$imgPath.$EmployeeDetail->passport.'"  alt="Employee Passport" width="150px" height="150px" style="border-radius:50px;">';

		      if($EmployeeDetail->verified == 0){
		          $Verifiedmsg ='No &nbsp;(Email not verified)';
		      }else{

		        $Verifiedmsg ='Yes &nbsp;(Email  verified)';

		      }
			       //check age
			     
			        	?>

						<div class="card">
				        <h4 class="text-dark m-3 p-3"><?=strtok($EmployeeDetail->full_name, ' ');?>'s Detail</h4>

				          <div class="card-body text-dark">
				          <h3 class="text-center">Full Name: &nbsp; <?=$EmployeeDetail->full_name;?></h3><hr>
				          <center><?=$passport;?></center><br><br>
				          <div class="row">
				          	<div class="form-group col-md-6 shadow-lg">
				          		<input type="text" class="form-control form-control-lg" name="fullName"  value="<?=$EmployeeDetail->full_name;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="email" class="form-control form-control-lg" name="email" value="<?=$EmployeeDetail->email;?>">
				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="tel" class="form-control form-control-lg" name="phoneNo" value="<?=$EmployeeDetail->phone_number;?>">

				            </div>
				           
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="department" value="<?=$EmployeeDetail->department;?>">

				            </div>
				           
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="gender" value="<?=$EmployeeDetail->gender;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="typeOfEmploy" id="typeOfEmploy" value="<?=$EmployeeDetail->typeOfEmploy;?>">

				            </div>
				           
				              <div class="form-group col-md-6 shadow-lg">
				            	<input type="disabled" class="form-control form-control-lg"  value="<?=$Verifiedmsg;?>" readonly>
				            </div>
				             <div class="form-group col-md-6 shadow-lg">
				             <input type="disabled" class="form-control form-control-lg" value="joined on: <?=pretty_dates($EmployeeDetail->dateJoined);?>" readonly>

				            </div>
				          </div>
				          </div>
				          </div>
				          <!-- end of card -->


				    </div><!-- /.container-fluid -->
				    <!-- /.content -->
				  </div>
				  <!-- /.content-wrapper -->


				</div>

				<?
			}

    }


?>

<?php require_once APPROOT . '/includes/footerportal.php';?>

<script>
  $(document).ready(function(){

  	$('input[name="fullName"]').change(function(e){
  		employeeId = '<?=$detail;?>'
  		fullName = $('input[name="fullName"]').val();
       
      	$.ajax({
      		url: '../../scripts/employee-process.php',
      		method: 'post',
      		data: {employeeId: employeeId, fullName:fullName},
      		success:function(response){
  			if ($.trim(response)==='success') {
  				$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+fullName+' Updated Successfully.. Page about to reload!</span></div>');
					setTimeout(function(){
						location.reload();
					}, 5000);
				}else{
					$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					setTimeout(function(){
						$('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
					}, 3000);

				}
      		}
      	});

    });


    $('input[name="email"]').change(function(e){
  		employeeId = '<?=$detail;?>'
  		email = $('input[name="email"]').val();

      	$.ajax({
      		url: '../../scripts/employee-process.php',
      		method: 'post',
      		data: {employeeId: employeeId, email:email},
      		success:function(response){
  			if ($.trim(response)==='success') {
  				$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+email+ ' Updated Successfully.. Page about to reload!</span></div>');
					setTimeout(function(){
						location.reload();
					}, 5000);
				}else{
					$('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					setTimeout(function(){
						$('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
					}, 3000);

				}
      		}
      	});

    });


    $('input[name="phoneNo"]').change(function(e){
      employeeId = '<?=$detail;?>'
      phoneNo = $('input[name="phoneNo"]').val();

        $.ajax({
          url: '../../scripts/employee-process.php',
          method: 'post',
          data: {employeeId: employeeId, phoneNo:phoneNo},
          success:function(response){
        if ($.trim(response)==='success') {
          $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+phoneNo+ ' Updated Successfully.. Page about to reload!</span></div>');
          setTimeout(function(){
            location.reload();
          }, 5000);
        }else{
          $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

          setTimeout(function(){
            $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
          }, 3000);

        }
          }
        });

    });



$('input[name="department"]').change(function(e){
          employeeId = '<?=$detail;?>'
          department = $('input[name="department"]').val();

            $.ajax({
              url: '../../scripts/employee-process.php',
              method: 'post',
              data: {employeeId: employeeId, department:department},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+department+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 5000);
            }else{
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

              setTimeout(function(){
                $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
              }, 3000);

            }
              }
            });

});

$('input[name="level"]').change(function(e){
          employeeId = '<?=$detail;?>'
          level = $('input[name="level"]').val();

            $.ajax({
              url: '../../scripts/employee-process.php',
              method: 'post',
              data: {employeeId: employeeId, level:level},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+level+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 5000);
            }else{
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

              setTimeout(function(){
                $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
              }, 3000);

            }
              }
            });
  });

$('input[name="gender"]').change(function(e){
              employeeId = '<?=$detail;?>'
              typeOfEmploy = $('input[name="typeOfEmploy"]').val();

                $.ajax({
                  url: '../../scripts/employee-process.php',
                  method: 'post',
                  data: {employeeId: employeeId, typeOfEmploy:typeOfEmploy},
                  success:function(response){
                if ($.trim(response)==='success') {
                  $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+gender+ ' Updated Successfully.. Page about to reload!</span></div>');
                  setTimeout(function(){
                    location.reload();
                  }, 5000);
                }else{
                  $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

                  setTimeout(function(){
                    $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
                  }, 3000);

                }
                  }
                });

        });

        $('input[name="dob"]').change(function(e){
                  employeeId = '<?=$detail;?>'
                  dob = $('input[name="dob"]').val();

                    $.ajax({
                      url: '../../scripts/employee-process.php',
                      method: 'post',
                      data: {employeeId: employeeId, dob:dob},
                      success:function(response){
                    if ($.trim(response)==='success') {
                      $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+dob+ ' Updated Successfully.. Page about to reload!</span></div>');
                      setTimeout(function(){
                        location.reload();
                      }, 5000);
                    }else{
                      $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

                      setTimeout(function(){
                        $('#showError').fadeOut('slow').html('<div id="regError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');
                      }, 3000);

                    }
                      }
                    });

            });


});
</script>
