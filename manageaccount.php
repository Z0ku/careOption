<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header('Location: 403.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	   	<link rel="shortcut icon" href="icon.png" />
        <title>Manage Account - Care Option</title>

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
		<p>
        <?php
            echo "<a href='{$_SESSION['role']}.php'>";
        ?>
        <img id="logopic" src="logo.png" alt="Company"/></a></p>
	</div>
	
	<header>
        <?php
            echo "<a href='{$_SESSION['role']}.php'>";
        ?>
            <img id="homebtn" src="img/home.jpg"  alt="Home" style="width:30px;height:30px;border:0;">
        </a>
        <?php
            include("menu.php");
        ?>
    </header>
        
        <!-- Do not modify anything above -->
        <div id="register">
            	<h1>Manage Account</h1>
                <div id="modifyuser">   
                    <div class="form">
                        <div id="signup">             
                        <form action="modifyUser2.jsp" method="post">
                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                                User ID<span class="req">*</span>
                                </label>
                                <input type="text" name="userId" required autocomplete="off" />
                            </div>
                            <div class="field-wrap">
                                <label>
                                Username<span class="req">*</span>
                                </label>
                                <input type="text" name="username" required autocomplete="off"/>
                            </div>
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
                              <input type="text" name="contactNo" required autocomplete="off"/>
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
                        <!--
                        <%
                            if(flag == 1){
                            %>
                                <p class="error">Can't add user. User already exist.</p>
                            <%
                            }else if(flag == 2){
                            %>
                                <p class="error">Can't modify user. User does not exist.</p>
                            <%
                            }else if(flag == 3){
                            %>
                                <p class="error">Password does not match.</p>
                            <%
                            }else if(flag == 4){
                            %>
                                <p class="error">Role must be only admin or cashier.</p>
                            <%
                            }
                        %>-->

                            <br/><br/>
                            <button type="submit" name="btn" value="add" class="button button-block"/>Update</button> &nbsp;&nbsp;&nbsp;
                            <button type="submit" name="btn" value="add" class="button button-block"/>Deactivate</button>
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