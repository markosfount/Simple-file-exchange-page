<?php
	include 'connectdb.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Fileziller Beta 2.0</title>
		<link rel="stylesheet" type="text/css" href="./fileziller.css">
</head>

<body>

<div class='container'>
	<header>
		<h1>FileZiller 2.0 Beta</h1>
	</header>
	
	<div class='main'>
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
		<h3>Sign up to Fileziller for free or login if you already have an account!</h3>
			
			
		<form enctype="multipart/form-data" action='signup.php' method='post'>
			<input type='text' placeholder='Username' name='Username' class='tbox' />
			<input type='text' placeholder='Password' name='Password' class='tbox'/>
			<input type='submit' name='signup_button' value='Sign up' class='inform' />
			<input type='submit' name='login_button' value='Login' class='inform' />
			<?php
				if (isset($_GET['msg'])){
					$msg=$_GET['msg'];
					switch ($msg){
						case 1:
							echo '<p>Please enter a username of 8 characters or more.</p>';
							break;
						case 2:
							echo '<p>Please enter a password of 8 characters or more.</p>';
							break;
						case 3:
							echo '<p>The username you entered is taken. Please choose a different username</p>';
							break;
						case 4:
							echo '<p>Incorrect password. Please try again.</p>';
							break;
						case 5:
							echo '<p>The username you entered does not exist.</p>';
							break;
					}
				}
				?>
		</form>
		
		</div>
	<?php
		}
		?>
		
		<div id='logout'>
		<?php
			if (isset($_SESSION['Username'])){
				$usn=$_SESSION['Username'];
				echo "<p>Welcome, $usn!</p>";
				echo "<a href='logout.php'>Logout</a>";
			}
		?>
		</div>
	</div>
	<footer>
		<p>Copyright 2016 @subdime</p>
	</footer>
</div>
</body>

</html>
