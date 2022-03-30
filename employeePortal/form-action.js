$(document).ready(function(){
   var gifPath = '../images/gif/tra.gif';

  $('#requestShowLeaveBtn').click(function(e){
    e.preventDefault();
   $('#requestShowLeaveBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;generating...');
    setTimeout(function(){
      $('#requestLeaveBox').css('display','block');
      $('#requestShowLeaveBtn').css('display','none');
      $('#CloserequestLeaveBtn').css('display','block');
      $('#CloserequestLeaveBtn').css('background-color','red');


      // $('#requestLeaveBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;Annual Leave Form is Active');
    },7000);

  });

  $('#CloserequestLeaveBtn').click(function(e){
    e.preventDefault();
   $('#CloserequestLeaveBtn').html('<img src="'+gifPath+'" alt="loader">&nbsp;closing...');
    setTimeout(function(){
      $('#requestLeaveBox').css('display','none');
      $('#CloserequestLeaveBtn').css('display','none');
      $('#requestShowLeaveBtn').css('display','block');

      $('#requestShowLeaveBtn').html('Request For Leave');
    },4000);

  });



})