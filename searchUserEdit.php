<?php

    $search = "";
   if(isset($_GET['search'])){
     include('library.php');
     startsession('admin');
     $search = (trim($_GET['search']) !== '')?"WHERE (LOWER(users.name) LIKE LOWER('".addslashes(trim($_GET['search']))."%')) ":"";
   }
      $conn = connectDB();
   $sql = "SELECT * FROM users ".$search;
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
       // output data of each row
       while($row = $result->fetch_assoc()) {
           $employee = $admin = "N/A";
           if($row['employeeId'] != NULL){
               $employee = $row['employeeId'];
           }else if($row['ownerId'] != NULL){
               $admin = $row['ownerId'];
           }
           $email = explode("@", $row["email"]);
           echo '
           <tr id="right">
               <td>'.$row["userId"].'</td>
               <td>'.$row["name"].'</td>
               <td>'.$email[0].'@<br>'.$email[1].'</td>
               <td>'.$row["contactNo"].'</td>
               <td>'.$row["address"].'</td>
               <td>'.$employee.'</td>
               <td>'.$admin.'</td>
               <td><button type="submit" name="toupdate" value="'.$row["userId"].'" class="button deletebtn"/>&nbsp&nbsp⟹&nbsp&nbsp</button></td>
               <td><button type="submit" name="delete" value="'.$row["userId"].'" class="button deletebtn"/>&nbsp&nbsp⟹&nbsp&nbsp</button></td>
           </tr>
           ';
       }
   }
   $conn->close();
?>
