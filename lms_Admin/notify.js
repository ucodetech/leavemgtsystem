$(document).ready(function(){
  //FEtch notification

  fetchNotifaction();
  setInterval(function(){
        fetchNotifaction();
  }, 1000);
  function fetchNotifaction(){
    $.ajax({
      url: 'scripts/inits.php',
      method: 'post',
      data: {action: 'fetchNotifaction'},
      success:function(response){
        $('#notification').html(response);
      }
    });
  }


  //CHECK NOTIFACATION
  checkNotifacations();

  setInterval(function(){
      checkNotifacations();
  }, 1000);
    function checkNotifacations(){
      $.ajax({
        url: 'scripts/inits.php',
        method: 'post',
        data: {action: 'getNotify'},
        success:function(response){
          console.log(response);
          $('#getNotifys').html(response);
        }
      });
    }


  // remove notifiaction
  $('body').on('click', '.close', function(e){
    e.preventDefault();

    notifacation_id = $(this).attr('id');
    $.ajax({
      url: 'scripts/inits.php',
      method: 'post',
      data: {notifacation_id: notifacation_id},
      success:function(response){
        checkNotifacations();
          fetchNotifaction();

      }
    });
  })



});
