<?php
	include 'connectdb.php';
	
	$usname=$_POST['Username'];
	$psd=$_POST['Password'];
	
	if (isset($_POST['signup_button'])){
		if (strlen($usname)<3){ 
			header('Location: fileziller.php?msg=1');
			exit;
		}
		else if (strlen($psd)<3){
			header('Location: fileziller.php?msg=2');
			exit;
		}
		$res=mysqli_query($conn,"SELECT Username FROM users  WHERE Username='$usname'");
		
		if ( mysqli_num_rows($res)<1){
			mysqli_query($conn,"INSERT INTO users (Username, Password) VALUES ('$usname','$psd')") or die(mysqli_error());
			$_SESSION["Username"]=$usname;
		}
		else{
			header("Location: fileziller.php?msg=3");
			exit;
		}
	
		header("Location: fileziller.php");
	}
	else if (isset($_POST['login_button'])){
		$res=mysqli_query($conn,"SELECT Username,Password FROM users  WHERE Username='$usname'");
		//if username exists
		if ( mysqli_num_rows($res)>0){
			$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
			//if psd is correct
			if ($row['Password']==$psd){
				$_SESSION["Username"]=$usname;
				header("Location: fileziller.php");
				exit;
			}
			else{
				header('Location:fileziller.php?msg=4');
				exit;
			}
		}
		else{
			header('Location:fileziller.php?msg=5');
			// no user with this username;
		}
	}
	else
		header('Location:fileziller.php?msg=6')
?>
