<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/authhead.php';



?>
    <!-- Content Wrapper. Contains page content -->
 <style>
 	#loginError{
	margin-top: 15px;
	margin-bottom: 0px;
	height: auto;
	border-radius: 20px;
	position: fixed;
	z-index: 10;
}
 </style>
   	 <div class="container h-100">
   	 	 <div class="row align-items-center justify-content-center ">
        <div class="col-lg-5">
        	<?php
          		if(Session::exists('denied')){
          		echo '<div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">
                            &times;
                            </button>
                            <strong class="text-center">'. Session::flash('denied') .'</strong>
                            </div>';
                        }
                    ?>
          <div id="showError" class="px-3">


          </div>
        </div>
      </div>
      <div class="row h-100 align-items-center justify-content-center">
        <div class="col-lg-5">
          <div class="card border-info shadow-lg">
            <div class="card-header bg-navy">
              <h3 class="m-0 text-white">
                <i class="fa fa-sign-in"></i>&nbsp;Sign In
              </h3>
            </div>
            <div class="card-body text-dark">
             <form action="" method="post" id="employeeLoginForm" class="px-3 my-auto">


            <div class="form-group">
              <label for="fileNo">File No<sup class="text-danger">*</sup></label>
              <input type="text" name="fileNo" id="fileNo" class="form-control form-control-lg" placeholder="Enter your fileNo">
            </div>
            <div class="form-group">
              <label for="password">Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter Password">
            </div>
          <div class="form-group">
           <div class="custom-control custom-checkbox float-left">
             <input type="checkbox" name="remember" id="remember"  class="custom-control-input"/>
             <label for="remember" class="custom-control-label">Remember me</label>
           </div>
           <div class="forget float-right">
             <a href="#" id="forgot-link" data-target="forgetModal" data-toggle="modal">Forgot Password?</a>
           </div>
         </div>
         <div class="clearfix"> </div>
          <div class="form-group">
              <button type="submit" name="loginEmployeeBtn" id="loginEmployeeBtn" class="btn  btn-success">Login</button>

           </div><hr>
            <div class="form-group">
              Don't have account?<a href="register" id="register-link">&nbsp;Register</a>
            </div>


        </form>
            </div>
          </div>
        </div>
      </div>
    </div>


<?php
    require_once APPROOT . '/includes/footer1.php';

?>


<script>
	$(document).ready(function(){
		var gifPath = '../images/gif/tra.gif';
		//register process
		$('#loginEmployeeBtn').click(function(e){
			e.preventDefault();

			$.ajax({
				url:'scripts/login-process.php',
				method:'post',
				data: $('#employeeLoginForm').serialize()+'&action=login',
				beforeSend:function(){
					$('#loginEmployeeBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;a moment');
				},
				success:function(response){
					if ($.trim(response)==='success') {
						$('.card').css('display', 'none');
						$('#showError').html('<div id="loginError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>Redirecting...</span></div>');
						setTimeout(function(){
							window.location = 'lms-dashboard';
						}, 3000);

					}else{
						$('#showError').html('<div id="loginError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					}
				},
				complete:function(){
					$('#loginEmployeeBtn').html('Login');
				}
			});
		});

	});
</script>
