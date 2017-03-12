<?php //Starts session
    include("library.php");
    startsession("admin")
?>  

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>Admin Dashboard - Care Option</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/style_form.css" />
        <link rel="stylesheet" type="text/css" href="css/style_admin.css" />
        <link rel="stylesheet" type="text/css" href="css/style_table.css" />

    </head>
    <body>
    <ul class="bg-slideshow">
            <li><span>Image 01</span><div><h3></h3></div></li>
            <li><span>Image 02</span><div><h3></h3></div></li>
            <li><span>Image 03</span><div><h3></h3></div></li>
            <li><span>Image 04</span><div><h3></h3></div></li>
            <li><span>Image 05</span><div><h3></h3></div></li>
            <li><span>Image 06</span><div><h3></h3></div></li>
    </ul>
        
    <header>
        <a  href="admin.php">
            <img id="homebtn" src="img/home.jpg"  alt="Home">
        </a>
        <?php
            include("menu.php");
        ?>
    </header>
        
        <!-- Do not modify anything above -->

        <?php
            $conn = connectDB();                                                        //Connect to database function

            if(isset($_GET['approve'])){                                                //Approve all

                $sql = "UPDATE printorders SET orderStatus = 1 WHERE orderStatus = 0";
                $result = $conn->query($sql);
            }else if(isset($_POST['approve'])){                                         //Approve specific
                $sql = "UPDATE printorders SET orderStatus = 1 WHERE orderStatus = 0 AND orderId = ".$_POST['approve'];
                $result = $conn->query($sql);
            }else if(isset($_POST['download'])){
                downloadFile();
            }
        
        ?>
        <div id="admin">
            <div id="logo">
                <p><a href="admin.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
            </div>
            
            <div id="title">
                <h1><?php echo $_SESSION['name'].'&#39;s';?> Dashboard</h1>    
            </div>
            
            <div id="user">
            <p id="userdesc">Users</p>
            <div class="table">
            <table class="table-fill">
                <thead>
                    <tr id="right">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Contact No</th>
                        <th class="text-left">Address</th>
                        <th class="text-left">Role</th>
                    </tr>
                </thead>
                <tbody class="table-hover">

                <?php                                                                          //Display users
                   $conn = connectDB();                                                        //Connect to database function

                    $sql = "SELECT * FROM users";
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
                            </tr>
                            ';
                        }
                    }
                    $conn->close();
                ?>
                </tbody>
            </table>
            </div>
            </div>
            
            <div id="inventory">
            <p id="inventorydesc">Orders Pending Approval</p>
            <div class="table">
            <table class="table-fill">
                <thead>
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Client</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Date</th>
                        <th class="text-left">Specs</th>
                        <th class="text-left">Copies</th>
                        <th class="text-left">Approve</th>
                        <th class="text-left">Download</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                <form action="admin.php" method="post">

                <?php                                                                           //Display orders pending approval
                    $conn = connectDB();                                                        //Connect to database function

                    $sql = "SELECT printorders.*,users.name  FROM printorders INNER JOIN users ON printorders.userId = users.userId WHERE orderStatus = 0";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()){
                            echo '
                            <tr id="left">
                                <td>'.$row["orderId"].'</td>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["orderName"].'</td>
                                <td>'.$row["orderDate"].'</td>
                                <td>'.$row["specs"].'</td>
                                <td>'.$row["noOfCopies"].'</td>
                                <td><button type="submit" name="approve" value="'.$row["orderId"].'" class="button deletebtn"/>Approve</button></td>   
                                <td><button type="submit" name="download" value="'.$row["orderId"].'" class="button deletebtn"/>&nbsp;&nbsp;DL&nbsp;&nbsp;</button></td>
                            </tr>
                            ';
                        }
                    } else {
                        echo "<h4>No Pending Approval</h4>";
                    }
                    $conn->close();
                ?>
                </form>
                </tbody>
            </table>
            </div>
            </div>
                <a href="modifyuser.php"  id="modifyuserbtn" class="btn btn-head">Modify Users</a>
                <form action="admin.php" method="post">
                    <a href="admin.php?approve=all"  id="approvebtn" class="btn btn-head">Approve All</a>
                </form>
        <!-- Do not modify anything below -->
        <footer>
        </footer>
    </body>
</html>
