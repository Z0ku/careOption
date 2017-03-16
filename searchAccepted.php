<?php
    $search = "";
    if(isset($_GET['search'])){
      include('library.php');
      startsession('employee');
      $search = (trim($_GET['search']) !== '')?"AND (LOWER(users.name) LIKE LOWER('".addslashes(trim($_GET['search']))."%') || LOWER(printorders.orderName) LIKE LOWER('".addslashes(trim($_GET['search']))."%')) ":"";

    }
    $conn = connectDB();                                                //Connect to database function

    $sql = "SELECT printorders.*,users.name  FROM printorders INNER JOIN users ON printorders.userId = users.userId WHERE orderStatus = 1 ".$search;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '
            <tr id="left">
                <td>'.$row["orderId"].'</td>
                <td>'.$row["name"].'</td>
                <td>'.$row["orderName"].'</td>
<td>'.$row["noOfCopies"].'</td>
                <td>'.$row["orderDate"].'</td>
                <td><button type="submit" name="accept" value="'.$row["orderId"].'" class="button deletebtn"/>Accept</button></td>
                <td><button type="submit" name="download" value="'.$row["orderId"].'" class="button deletebtn"/>&nbsp;&nbsp;&nbsp;DL&nbsp;&nbsp;&nbsp;</button></td>
                <td><button type="button" data-toggle="modal" data-target="#orderDetails" data-id="'.$row["orderId"].'" class="button viewDetails"/>&nbsp;&nbsp;View&nbsp;&nbsp;</button></td>
              </tr>
            ';
        }
    } else {
        echo "<h4>No Approved Orders</h4>";
    }
    $conn->close();
?>
