<?php
    require_once '../../core/init.php';
    if (!hasPermissionSuper()) {
        Redirect::to('../../admin-dashboard');
    }
    require_once APPROOT . '/includes/headportal.php';
    require_once APPROOT . '/includes/navportal.php';

    $msg = '';
    $general = new General();
    $admin = new Admin();

    if (isset($_GET['detail']) && !empty($_GET['detail'])) {
    	$detail = (int)$_GET['detail'];

    	$adminDetail = $general->getadminDetail($detail);
			if ($adminDetail) {
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
				   	$imgPath = '../../../lod_Admin/profile/';

      		  $passport = '<img src="'.$imgPath.$adminDetail->profile_pic.'"  alt="admin Passport" width="150px" height="150px" style="border-radius:50px;">';

		      if($adminDetail->sudo_verified == 0){
		          $Verifiedmsg ='No &nbsp;(Email not verified)';
		      }else{

		        $Verifiedmsg ='Yes &nbsp;(Email  verified)';

		      }


			        	?>

						<div class="card">
				        <h4 class="text-dark m-3 p-3"><?=strtok($adminDetail->sudo_full_name, ' ');?>'s Detail</h4>

				          <div class="card-body text-dark">
				          <h3 class="text-center">Full Name: &nbsp; <?=$adminDetail->sudo_full_name;?></h3><hr>
				          <center><?=$passport;?></center><br><br>
				          <div class="row">
				          	<div class="form-group col-md-6 shadow-lg">
				          		<input type="text" class="form-control form-control-lg" name="fullName"  value="<?=$adminDetail->sudo_full_name;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="email" class="form-control form-control-lg" name="email" value="<?=$adminDetail->sudo_email;?>">
				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="tel" class="form-control form-control-lg" name="phoneNo" value="<?=$adminDetail->sudo_phoneNo;?>">

				            </div>
				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="fileNo"  value="<?=$adminDetail->sudo_fileNo;?>">

				            </div>

				            <div class="form-group col-md-6 shadow-lg">
				            	<input type="text" class="form-control form-control-lg" name="department" value="<?=$adminDetail->sudo_department;?>">

				            </div>

				              <div class="form-group col-md-6 shadow-lg">
				            	<input type="disabled" class="form-control form-control-lg"  value="<?=$Verifiedmsg;?>" readonly>
				            </div>
				             <div class="form-group col-md-6 shadow-lg">
				             <input type="disabled" class="form-control form-control-lg" value="Added on: <?=pretty_dates($adminDetail->sudo_dateAdded);?>" readonly>

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
  		adminId = '<?=$detail;?>'
  		fullName = $('input[name="fullName"]').val();

      	$.ajax({
      		url: '../../script/admin-process.php',
      		method: 'post',
      		data: {adminId: adminId, fullName:fullName},
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
  		adminId = '<?=$detail;?>'
  		email = $('input[name="email"]').val();

      	$.ajax({
      		url: '../../script/admin-process.php',
      		method: 'post',
      		data: {adminId: adminId, email:email},
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
      adminId = '<?=$detail;?>'
      phoneNo = $('input[name="phoneNo"]').val();

        $.ajax({
          url: '../../script/admin-process.php',
          method: 'post',
          data: {adminId: adminId, phoneNo:phoneNo},
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


    $('input[name="fileNo"]').change(function(e){
          adminId = '<?=$detail;?>'
          fileNo = $('input[name="fileNo"]').val();

            $.ajax({
              url: '../../script/admin-process.php',
              method: 'post',
              data: {adminId: adminId, fileNo:fileNo},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+fileNo+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 3000);
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
          adminId = '<?=$detail;?>'
          department = $('input[name="department"]').val();

            $.ajax({
              url: '../../script/admin-process.php',
              method: 'post',
              data: {adminId: adminId, department:department},
              success:function(response){
            if ($.trim(response)==='success') {
              $('#showError').fadeIn('slow').html('<div id="regError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>'+department+ ' Updated Successfully.. Page about to reload!</span></div>');
              setTimeout(function(){
                location.reload();
              }, 3000);
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
