<?php
  include('library.php');

  $conn = connectDB();
  $sql = "SELECT * FROM printorders WHERE orderId =".$_GET['id'];
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>
<div class='container-fluid' style='color:white'>
  <h2>Order Name: <?php echo $row['orderName'];?></h2>
  <h2>Number of Copies: <?php echo $row['noOfCopies'];?></h2>
  <h2>Order Type: <?php echo $row['orderType'];?></h2>
  <h2>Specifications: <?php echo $row['specs'];?></h2>
  <h3 style='white-space:pre;'>Description:</br> <?php echo $row['orderDesc'];?></h3></br>
  <h3 style='white-space:pre;'>Comments:</br><?php echo $row['comments'];?></h3>
</div>
