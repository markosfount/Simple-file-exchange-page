<?php
	include 'connectdb.php';
	
	$destination='C:\Users\Markos\OneDrive\Web Seminar\xampp2\htdocs\fileziller\filesEx4\\';
	if (!empty($_FILES))
	{	if($_FILES['Filename']['size'] < 5000000){	
			$destination .=$_FILES['Filename']['name'];
			//echo $destination;
			$tempname=$_FILES['Filename']['tmp_name'];
			//echo $tempname;
			move_uploaded_file($tempname,$destination);
			$flname=$_FILES['Filename']['name'];
			$fltype=$_FILES['Filename']['type'];
			$SesUsname=$_SESSION['Username'];
			
			if (mysqli_num_rows(mysqli_query($conn,"SELECT Name FROM Filedata WHERE Name='$flname'"))<1){
				mysqli_query($conn,"INSERT INTO Filedata (Name, Type, Username) VALUES ('$flname','$fltype', '$SesUsname')") or die(mysqli_error());
			}
			//echo $_SESSION["Username"];
			$_FILES=null;
			}
		else{ //javascript file is too large
			
		}
			
		header("Location: fileziller.php");
	}
	
?>