<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="icon.png" />
        <title>Announcement - Care Option</title>
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
		<p>
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
            include("menu.php");
        ?>
    </header>
        
        <!-- Do not modify anything above -->
        <div id="wrapper">
            <div class="title">
            	<p class="titlein">Lorem ipsum dolor sit amet</p>
            </div>
            <div class="article">
		<p></p>
		<div style="display: flex; justify-content: center;">
		  <img src="news/news1.jpg" width="60%" height="50%"/>
		</div>
		<br/><br/><p id="aboutdes">Lorem ipsum dolor sit amet</p>
		<br/><p class="articlep">&nbsp Lorem ipsum dolor sit amet</p>
		<br/><a href="#"  class="btn btn-head">Read More</a>
		<br/><br/>
            </div>
	</div>
	
	<br/><br/><br/><br/><br/><br/><br/><br/>
	<div id="wrapper">
            <div class="title">
            	<p class="titlein">Lorem ipsum dolor sit amet</p>
            </div>
            <div class="article">
        	<p></p>
		<div style="display: flex; justify-content: center;">
            <img src="news/news2.jpg" width="80%" height="50%"/>
		</div>
		<br/><br/><p id="aboutdes">Lorem ipsum dolor sit amet</p>
		<br/><p class="articlep">&nbsp Lorem ipsum dolor sit amet</p>
		<br/><a href="#"  class="btn btn-head">Read More</a>
		<br/><br/>
            </div>
        </div>
	
        <br/><br/><br/><br/><br/><br/><br/><br/>
	<div id="wrapper">
            <div class="title">
            	<p class="titlein">Lorem Ipsum Dolor Sit Amet</p>
            </div>
            <div class="article">
                <p></p>
		<div style="display: flex; justify-content: center;">
            <img src="news/news3.jpg" width="80%" height="50%"/>
		</div>
		<br/><br/><p id="aboutdes">Image</p>
		<br/><p>&nbsp Lorem ipsum dolor sit amet</p>
		<br/><a href="#"  class="btn btn-head">Read More</a>
		<br/><br/>
            </div>
        </div>
	<br/><br/>
        <!-- Do not modify anything below -->
        <footer>
        </footer>
    </body>
</html>
