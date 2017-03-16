<?php //Starts session
    include("library.php");
    startsession("employee")
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>Employee Dashboard - Care Option</title>
        <?php include 'csslinks.php' ?>

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
        <a href="employee.php">
            <img id="homebtn" src="img/home.jpg"  alt="Home" style="width:30px;height:30px;border:0;">
        </a>
        <?php
            include("menu.php");
        ?>
    </header>

        <!-- Do not modify anything above -->
        <?php
            $conn = connectDB();                                             //Connect to database function

            if(isset($_POST['accept'])){
                $sql = "UPDATE printorders SET orderStatus = 2, employeeId = {$_SESSION['employeeId']} WHERE orderId = {$_POST['accept']}";
                $result = $conn->query($sql);
            }else if(isset($_POST['printed'])){
                $sql = "UPDATE printorders SET orderStatus = 3 WHERE orderId = {$_POST['printed']} AND employeeId = {$_SESSION['employeeId']}";
                $result = $conn->query($sql);
            }else if(isset($_POST['download'])){
                downloadFile();
            }else if(isset($_POST['delivered'])){
              $sql = "UPDATE printorders SET orderStatus = 4 WHERE orderId = {$_POST['delivered']} AND employeeId = {$_SESSION['employeeId']}";
              $result = $conn->query($sql);
            }
        ?>


        <div id="admin">
            <div id="logo">
                <p><a href="employee.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
            </div>

            <div id="title">
                <h1><?php echo $_SESSION['name'].'&#39;s';?> Dashboard</h1>
            </div>

            <form action="employee.php" method="post">
            <div id="user">
            <p id="userdesc">Current Orders</p>
            <div class="table">
            <table class="table-fill">
                <thead>
                    <tr id="right">
                        <th class="text-left">ID</th>
                        <th class="text-left">Client</th>
                        <th class="text-left">Name</th>
						            <th class="text-left">Copies</th>
                        <th class="text-left">Date</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Download</th>
                        <th class="text-left">Details</th>

                    </tr>
                </thead>
                <tbody class="table-hover">
                    <?php
                        $conn = connectDB();                                                //Connect to database function

                        $sql = "SELECT printorders.*,users.name  FROM printorders INNER JOIN users ON printorders.userId = users.userId WHERE (orderStatus = 2 OR orderStatus = 3) AND printorders.employeeId = ".$_SESSION['employeeId'];
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '
                                <tr id="right">
                                    <td>'.$row["orderId"].'</td>
                                    <td>'.$row["name"].'</td>
                                    <td>'.$row["orderName"].'</td>
									                  <td>'.$row["noOfCopies"].'</td>
                                    <td>'.$row["orderDate"].'</td>';
                                    if($row["orderStatus"] == 2){
                                      echo '<td><button type="submit" name="printed" value="'.$row["orderId"].'" class="button deletebtn"/>Printed</button></td>';
                                    }else{
                                      echo '<td><button type="submit" name="delivered" value="'.$row["orderId"].'" class="button deletebtn"/>Delivered</button></td>';
                                    }
                                    echo '<td><button type="submit" name="download" value="'.$row["orderId"].'" class="button deletebtn"/>Download</button></td>
                                    <td><button type="button" data-toggle="modal" data-target="#orderDetails" data-id="'.$row["orderId"].'" class="button viewDetails"/>&nbsp;&nbsp;View&nbsp;&nbsp;</button></td>
                                </tr>
                                ';
                            }
                        } else {
                            echo "<h4>No Current Printing Orders</h4>";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
            </div>
            </div>

            <div id="inventory">
            <p id="inventorydesc">Approved Orders</p>
            <input style='height:50px;width:100%' type="text" placeholder="Search Accepted Orders" id='searchAccepted' autocomplete="off" value=""/>

            <div class="table">
            <table class="table-fill">
                <thead>
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Client</th>
                        <th class="text-left">Name</th>
						            <th class="text-left">Copies</th>
                        <th class="text-left">Date</th>
                        <th class="text-left">Accept Order</th>
                        <th class="text-left">Download</th>
                        <th class="text-left">Details</th>
                    </tr>
                </thead>
                <tbody class="table-hover" id='accepted'>
                  <?php include 'searchAccepted.php' ?>
                </tbody>
            </table>
            </div>
            </div>
            </form>
        </div>


        <!-- Do not modify anything below -->
        <footer>
        </footer>
        <?php include 'orderDetailsModal.php';?>

    </body>
</html>
<?php include 'jslinks.php'; ?>
<script src='js/employee.js'></script>
