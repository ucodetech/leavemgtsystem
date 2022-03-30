update_admin_login();

        function update_admin_login()
        {
            var action = 'update_admin';
            $.ajax({
               url:"script/initate.php",
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
  }, 3000);