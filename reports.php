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
        <a  href="admin.php">
            <img id="homebtn" src="img/home.jpg"  alt="Home">
        </a>
        <?php
            include("menu.php");
        ?>
    </header>

        <!-- Do not modify anything above -->


        <div id="admin">
            <div id="logo">
                <p><a href="admin.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
            </div>

            <div id="title">
                <h1>Reports</h1>
            </div>

          <div id = 'user' class='row' style='width:inherit'>
            <div class='col-md-6'>
              <h2 class='text-center'>Service Type Reports</h2>
              <div class='text-left'>
                <?php
                  $conn = connectDB();

                  foreach($orderTypes as $type){
                    $sql = "SELECT count(*) as typeCount FROM printorders WHERE orderType = '{$type}'";
                    $result = $conn->query($sql);
                    echo "<h3>{$type} - {$result->fetch_assoc()['typeCount']}</h3>";
                  }
                ?>
                <h2 class='text-center'>Service Reports</h2>
                <div class='text-left'>
                  <?php
                    $conn = connectDB();

                    $sql = "SELECT YEAR(orderDate),MONTH(orderDate),count(*) FROM printorders WHERE orderStatus = 1 || orderStatus = 4 GROUP BY YEAR(orderDate),MONTH(orderDate)";

                    $result = $conn->query($sql);


                  ?>
                </div>
              </div>
            </div>
            <div class='col-md-6 text-left'>
              <h2>Top 10 Users with Most Accepted Orders</h2>
              <?php
                $conn = connectDB();

                $sql = "SELECT users.name,COUNT(printorders.orderId) as orderCount FROM users ".
                       "LEFT JOIN printorders ON users.userId = printorders.userId ".
                       "WHERE printorders.orderStatus >= 1 AND printorders.orderStatus < 5 ".
                       "GROUP BY users.userId ".
                       "ORDER BY orderCount DESC LIMIT 10 ";

                $result = $conn->query($sql);
                $i = 1;
                while($row = $result->fetch_assoc()){
                  echo "<h2 class='text-left'>{$i}. {$row['name']} - {$row['orderCount']} </h2>";
                  $i++;
                }

               ?>

            </div>
          </div>

        <!-- Do not modify anything below -->
      </div>
        <footer>
        </footer>
        <?php include 'orderDetailsModal.php';?>
        <?php include 'declineOrderModal.php';?>
    </body>
</html>
<?php include 'jslinks.php'; ?>
<script src='js/admin.js'></script>
