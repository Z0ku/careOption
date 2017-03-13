<?php
    if(isset($_GET['search'])){
      include('library.php');
      startsession('client');
    }                                                               //Display Order History
    $conn = connectDB();                                                        //Connect to database function
    $search = "";

    if(isset($_GET['search'])){
      $search = ($_GET['search'] !== '')?" AND LOWER(orderName) LIKE LOWER('".$_GET['search']."%')":"";
    }

    $sql = "SELECT * FROM printorders WHERE orderStatus = 3 AND userId = ".$_SESSION['userId'].$search;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {                                                //Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '
            <tr id="right">
                <td>'.$row["orderId"].'</td>
                <td>'.$row["orderName"].'</td>
                <td>'.$row["orderDate"].'</td>
                <td><button type="button"  data-id="'.$row["orderId"].'" class="button deletebtn resendOrder"  data-toggle="modal" data-target="#order" />Order</button></td>
                <td><button type="submit" name="download" value="'.$row["orderId"].'" class="button deletebtn"/>&nbsp;&nbsp;DL&nbsp;&nbsp;</button></td>
                <td><button type="button" data-toggle="modal" data-target="#orderDetails" data-id="'.$row["orderId"].'" class="button viewDetails"/>&nbsp;&nbsp;View&nbsp;&nbsp;</button></td>
            </tr>
            ';
        }
    } else {
        echo "<h4>No Order History</h4>";
    }
    $conn->close();
?>
