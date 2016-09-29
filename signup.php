<?php
	session_start();
?>
<?php
	include 'connectdb.php';
	
	$usname=$_POST['Username'];
	$psd=$_POST['Password'];
	
	$res=mysqli_query($conn,"SELECT Username FROM users  WHERE Username='$usname'");
	
	if ( mysqli_num_rows($res)<1){
		 mysqli_query($conn,"INSERT INTO users (Username, Password) VALUES ('$usname','$psd')") or die(mysqli_error());
		 $_SESSION["Username"]=$usname;
	}
	else{
		header("Location: fileziller.php");
	}
	
	header("Location: fileziller.php");
	
?>
