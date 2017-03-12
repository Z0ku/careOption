<?php
	echo '
			<div id="nav">
				<ul>
		';

	if(isset($_SESSION['role'])){
		echo '<a href="logout.php" class="btn btn-head">Logout</a>';
		$list = array(
						"Announcement" => "news.php", 
						"About" =>"about.php",
						"Contact" =>"contact.php",
						"Manage Account" =>"manageaccount.php"
					);
	}else{
		echo '<a href="contact.php?page=index"  class="btn btn-head">Contact</a>';
		$list = array(
						"About" => "about.php", 
						"Announcement" =>"news.php"
					);

	}

	foreach($list as $pagename =>$url){
		echo '<li class=""><a class="navlink" href="'.$url.'">'.$pagename.'</a></li>';
	}

	echo "	</ul>
		</div>";

?>