$(document).ready(function(){


	$('#sudo_phoneNo').change(function(e){
		e.preventDefault();
		sudo_phoneNo = $('#sudo_phoneNo').val();
		$.ajax({
			url:'scripts/setting-process.php',
			method:'post',
			data:{sudo_phoneNo:sudo_phoneNo},
			success:function(response){
				if ($.trim(response)==='success') {
					$('#messages').html('<span class="text-success">'+sudo_phoneNo+': Updated Successfully!</span>')
				}else{
					$('#messages').html(response);
				}
			}
		});
	})


	$('#sudo_email').change(function(e){
		e.preventDefault();
		sudo_email = $('#sudo_email').val();
		alert(sudo_email);
		// $.ajax({
		// 	url:'scripts/setting-process.php',
		// 	method:'post',
		// 	data:{sudo_email:sudo_email},
		// 	success:function(response){
		// 		if ($.trim(response)==='success') {
		// 			$('#messages').html('<span class="text-success">'+sudo_email+': Updated Successfully!</span>')
		// 		}else{
		// 			$('#messages').html(response);
		// 		}
		// 	}
		// });
	})



})