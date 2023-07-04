<?php
	include '../Essential Kits/php/conn.php';
	include "../Essential Kits/php/session.php";
	if(isset($_POST['signin-btn'])) {
		$role;
		$incorrect;
		if (isset($_POST['role'])) {
			if($_POST['role'] == 'admin') {
				$role = "admin";
			}
			elseif ($_POST['role'] == 'student') {
				$role = "student";
			}
			$name = $_POST['username'];
			$password = $_POST['pass'];
			$password = md5($password);
			$q;
			if($role == "student") {		//For Student
				$q="select * from students where Card_No='$name' and Password='$password'";
			}
			else {		//For Admin
				$q="select * from admin where Username='$name' and Password='$password'";
			}
			$query=$conn -> query($q);
			if(mysqli_num_rows($query) > 0) {
				$ret=mysqli_fetch_assoc($query);
				st_start($ret, $role);
			}
			else {
				$incorrect = "Incorrect";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
		<link rel="icon" type="image/x-icon" href="../Essential Kits/pic/LOGO.png">
		<link rel="stylesheet" href="signin-style.css" type="text/css">
		<script src="signin-script.js" defer></script>
		<title>Sign In to continue</title>
	</head>
	<body>
		<div class="main-box">
			<h2 class="signin">Sign In</h2>
			<h4 class="text">To your existing account to access Library</h4>
			<form action="signin.php" class="form-page" method="post">
				<div class="form-page-children select">
					<select name="role" id="role-select" required>
						<option value="" selected>----Select Role----</option>
						<option value="student">I am a student</option>
						<option value="admin">I am an admin</option>
					</select>
				</div>
				<div class="form-page-children input">
					<div id="first-box" class="textbox">
						<label for="user"><span class="fa-solid fa-user"></span></label>
						<input type="text" name="username" id="user" class="inp" placeholder="Username" value="" autocomplete="off" required>
					</div>
				</div>
				<div class="form-page-children input">
					<div id = "second-box" class="textbox">
						<label for="pass"><span class="fa-solid fa-key"></span></label>
						<input type="password" name="pass" id="pass" class="inp" placeholder="Password" value="" autocomplete="off" required>
					</div>
				</div>
				<?php
					if (isset($incorrect)) {
				?>
				<div id = "incorrect-id-pass">
					Incorrect Username or Password. Try again...
				</div>
				<?php
					}				
				?>
				<div class="form-page-children submit">
					<button type="submit" name="signin-btn" value="Sign In">
						<span class="fa fa-sign-in" style="margin-right: 8px;"></span>Sign In
					</button>
				</div>
			</form>
			<h4 class="atext"><a class="forgot" href="">Forgot password?</a></h4>
			<h4 class="atext"><a class="signup" href="signup.html">Don't have an account? Sign Up right now</a></h4>
		</div>
	</body>
</html>
<?php mysqli_close($conn); ?>