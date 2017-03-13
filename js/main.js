$(document).on('click','.viewDetails',function(){
  var id = $(this).data('id');
  $.ajax({
    url: '/orderDetails.php',
    type: "GET",
    data: {id:id},
    success: function(data){
      $('#orderDetails').find('.modal-body').html(data);
    }
  })
});
