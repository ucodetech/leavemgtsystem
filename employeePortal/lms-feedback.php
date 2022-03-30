<?php
    require_once '../core/init.php';

    $user = new User();
    // $useremail = $user->getEmail();

    if (!isLoggedInUser()) {
      Session::flash('denied', 'You need to login to access that page!');
      Redirect::to('login');
      
    }


    // if (isOTPsetStudent($studentEmail)) {
    //   Redirect::to('otp-verify');
    // }

    require_once APPROOT . '/includes/headportal1.php';
    require_once APPROOT . '/includes/navportal1.php';

    $category = new Category();

    $signed = $user->getSignature($user->data()->id);
    $leave = new Leave();
    $userid = $user->data()->id;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="text-right float-right">
          <?php if (hasPermissionEmployee()): ?>
            <span class="text-info shadow-lg"><u>You are logged in as Employee</u></span><br>
          <?php endif ?>
         
        </div>

      </div><!-- /.container-fluid -->
    </div><br>
    <!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
	  <div class="container-fluid">
	  		<h2 class="text-center display-4">Send Feedback</h2>
	    <div class="row justify-content-center shadow-lg p-5">
	    		<div class="col-lg-8">
	    			<form action="#" method="post" id="feedbackForm">
	    				<div class="form-group">
	    					<label for="subject">Subject: <sup class="text-danger">*</sup> </label>
	    					<input type="text" name="subject" id="subject" class="form-control form-control-lg" placeholder="subject">
	    				</div>
	    				<div class="form-group">
	    					<label for="feedback">Write Feedback: <sup class="text-danger">*</sup> </label>
	    					<textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control form-control-lg" placeholder="Write...."></textarea>
	    				</div>
	    				<div class="form-group">
	    					<button class="btn btn-block btn-info" id="feedbackBtn"><i class="fa fa-comment fa-lg"></i>Feedback</button>
	    				</div>
	    				<div id="showError2"></div>
	    			</form>
	    		</div>

	 	  </div><!-- /.container-fluid -->
		</div>
			<!-- /.content -->

	</div>
		<!-- /.content-wrapper -->

</div>


           
<?php
    require_once APPROOT . '/includes/footerportal1.php';

?>
<script>
	$(document).ready(function(){

		$('#feedbackBtn').click(function(e){
			e.preventDefault();
			$.ajax({
				url:'scripts/feedback-process.php',
				method:'post',
				data:$('#feedbackForm').serialize()+'&action=sendFeedback',
				beforeSend:function(){
					$('#feedbackBtn').html('<img src="../images/gif/tra.gif" alt="loader">&nbsp;Sending...');
				},
				success:function(response){
					if ($.trim(response)==='success') {
						$('#feedbackForm')[0].reset();
						$('#showError2').html(' <div id="" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times; </button><i class="fa fa-check"></i>&nbsp; <span>Feedback sent! await reply</span></div>');
					}else{
						$('$showError2').html(response);
					}
				},
				complete:function(){
					$('#feedbackBtn').html('<i class="fa fa-check fa-lg"></i>Sent');
				}

			})
		})
	})
</script>
<script type="text/javascript" src="notificationjs.js"></script>
