function getSpecs(type){
  $.ajax({
    url: "getSpecs.php",
    method: "GET",
    data:{type:type},
    success: function(specs){
      $('#specs').html(specs);
    }
  })
}
$('#orderType').change(function(){
  getSpecs($(this).val());
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

var searchHistoryInterval;
$('#searchHistory').on('keyup',function(){
  clearInterval(searchHistoryInterval);
  var search = $(this).val();
  searchHistoryInterval  = setTimeout(function(){
      $.ajax({
        url: 'clientOrderHistory.php',
        type:"GET",
        data:{search:search},
        success: function(result){
          $('#orderHistory').html(result);
        }
      })
    },500);
});
$(document).on('click','.resendOrder',function(){
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
      getSpecs(data['orderType']);
      $('#order').find('.modal-body').find('[name="specs"]').val(data['specs']);
      $('#order').find('.modal-body').find('label').addClass('active');
    }
  })
});
