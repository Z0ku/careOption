<?php
  $specArr = array(
    "Receipt"=>array(
      "None"
    ),
    "Document"=>array(
      "None",
      "A4",
      "A3",
      "A2"
    )
  );
  // echo "TEST";
  if(isset($_GET['type'])){
    $type = $_GET['type'];    
  }

  $specs = $specArr[$type];
  foreach($specs as $spec){
    echo "<option value='{$spec}'>{$spec}</option>";
  }
?>
