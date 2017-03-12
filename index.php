<?php //Start session and redirects to correct page via role
	include("library.php");
	startsession("index");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	   	<link rel="shortcut icon" href="icon.png" />
        <title>Login - Care Option</title>

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
            <img id="homebtn" src="img/home.jpg"  alt="Home">
        </a>
		<?php
		    include("menu.php");
		?>
	</header>
        <!-- Do not modify anything above -->
        <div id="login">
            	<img id="loginlogo" src="icon.png" alt="Logo">
        		<p><b>Care Option</b></p>
        		<p><em>"Have Hope. Hold On, Pain Ends..."</em></p>
                <h2>Login</h2>

                <!--Login form start -->  
                 <div class="form">   
                    <form method ="POST" action="index.php"> 

                    	<!--Email-->
	                    <div class="field-wrap">
	                        <label>Email Address<span class="req">*</span></label>
	                        <input type="email" name="email" required autocomplete="off"/>
	                    </div>

	                    <!--Password-->
	                    <div class="field-wrap">
	                        <label>Password<span class="req">*</span></label>
	                        <input type="password" name="pass" required autocomplete="off"/>
	                    </div>

	                    <?php //Checks username and password
	                    	
	                    	$flag = login();	//Login function, returns flag

						    if($flag == 1){
						    	echo "<p class='error'>Email or Password cannot be empty.</p>";
						    }else if($flag == 2){
						    	echo "<p class='error'>User not found.</p>";
						    }else if($flag == 3){
						    	echo "<p class='error'>Password Incorrect. <br/>(<a href='forgotpass.php' style='color: red;'>Forgot Password?</a>)</p>";
						    }
	                    ?>

	                    <span class="cd-modal-action">
	        			     <a href="#"  onclick="document.forms[0].submit();" class="btn">Login</a>
	                    </span> &nbsp;&nbsp;&nbsp;&nbsp;
	                    
	                    <span class="cd-modal-action">
	        			     <a href="register.php" class="btn">Register</a>
	                    </span>
	                    <input type="submit" style="color: transparent; background-color: transparent; border-color: transparent; cursor: default;">
                    </form>
                     <!--Login form ends -->  
                </div>
            </div>
        <!-- Do not modify anything below -->
        <script src='js/jquery.min.js'></script>
        <script src="js/index.js"></script>
        <script>
        </script>
        <footer>
        </footer>
    </body>
</html>