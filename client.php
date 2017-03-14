<?php //Starts session
    include("library.php");
    startsession("client");
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>Dashboard - Care Option</title>
        <?php include 'csslinks.php' ?>
        <link rel="stylesheet" type="text/css" href="css/client.css" />

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
		<a href="client.php">
			<img id="homebtn" src="img/home.jpg"  alt="Home" style="width:30px;height:30px;border:0;">
		</a>
        <?php
            include("menu.php");
        ?>
	</header>
        <!-- Do not modify anything above -->
    <?php
        if(isset($_POST['addOrder'])){                                                      //Redirects to addOrder
            header('Location: order.php?order='.$_POST['addOrder']);
        }else if(isset($_POST['cancelOrder'])){                                             //Cancel Order (delete order from db)
            cancelOrder();
        }else if(isset($_POST['download'])){
            downloadClientFile();                                                           //Downloads file
        }

    ?>

        <div id="admin">
            <div id="logo">
                <p><a href="client.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
            </div>

            <div id="title">
                <h1><?php echo $_SESSION['name'].'&#39;s';?> Dashboard</h1>
            </div>

            <form action="client.php" method="post">
            <div id="user">

                <p id="userdesc">Order History</p>
                <input style='height:50px;width:100%' type="text" placeholder="Search Your Order History" id='searchHistory' autocomplete="off" value=""/>

                    <div class="table">
                    <table class="table-fill">
                           <thead>
                                <tr id="right">
                                    <th class="text-right">ID</th>
                                    <th class="text-right">Name</th>
                                    <th class="text-right">Date</th>
                                    <th class="text-right">Add to Order</th>
                                    <th class="text-right">Download</th>
                                    <th class="text-right">Details</th>
                                </tr>
                            </thead>
                        <tbody class="table-hover" id='orderHistory'>
                        <?php include 'clientOrderHistory.php'; ?>
                        </tbody>
                    </table>
                    </div>
            </div>
            <div id="inventory">
                <p id="inventorydesc">Pending Orders</p>
                <div class="table">
                    <table class="table-fill">
                        <thead>
                            <tr>
                                <th class="text-left">ID</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Date</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Cancel Order</th>
                                <th class="text-left">Download</th>
                                <th class="text-left">Details</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                        <?php                                                                           //Display  Pending Orders
                            $conn = connectDB();                                                        //Connect to database function

                            $sql = "SELECT * FROM printorders WHERE orderStatus <= 3 AND userId = ".$_SESSION['userId'];
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {                                                //Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $btn = 'style="cursor:default; opacity:0.5;" disabled';
                                    if($row["orderStatus"] == 0){                                       //Check order status
                                        $status = "Pending";
                                        $btn = '';
                                    }else if($row["orderStatus"] == 1){
                                        $status = "Approved";
                                    }else if($row["orderStatus"] == 2){
                                        $status = "Printing";
                                    }
                                    echo '
                                    <tr id="left">
                                        <td>'.$row["orderId"].'</td>
                                        <td>'.$row["orderName"].'</td>
                                        <td>'.$row["orderDate"].'</td>
                                        <td>'.$status.'</td>
                                        <td><button type="submit" name="cancelOrder" value="'.$row["orderId"].'" class="button deletebtn"' .$btn.'/>Cancel</button></td>
                                        <td><button type="submit" name="download" value="'.$row["orderId"].'" class="button deletebtn"/>&nbsp;&nbsp;DL&nbsp;&nbsp;</button></td>
                                        <td><button type="button" data-toggle="modal" data-target="#orderDetails" data-id="'.$row["orderId"].'" class="button viewDetails"/>&nbsp;&nbsp;View&nbsp;&nbsp;</button></td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo "<h4>No Pending Order</h4>";
                            }
                            $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
            <button id="storebtn" data-toggle="modal" data-target="#order" class="btn btn-head">Make Order</button>


        </div>
        <!-- Do not modify anything below -->

        <footer>
        </footer>
          <?php include 'orderModal.php';?>
          <?php include 'orderDetailsModal.php';?>
    </body>
</html>
<?php include 'jslinks.php'; ?>
<script src='js/client.js'></script>
