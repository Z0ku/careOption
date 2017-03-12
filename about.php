<?php
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>About Us - Care Option</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/style_news.css" />

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
		<?php
			if(isset($_SESSION['role'])){
				echo "<a href='{$_SESSION['role']}.php'>";
			}else{
				echo '<a href="index.php">';
			}
		?>
		<img id="logopic" src="logo.png" alt="Company"/></a></p>
	</div>
        
	<header>
		<?php
			if(isset($_SESSION['role'])){
				echo "<a href='{$_SESSION['role']}.php'>";
			}else{
				echo '<a href="index.php">';
			}
		?>
			<img id="homebtn" src="img/home.jpg"  alt="Home" style="width:30px;height:30px;border:0;">
		</a>
		<?php
			//$page = $_GET['page'];
		    include("menu.php");
		?>
	</header>
        
        <!-- Do not modify anything above -->
        <div id="wrapper">
		<div class="title">
			<p class="titlein">About Us</p>
		</div>
		<div class="article">
			<br/>
			<div style="display: flex; justify-content: center;">
			  <img src="img/about.jpg" width="90%" height="45%"/>
			</div>
			<br/><br/><p id="aboutdes">Image Description</p>
			<br/><p class="articlep">&nbsp&nbsp&nbsp Life is about moving on because life is too short to waste.</p>
			<br/><a href="index.htmlz"  class="btn btn-head">Go Back</a>
			<br/><br/>
		</div>
	</div>
        	
	<br/><br/>
        <!-- Do not modify anything below -->
        <footer>
        </footer>
    </body>
</html>
