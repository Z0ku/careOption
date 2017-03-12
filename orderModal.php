
<div id="order" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h1>Order</h1>
      </div>
      <div class="modal-body">

        <div class='orderForm form'>

          <form action="order.php" method="post" id='newOrder' enctype="multipart/form-data">
            <!--orderName-->
                   <div class="field-wrap">
                       <label class=''>
                           Order Name<span class="req">*</span>
                       </label>
                       <input type="text" name="orderName" autocomplete="off" value=""/>
                   </div>

                   <div class="field-wrap">
                       <label class=''>
                       Number of Copies<span class="req">*</span>
                       </label>
                       <input type="number" name="noOfCopies" required autocomplete="off" value=""/>
                   </div>

                   <!--orderType && specs-->
                   <div class="top-row">

                       <div class="field-wrap">
                           <select name="orderType" id='orderType' required autocomplete="off" value="">
                             <option value='' selected disabled>Order Type<span class="req">*</span></option>
                             <option  value='Receipt'>Receipt</option>
                             <option  value='Document'>Document</option>
                           </select>
                       </div>
                       <div class="field-wrap">
                           <select name="specs" required autocomplete="off" id='specs'>
                             <option selected val=''>Specifications<span class="req">*</span></option>

                           </select>
                       </div>
                   </div>

                   <!--deliveryAddress-->
                   <div class="field-wrap">
                       <label class='active'>
                           Delivery Address<span class="req">*</span>
                       </label>
                       <input type="text" name="deliveryAddress" required autocomplete="off" value="<?php echo $_SESSION['address'];?>"/>
                   </div>

                   <!--fileToUpload-->
                   <div class="field-wrap">
                       <label class='active file'>
                           Upload File<span class="req">*</span>
                       </label>
                       <input type="hidden" value=""/>
                       <input type="file" style='' name="fileToUpload" id="fileToUpload">
                   </div>
                   <!--orderDesc-->
                   <div class="field-wrap" >
                   <h3 style='color:white;'>Description:</br></h3>

                      <textarea style='display:inline-block' name="orderDesc" autocomplete="off" value=""></textarea>
                   </div>

                   <br/><br/>
                   <button id='placeOrder' class="button button-block"/>Order</button>
          </form>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
