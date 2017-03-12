<?php
	function startsession($page){													//Session start function
		session_start();
		switch($page){
			case "index":
				if(isset($_SESSION['role'])){
					header("Location: {$_SESSION['role']}.php ");
				}
				break;
			case "client":
			case "admin":
			case "employee":
				if(isset($_SESSION['role'])){
			        if($_SESSION['role'] != $page){
			            header('Location: 403.php');
			        }
			    }else{
			        header('Location: 403.php');
			    }
			default:
		}
	}

	function connectDB(){															//Database Connection function, return successful connection
		$servername = "localhost:3306";
		$username = "root";
		$password = "";
		$dbname = "printing_press";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		return $conn;
	}

	function login(){																//Login function, returns flag
		$flag = 0;
		if(isset($_POST['email']) && isset($_POST['pass'])){ 						//If a login query was sent
	        if($_POST['email'] != '' && $_POST['pass'] != ''){						//If submitted is not empty

	        	$conn = connectDB();												//Connect to database function

				$sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";		//Get user info via email
				$result = $conn->query($sql);										//Query sent

				if ($result->num_rows == 1) {										//If user exists
					$row = $result->fetch_assoc();
					$pass = hash("sha512", $_POST['pass']);
				    if($pass === $row['password']){									//If password is correct
				    	$_SESSION['userId'] = $row['userId'];
				    	$_SESSION['name'] = $row['name'];
				    	$_SESSION['address'] = $row['address'];
				    	if($row['ownerId'] != NULL){								//Login via corresponding roles
				    		$_SESSION['role'] = 'admin';
				    		$_SESSION['ownerId'] = $row['ownerId'];
				    	}else if($row['employeeId'] != NULL){
				    		$_SESSION['role'] = 'employee';
				    		$_SESSION['employeeId'] = $row['employeeId'];
				    	}else{
				    		$_SESSION['role'] = 'client';
				    	}
				    	header("Location: {$_SESSION['role']}.php");				//Redirects to user dashboard
				    }else{
				    	$flag = 3;													//ERROR: Incorrect password
				    }
				}else{																//ERROR: User does not exist
					$flag = 2;
				}
				$conn->close();
	        }else{																	//ERROR: Submitted field is empty
				$flag = 1;
			}
	    }
	    return $flag;
	}

	function cancelOrder(){															//Cancel Client Order function
		$conn = connectDB();                                                        //Connect to database function
		$sql = "DELETE FROM printorders WHERE orderId='".$_POST['cancelOrder']."'";
        $result = $conn->query($sql);
	}

	function placeOrder(){															//Place Order function
		$conn = connectDB();                                                        //Connect to database function
    	if(isset($_FILES['fileToUpload'])){
    		$target_dir = "files/".$_SESSION['userId']."/";							//Target Directory
            mkdir($target_dir, 0700);												//Create directory if target directory doesnt exist
            $uploadOk = 1;
            $fileType = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);

            if($fileType != "docx") {												//Upload only certain file format
                $flag = 1;
                echo "Sorry, only DOCX files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {													//If file cannot be uploaded
                echo "Sorry, your file was not uploaded.";
            } else {																//Upload file
                $sql = "INSERT INTO printorders VALUES (NULL,{$_SESSION['userId']}, '{$_POST['orderName']}', '".date("Y-m-d").
											 "', 0, '{$_POST['noOfCopies']}', '{$_POST['orderDesc']}', '".basename($_FILES["fileToUpload"]["name"]).
											 "', '{$_POST['orderType']}', '{$_POST['specs']}','', '{$_POST['deliveryAddress']}', NULL)";
                $result = $conn->query($sql);
                $filename = $conn->insert_id;
                $target_file = $target_dir.$filename."_".$_FILES["fileToUpload"]["name"];
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                	header("Location: {$_SESSION['role']}.php ");
                   	$flag = 0;
                } else {
                	$flag = 2;
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        return $flag;
	}

	function updateUser(){															//Update User function
		$conn = connectDB();                                                        //Connect to database function
        $sql = "UPDATE users SET name = '{$_POST['name']}', email = '{$_POST['email']}', contactNo = '{$_POST['contactNo']}', address = '{$_POST['address']}' WHERE userId='".$_POST['update']."'";
        $result = $conn->query($sql);
	}

	function addUser(){																//Add User function
		$conn = connectDB();                                                        //Connect to database function
		if($_POST['password'] === $_POST['confirmpass']){
	        $sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";
	        $result = $conn->query($sql);
	        if($result->num_rows == 0){
	            $pass = hash("sha512", $_POST['password']);
	            $sql = "INSERT INTO users VALUES (23333,'".$_POST['name']."', '".$_POST['email']."', '".$pass."', '".$_POST['contactNo']."', '".$_POST['address']."', NULL, NULL)";
	            if ($conn->query($sql) === TRUE) {
	                $flag = 0;														//Successfully Registered
	            } else {
	                $flag = 3;														//ERROR: Connection error
	                //echo "Error: " . $sql . "<br>" . $conn->error;
	            }
	        }else{
	            $flag = 2;															//ERROR: User Exist
	        }
	        $conn->close();
	    }else{																		//ERROR: Incorrect Password
	        $flag = 1;
	    }
	    return $flag;
	}

	function downloadFile(){														//Download File (No user check and filename has orderId)
		$conn = connectDB();                                                        //Connect to database function
		$sql = "SELECT * FROM printorders WHERE orderId = ".$_POST['download'];
	    $result = $conn->query($sql);
	    $row = $result->fetch_assoc();
		$file = './files/'.$row['userId'].'/'.$row['orderId'].'_'.$row['file'];
		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);
		    exit;
		}else{
			echo "<script>alert('File not found!');</script>";
		}
	}

	function downloadClientFile(){													//Downloads File function (Checks if file to download is client's order)
		$conn = connectDB();                                                        //Connect to database function
	    $sql = "SELECT * FROM printorders WHERE orderId = ".$_POST['download'];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($row['userId'] === $_SESSION['userId']){
            $file = './files/'.$row['userId'].'/'.$row['orderId'].'_'.$row['file'];
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.$row['file'].'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }else{
                echo "<script>alert('File not found!');</script>";
            }
        }else{
            header('Location: 403.php');
        }
	}


?>
