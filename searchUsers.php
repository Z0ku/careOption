<?php
$search = "";
if(isset($_GET['search'])){
  include('library.php');
  startsession('admin');
  $search = (trim($_GET['search']) !== '')?" WHERE LOWER(users.name) LIKE LOWER('".trim($_GET['search'])."%') ":"";

}                                                   //Display users
   $conn = connectDB();                                                        //Connect to database function

    $sql = "SELECT users.*,count(printorders.orderId) as orderCount FROM users LEFT JOIN printorders ON printorders.userId = users.userId AND printorders.orderStatus >= 1 AND printorders.orderStatus < 5 {$search} GROUP BY users.userId ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()){
            if($row['employeeId'] != NULL){
                $role = 'Employee';
            }else if($row['ownerId'] != NULL){
                $role = 'Admin';
            }else{
                $role = 'Client';
            }
            $email = explode("@", $row["email"]);
            echo '
            <tr id="right">
                <td>'.$row["userId"].'</td>
                <td>'.$row["name"].'</td>
                <td>'.$email[0].'@<br>'.$email[1].'</td>
                <td>'.$row["contactNo"].'</td>
                <td>'.$row["address"].'</td>
                <td>'.$role.'</td>
                <td>'.$row['orderCount'].'</td>
            </tr>
            ';
        }
    }
    $conn->close();
?>
