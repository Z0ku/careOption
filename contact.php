<?php
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>Contact - Care Option</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/style_contact.css" />

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
		<?php
			if(isset($_SESSION['role'])){
				echo "<a href='{$_SESSION['role']}.php'>";
			}else{
				echo '<a href="index.php">';
			}
			include("menu.php");
		?>
			<img id="homebtn" src="img/home.jpg"  alt="Home" style="width:30px;height:30px;border:0;">
		</a>
	</header>
        
        <!-- Do not modify anything above -->
        <div id="contactinfo">
		<div id="logo">
		<p>
		<?php
			if(isset($_SESSION['role'])){
				echo "<a href='{$_SESSION['role']}.php'>";
			}else{
				echo '<a href="index.php">';
			}
		?>
		
		<img id="logopic" src="logo.png" alt="Rashleigh Choachuy"/></a></p>
		</div>
	
		<form action="mailto:yuchipashe@gmail.com" class="cd-form floating-labels">
		<br/><br/><br/><br/>	
			<div class="error-message">
				<p>Please enter a valid email address</p>
			</div>

			<div class="icon">
				<label class="cd-label" for="cd-name">Name</label>
				<input class="user" type="text" name="cd-name" id="cd-name" required>
		    </div> 


		    <div class="icon">
		    	<label class="cd-label" for="cd-email">Email</label>
				<input class="email error" type="email" name="cd-email" id="cd-email" required>
		    </div>


			<div class="icon">
				<label class="cd-label" for="cd-textarea">Messages</label>
      			<textarea class="message" name="cd-textarea" id="cd-textarea" required></textarea>
			</div>

                    <div>
		      	<input type="submit" value="Send Message">
		    </div>
                    </form>
            
	<div id="contactside">
		<br/><br/><br/><h2 style="font-size:28px">Contact Us!</h2>
		<br/><br/><h3 style="font-size:20px">Contact Numbers:</h3>
		<br/><p>+(63)912 - 345 - 6789</p>
		<br/><br/><h3 style="font-size:20px">Email Address:</h3>
		<br/><p>username@gmail.com</p>
		<br/><br/><br/><br/><a href="https://www.facebook.com/#">
		<img border="0" alt="Facebook" src="img/facebook.png" width="100" height="100">
		</a>
		<a href="https://www.twitter.com/#">
		<img border="0" alt="Facebook" src="img/twitter.png" width="100" height="100">
		</a>
		<a href="http://steamcommunity.com/id/#/">
		<img border="0" alt="Steam" src="img/steam.ico" width="100" height="100">
		</a>
	</div>
	</div>
        <!-- Do not modify anything below -->
        <footer>
        </footer>
    </body>
</html>
