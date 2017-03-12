<?php //Starts session
    include("library.php");
    ob_start();
?>  

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	   	<link rel="shortcut icon" href="icon.png" />
        <title>Register - Care Option</title>

        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/style_form.css" />

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

	<div id="logo">
		<p><a href="index.php"><img id="logopic" src="logo.png" alt="Company"/></a></p>
	</div>
	
	<header>
		<a href="index.php">
			<img id="homebtn" src="img/home.jpg"  alt="Home" style="width:30px;height:30px;border:0;">
		</a>
		<?php
		    include("menu.php");
		?>
	</header>
        
        <!-- Do not modify anything above -->
        <?php
            if(isset($_POST['register'])){
               $conn = connectDB();                                                        //Connect to database function
               $flag = addUser();
            }
        ?>


        <div id="register">
            	<h1>Register</h1>
                <div id="modifyuser">   
                    <div class="form">
                        <div id="signup">             
                        <form action="register.php" method="post">
                        <div class="field-wrap">
                            <label>
                                Name<span class="req">*</span>
                            </label>
                            <input type="text" name="name" required autocomplete="off"/>
                        </div>
                        <div class="field-wrap">
                            <label>
                                Email Address<span class="req">*</span>
                            </label>
                            <input type="email" name="email" required autocomplete="off"/>
                        </div>
                        <div class="field-wrap">
                            <label>
                                Address<span class="req">*</span>
                            </label>
                              <input type="text" name="address" required autocomplete="off"/>
                        </div> 
                        <div class="field-wrap">
                            <label>
                                Contact Number<span class="req">*</span>
                            </label>
                            <input type="text" name="contactNo" required autocomplete="off" />
                        </div> 
                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                                Set A Password<span class="req">*</span>
                                </label>
                                <input type="password" name="password" required autocomplete="off" />
                            </div>
                            <div class="field-wrap">
                                <label>
                                Confirm Password<span class="req">*</span>
                                </label>
                                <input type="password" name="confirmpass" required autocomplete="off"/>
                            </div>
                        </div>
                            <br/><br/>
                            <button type="submit" name="register" class="button button-block"/>Register</button>
                        </form>
                        <?php                       //Register User status
                            if(isset($flag)){
                                switch($flag){
                                case 0:
                                    echo "<script>alert('User successfully added.');</script>";
                                    header('Location: index.php');
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