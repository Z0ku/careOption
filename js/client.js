$('#orderType').change(function(){
  $.ajax({
    url: "getSpecs.php",
    method: "GET",
    data:{type:$(this).val()},
    success: function(specs){
      $('#specs').html(specs);
    }
  })
});
// Ajax submit
// $('#placeOrder').on('click',function(){
//   var fd = new FormData(document.querySelector("#newOrder"));
//   $.ajax({
//     url: "order.php",
//     type: "POST",
//     data: fd,
//     processData: false,  // tell jQuery not to process the data
//     contentType: false,   // tell jQuery not to set contentType
//     success: function(data){
//       window.location.href = window.location.href;
//     }
//   });
// });
$('.viewDetails').on('click',function(){
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

$('.resendOrder').on('click',function(){
  var id = $(this).data('id');
  $.ajax({
    url: '/resendOrder.php',
    type: "GET",
    data: {order:id},
    dataType: "json",
    success: function(data){
      for(var key in data){
        $('#order').find('.modal-body').find('[name='+key+']').val(data[key]);
      }
        $('#order').find('.modal-body').find('label').addClass('active');
    }
  })
});
