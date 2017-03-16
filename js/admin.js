$(document).on('click','.decline',function(){
  $('#toDecline').val($(this).data('id'));
});
var searchUsersInterval;
$('#searchUsers').on('keyup',function(){
  clearInterval(searchUsersInterval);
  var search = $(this).val();
  searchHistoryInterval  = setTimeout(function(){
      $.ajax({
        url: 'searchUsers.php',
        type:"GET",
        data:{search:search},
        success: function(result){
          $('#displayUsers').html(result);
        }
      })
    },500);
});
var searchPendingInterval;
$('#searchPending').on('keyup',function(){
  clearInterval(searchPendingInterval);
  var search = $(this).val();
  searchPendingInterval  = setTimeout(function(){
      $.ajax({
        url: 'searchPending.php',
        type:"GET",
        data:{search:search},
        success: function(result){
          $('#pending').html(result);
        }
      })
    },500);
});
var searchEditInterval;
$('#searchUserEdits').on('keyup',function(){
  clearInterval(searchEditInterval);
  var search = $(this).val();
  console.log(search);
  searchEditInterval  = setTimeout(function(){
      $.ajax({
        url: 'searchUserEdit.php',
        type:"GET",
        data:{search:search},
        success: function(result){
          console.log(result);
          $('#userEdits').html(result);
        }
      })
    },500);
});
