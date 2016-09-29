<?php
	include 'connectdb.php';
	
	$usname=$_POST['Username'];
	$psd=$_POST['Password'];
	
	$res=mysqli_query($conn,"SELECT Username,Password FROM users  WHERE Username='$usname'");
	//if username exists
	if ( mysqli_num_rows($res)>0){
		$row=mysqli_fetch_array($res,MYSQLI_ASSOC);

		if ($row['Password']==$psd){
			$_SESSION["Username"]=$usname;
			header("Location: fileziller.php");
		 }
		 else{
			 header('Location:fileziller.php?error=yes');
		 }
	}
	else{
		//header("Location: signupagain.php");
		header('Location:fileziller.php?error=yes');
		//echo 'no user with this username';
	}
	
?>
