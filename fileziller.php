<?php
	include 'connectdb.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Fileziller Beta 2.0</title>
		<link rel="stylesheet" type="text/css" href="./fileziller.css">
</head>

<body>
	<h1>FileZiller 2.0 Beta</h1>
	
	<div id='filelist'>
		<?php
			if (isset($_SESSION['Username'])){
				$file=true;
				$dir=opendir('C:\Users\Markos\OneDrive\Web Seminar\xampp2\htdocs\fileziller\filesEx4 '); //C:\Program Files\xampp\htdocs
				while ($file==true)
				{
					$file=readdir($dir);
					if ("$file"!='.' && "$file"!='..' && "$file"!=NULL){
						$row=mysqli_fetch_array(mysqli_query($conn,"SELECT Username FROM Filedata WHERE Name='$file'"),MYSQLI_ASSOC);
						$user=$row['Username'];
						echo "<p><a class='files' href='download.php?file=C:\\Users\\Markos\\OneDrive\\Web Seminar\\xampp2\\htdocs\\fileziller\\filesEx4\\$file'>$file\n  </a> $user</p>";
					}
				}
				closedir($dir);
				}
			else
				echo "Login or Sign up to see available files"
		?>
	</div> 
	
	<div id='logout'>
		<?php
			if (isset($_SESSION['Username']))
				echo "<a href='logout.php'>Logout</a>";
		?>
	</div>
	
	<?php
		if (isset($_SESSION['Username'])){ ?>
			
		<div id='form'>
		<form enctype="multipart/form-data" action='upload.php' method='post'>
			<input type='text' value='Name' name='Givename' class='inform'/>
			<select class='inform'>
				<option selected='selected'>Music</option>
				<option>Text</option>
				<option>Image</option>
				<option>Other</option>
			</select>
			<input type='file' name='Filename' class='inform'/>
			<input type='submit' name='submit button' value='Upload' class='inform' />
		</form>	
		
		</div>
	<?php	}
		else{ ?>
			 
		<div id='form'>
		<h3>Sign up to Fileziller for free!</h3>
			
			
		<form enctype="multipart/form-data" action='signup.php' method='post'>
			<input type='text' value='Username' name='Username' class='inform'/>
			<input type='text' value='Password' name='Password' class='inform'/>
			<input type='submit' name='Signup button' value='Sign up' class='inform' />
		</form>
		
		<h3>Login if you already have an account</h3>
		
		<form enctype="multipart/form-data" action='login.php' method='post'>
			<input type='text' value='Username' name='Username' class='inform'/>
			<input type='text' value='Password' name='Password' class='inform'/>
			<input type='submit' name='Login button' value='Login' class='inform' />
			<?php
			if (isset($_GET['error']))
				echo 'Invalid username or password. Please try again.';
			?>
		</form>
		</div>
	<?php
		}
	
		?>
	
</body>


</html>