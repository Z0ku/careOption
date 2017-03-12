<?php
include('library.php');
startsession('client');
$conn = connectDB();


  if(isset($_GET['order'])){
      $hasval = "active";
      $sql = "SELECT * FROM printorders WHERE orderId={$_GET['order']}";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1 && $row["userId"] == $_SESSION['userId']){
          echo json_encode($row);
      }else{
      //    header('Location: 403.php');
      }
  }

?>
