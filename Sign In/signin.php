<?php
	include '../Essential Kits/php/conn.php';
	include "../Essential Kits/php/session.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '../Essential Kits/php/Metadata.php'; ?>
		<link rel="stylesheet" href="signin-style.css" type="text/css">
		<script src="signin-script.js" defer></script>
		<title>Sign In to continue</title>
	</head>
	<body>
		<div class="main-box">
		<?php
				if(isset($_POST['signin-btn'])) {
					$role;
					$incorrect;
					// First you need to assure that if the select field was selected and assigned a value
					// if(isset()) {
						if($_POST['signin-btn'] == 'Sign In As Administrator') {
							$role = "admin";
						}
						else {
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
						// } else {} Error detecting that you haven't selected a field
				}
			?>
			<h2 class="signin">Sign In</h2>
			<h4 class="text">To your existing account to access Library</h4>
			<form action="signin.php" class="form-page" method="post">
				<!-- A select field will be made to select between admin and student -->
				<div class="form-page-children">
					<div id="first-box" class="textbox">
						<label for="user"><span class="fa-solid fa-user"></span></label>
						<input type="text" name="username" id="user" class="inp" placeholder="Username" value="" autocomplete="off" required>
					</div>
				</div>
				<div class="form-page-children">
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
				<div class="form-page-children">
					<input type="submit" name="signin-btn" value="Sign In As Student">
				</div>
				<div class="form-page-children">
					<input type="submit" name="signin-btn" value="Sign In As Administrator">
				</div>
			</form>
			<h4 class="atext"><a class="forgot" href="">Forgot password?</a></h4>
			<h4 class="atext"><a class="signup" href="signup.html">Don't have an account? Sign Up right now</a></h4>
		</div>
	</body>
</html>
<?php mysqli_close($conn); ?>