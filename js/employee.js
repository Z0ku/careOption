var searchAcceptedInterval;
$('#searchAccepted').on('keyup',function(){
  clearInterval(searchAcceptedInterval);
  var search = $(this).val();
  console.log(search);
  searchAcceptedInterval  = setTimeout(function(){
      $.ajax({
        url: 'searchAccepted.php',
        type:"GET",
        data:{search:search},
        success: function(result){

          $('#accepted').html(result);
        }
      })
    },500);
});
