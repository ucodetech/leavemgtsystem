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
            <div class="card-header bg-info">
              <h3 class="m-0 text-white">
                <i class="fa fa-gear"></i>&nbsp; Admin Login
              </h3>
            </div>
            <div class="card-body text-dark">
             <form action="" method="post" id="adminFormLogin" class="px-3 my-auto">


            <div class="form-group">
              <label for="supername">Username<sup class="text-danger">*</sup></label>
              <input type="text" name="supername" id="supername" class="form-control form-control-lg" placeholder="Enter Username">
            </div>
            <div class="form-group">
              <label for="password">Password<sup class="text-danger">*</sup></label>
              <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Enter Password">
            </div>


            <div class="form-group">
              <button type="submit" name="loginAdminBtn" id="loginAdminBtn" class="btn  btn-success">Login</button>
               <a href="" class="float-right" data-target="forgetModal" data-toggle="modal">Forget Password</a>

            </div><hr>
            <div class="form-group">
              Don't have account?<a href="" data-target="accessModal" data-toggle="modal">&nbsp;Request For access</a>
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
		$('#loginAdminBtn').click(function(e){
			e.preventDefault();

			$.ajax({
				url:'scripts/login-process.php',
				method:'post',
				data: $('#adminFormLogin').serialize()+'&action=login',
				beforeSend:function(){
					$('#loginAdminBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;a moment');
				},
				success:function(response){
					if ($.trim(response)==='success') {
						$('.card').css('display', 'none');
						$('#showError').html('<div id="loginError" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fas fa-check"></i>&nbsp;<span><img src="'+gifPath+'" alt="loader">&nbsp;Redirecting...</span></div>');
						setTimeout(function(){
							window.location = 'sudo-dashboard';
						}, 3000);

					}else{
						$('#showError').html('<div id="loginError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fas fa-times"></i>&nbsp;<span>'+response+'</span></div>');

					}
				},
				error:function(){
					$('#showError').html('<div id="loginError" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fas fa-times"></i>&nbsp;<span>Page Doe not exists!</span></div>');
				}

				,
				complete:function(){
					$('#loginAdminBtn').html('Login Admin');
				}
			});
		});

	});
</script>
