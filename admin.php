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
            }else if($_POST['decline']) {
                declineOrder();
            }

        ?>
        <div id="admin">
            <div id="logo">
                <p><a href="admin.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
            </div>

            <div id="title">
                <h1><?php echo $_SESSION['name'].'&#39;s';?> Dashboard</h1>
            </div>
            <a class='button button-danger btn-lg'>View Reports</a>
            <div id="user">
            <p id="userdesc">Users</p>
            <input style='height:50px;width:100%' type="text" placeholder="Search Users" id='searchUsers' autocomplete="off" value=""/>

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
                        <th class='text-left'>FoAD</th>
                    </tr>
                </thead>
                <tbody class="table-hover" id='displayUsers'>

                  <?php include 'searchUsers.php';?>
                </tbody>
            </table>
            </div>
            </div>

            <div id="inventory">
            <p id="inventorydesc">Orders Pending Approval</p>
            <input style='height:50px;width:100%' type="text" placeholder="Search Pending Orders" id='searchPending' autocomplete="off" value=""/>

            <div class="table">
            <form action="admin.php"  method="post">

              <table class="table-fill">
                  <thead>
                      <tr>
                          <th class="text-left">ID</th>
                          <th class="text-left">Client</th>
                          <th class="text-left">Name</th>
                          <th class="text-left">Date</th>
                          <th class="text-left">Copies</th>
                          <th class="text-left">Decline</th>
                          <th class="text-left">Approve</th>
                          <th class="text-left">Download</th>
                          <th class="text-left">Details</th>
                      </tr>
                  </thead>
                  <tbody class="table-hover" id='pending'>


                  <?php  include 'searchPending.php'; ?>


                  </tbody>
              </table>
            </form>
            </div>
            </div>
                <a href="modifyuser.php"  id="modifyuserbtn" class="btn btn-head">Modify Users</a>
                <form action="admin.php" method="post">
                    <a href="admin.php?approve=all"  id="approvebtn" class="btn btn-head">Approve All</a>
                </form>
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
