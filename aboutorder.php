<?php
	include("library.php");
	$conn = connectDB();                                                        //Connect to database function

	if(isset($_POST['download'])){
	    $sql = "SELECT * FROM printorders WHERE orderId = ".$_POST['download'];
	    $result = $conn->query($sql);
	    $row = $result->fetch_assoc();
		$file = './files/'.$row['userId'].'/'.$row['orderId'].'_'.$row['file'];
		echo $file;
		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Content-Disposition: attachment; filename="'.$row['file'].'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);
		    exit;
		}else{
			echo "fail";
		}
	}

?>