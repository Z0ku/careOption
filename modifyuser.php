<?php //Starts session
    include("library.php");
    startsession("admin")
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>Modify Users - Care Option</title>
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

            $info = array(
                "name"=>"",
                "email"=>"",
                "contactNo"=>"",
                "role"=>"",
                "address"=>""
            );
            $hasval = '';
            $status = 'Add';
            $userToUpdate = '';

            if(isset($_POST['toupdate'])){
                echo 'to update';
                $hasval = "active";
                $status = 'Update';
                $sql = "SELECT * FROM users WHERE userId='".$_POST['toupdate']."'";
                $result = $conn->query($sql);

                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    $userIdToUpdate = $row['userId'];
                    $userToUpdate = ': '.$row['name'];

                    if($row['employeeId'] != NULL){
                        $role = 'Employee';
                    }else if($row['ownerId'] != NULL){
                        $role = 'Admin';
                    }else{
                        $role = 'Client';
                    }

                    $info['name'] = $row['name'];
                    $info['email'] = $row['email'];
                    $info['contactNo'] = $row['contactNo'];
                    $info['role'] = $role;
                    $info['address'] = $row['address'];
                }

            }else if(isset($_POST['update'])){
                updateUser();
            }else if(isset($_POST['delete'])){
                $sql = "DELETE FROM users WHERE userId='".$_POST['delete']."'";
                $result = $conn->query($sql);
            }else if(isset($_POST['add'])){
                $flag = addUser();
            }
        ?>

        <div id="admin">
            <div id="logo">
		<p><a href="admin.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
            </div>

            <div id="title">
                <h1>Modify Users</h1>
            </div>

            <div id="modifyusertable">
            <p id="userdesc">Users</p>
            <input style='height:50px;width:100%' type="text" placeholder="Search Users" id='searchUserEdits' autocomplete="off" value=""/>
            <form action="modifyuser.php" method="post">
            <div class="table">
            <table class="table-fill">
                <thead>
                    <tr id="right">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">Contact No</th>
                        <th class="text-left">Address</th>
                        <th class="text-left">Employee ID</th>
                        <th class="text-left">Admin ID</th>
                        <th class="text-left">Update</th>
                        <th class="text-left">Delete</th>
                    </tr>
                </thead>
                <tbody class="table-hover" id='userEdits'>
                 <?php include 'searchUserEdit.php'; ?>
                </tbody>
            </table>
            </div>
            </form>
            </div>

            <div id="modifyuserbox">
                <h1><?php echo $status;?> User <?php echo $userToUpdate;?></h1>
                <div id="modifyuser">
                    <div class="form">
                        <div id="signup">
                        <form action="modifyuser.php" method="post">
                        <div class="field-wrap">
                            <label class='<?php echo $hasval; ?>'>
                                Name<span class="req">*</span>
                            </label>
                            <input type="text" name="name" required autocomplete="off" value='<?php echo $info['name'];?>'/>
                        </div>
                        <div class="field-wrap">
                            <label class='<?php echo $hasval; ?>'>
                                Email Address<span class="req">*</span>
                            </label>
                            <input type="email" name="email" required autocomplete="off" value='<?php echo $info['email'];?>'/>
                        </div>
                        <div class="top-row">
                            <div class="field-wrap">
                                <label class='<?php echo $hasval; ?>'>
                                Contact Number<span class="req">*</span>
                                </label>
                                <input type="text" name="contactNo" required autocomplete="off" value='<?php echo $info['contactNo'];?>'/>
                            </div>
                            <div class="field-wrap">
                                <label class='<?php echo $hasval; ?>'>
                                Role<span class="req">*</span>
                                </label>
                                <input type="text" name="role" required autocomplete="off" value='<?php echo $info['role'];?>'/>
                            </div>
                        </div>
                        <div class="field-wrap">
                            <label class='<?php echo $hasval; ?>'>
                                Address<span class="req">*</span>
                            </label>
                              <input type="text" name="address" required autocomplete="off" value='<?php echo $info['address'];?>'/>
                        </div>
                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                                Set A Password<span class="req">*</span>
                                </label>
                                <input type="password" name="password" required autocomplete="off"/>
                            </div>
                            <div class="field-wrap">
                                <label>
                                Confirm Password<span class="req">*</span>
                                </label>
                                <input type="password" name="confirmpass" required autocomplete="off"/>
                            </div>
                        </div>
                        <center>
                            <?php
                                if($status == 'Add'){
                                    echo '<button type="submit" name="add" value="" class="button button-block"/>Add</button>';
                                }else{
                                    echo '<button type="submit" name="update" value="'.$userIdToUpdate.'" class="button button-block"/>Update</button>';
                                }

                            ?>

                            &nbsp;&nbsp;&nbsp;&nbsp;<button onclick='modifyuser.php' formnovalidate name="clear" value="" class="button button-block"/>Clear</button>
                        </center>
                        <?php                       //Add User status
                            if(isset($flag)){
                                switch($flag){
                                case 0:
                                    echo "<p>User successfully added.</p>";
                                    break;
                                case 1:
                                    echo "<p class='error'>Password does not match.</p>";
                                    break;
                                case 2:
                                    echo "<p class='error'>Email is already in use.</p>";
                                    break;
                                case 3:
                                    echo "<p class='error'>Connection Error.</p>";
                                    break;
                                }
                            }
                        ?>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        <!-- Do not modify anything below -->
        <script src='js/jquery.min.js'></script>
        <script src="js/index.js"></script>
        <footer>
        </footer>
    </body>
</html>
<?php include 'jslinks.php'; ?>
<script src='js/admin.js'></script>
