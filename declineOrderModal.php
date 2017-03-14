<div id="declineOrder" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1>Decline Order: </h1>
      </div>
      <div class="modal-body">
        <form action='admin.php' method="post">
          <textarea name='comments'>
          </textarea>
          <input type='hidden' value='-1' name='id' id='toDecline'>
          <button type='submit' class='btn btn-danger' name='decline' value='yes'>Decline</button>
        </form>
      </div>
    </div>
  </div>
</div>
