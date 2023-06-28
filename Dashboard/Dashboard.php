<?php
    include '../Essential Kits/php/conn.php';
    include "../Essential Kits/php/session.php";
    check_session();
	if ($_SESSION['role'] == 'student') {
		if(isset($_GET['did']) and isset($_GET['dopt'])) {
			$did = $_GET['did'];
			$dopt = $_GET['dopt'];
			if($dopt == "del") {
				$conn -> query("DELETE FROM demand WHERE AccNo = '$did'");
				$conn -> query("UPDATE books SET Status = 'Available' WHERE AccNo = '$did'");
				header('location:Dashboard.php');
			}
			if($dopt == "borr") {
				$conn -> query("DELETE FROM demand WHERE AccNo = '$did'");
				$conn -> query("INSERT INTO borrowed (LibID, AccNo, `Group`) VALUES ('".$_SESSION['user']."', '$did', '".$_SESSION['group']."')");
				$conn -> query("UPDATE books SET Status = 'Borrowed' WHERE AccNo = '$did'");
				header('location:Dashboard.php');
			}
		}
		if(isset($_GET['bid']) and isset($_GET['bopt'])) {
			$bid = $_GET['bid'];
			$bopt = $_GET['bopt'];
			if($bopt == "ret") {
				$conn -> query("DELETE FROM borrowed WHERE AccNo = '$bid'");
				$conn -> query("UPDATE books SET Status = 'Available' WHERE AccNo = '$bid'");
				header('location:Dashboard.php');
			}
		}
	}
	elseif ($_SESSION['role'] == 'admin') {
		if(isset($_GET['did']) and isset($_GET['dopt'])) {
			$did = $_GET['did'];
			$dopt = $_GET['dopt'];
			if($dopt == "del") {
				$conn -> query("DELETE FROM demand WHERE AccNo = '$did'");
				$conn -> query("UPDATE books SET Status = 'Available' WHERE AccNo = '$did'");
				header('location:Dashboard.php');
			}
			if($dopt == "con") {
				$conn -> query("UPDATE demand SET Check_Status = 'Verified' WHERE AccNo = '$did'");
				header('location:Dashboard.php');
			}
		}
		if(isset($_GET['bid']) and isset($_GET['bopt'])) {
			$bid = $_GET['bid'];
			$bopt = $_GET['bopt'];
			if($bopt == "del") {
				$conn -> query("DELETE FROM borrowed WHERE AccNo = '$bid'");
				$conn -> query("UPDATE books SET Status = 'Available' WHERE AccNo = '$bid'");
				header('location:Dashboard.php');
			}
			if($bopt == "issue") {
				$conn -> query("UPDATE borrowed SET BorrDt = CURRENT_TIMESTAMP(), Check_Status = 'Borrowed' WHERE AccNo = '$bid'");
				header('location:Dashboard.php');
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../Essential Kits/php/Metadata.php'; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../Essential Kits/css/Navbar.css">
    <link rel="stylesheet" href="../Essential Kits/css/Search Results.css">
    <link rel="stylesheet" href="./Dashboard-style.css">
	
	<?php
		if ($_SESSION['role'] == 'student') {
			echo '<link rel="stylesheet" href="./Student-style.css">';
		}
		elseif ($_SESSION['role'] == 'admin') {
			echo '<link rel="stylesheet" href="./Admin-style.css">';
		}
	?>
    
	<link rel="stylesheet" href="../Essential Kits/css/Footer-style.css">
	<script src="../Essential Kits/js/Navbar.js" defer></script>
    <script src="Dashboard-script.js" defer></script>
	
	<?php
		if ($_SESSION['role'] == 'student') {
			echo '<script src="./Student-script.js" defer></script>';
		}
		elseif ($_SESSION['role'] == 'admin') {
			echo '<script src="./Admin-script.js" defer></script>
				  <script src="./Notification.js" defer></script>
				  <script src="./Notification Renderer.js" defer></script>';
		}
	?>

	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <title>Welcome back <?php echo $_SESSION['name']; ?></title>
</head>

<body>
    <?php
        include '../Essential Kits/php/Navbar.php';
    ?>
    <div class="sidebar">
        <header>
            <h3><span class="fa-solid fa-bars"></span><div class="sideopt-text">Dashboard</div></h3>
        </header>
		<div class="sidebar-contents">
			<ul class="sidebar-contentlist">
				<?php
					if ($_SESSION['role'] == 'student') {
				?>
				<li class="sideopt active">
					<a href="#home">
						<b></b><b></b>
						<span class="fa fa-home"></span>
						<div class="sideopt-text">Home</div>
					</a>
				</li>
				<li class="sideopt">
					<a href="#demanded-books">
						<b></b><b></b>
						<span class="fa fa-book"></span>
						<div class="sideopt-text">Demanded Books</div>
					</a>
				</li>
				<li class="sideopt">
					<a href="#borrowed-books">
						<b></b><b></b>
						<span class="fa fa-book"></span>
						<div class="sideopt-text">Borrowed Books</div>
					</a>
				</li>
				<?php
					}
					else {
				?>
				<li class="sideopt active">
					<a href="#home">
						<b></b><b></b>
						<span class="icon" style = "width: auto; padding-top: 3px;">
							<ion-icon name="home"></ion-icon>
						</span>
						<div class="sideopt-text">Home</div>
					</a>
				</li>
				<li class="sideopt">
					<a href="#request">
						<b></b><b></b>
						<span class="icon" style = "width: auto; padding-top: 3px;">
							<ion-icon name="arrow-undo"></ion-icon>
						</span>
						<div class="sideopt-text">Requests</div>
					</a>
				</li>
				<li class="sideopt">
					<a href="#notification">
						<b></b><b></b>
						<span class="icon" style = "width: auto; padding-top: 3px;">
							<ion-icon name="notifications"></ion-icon>
						</span>
						<div class="sideopt-text">Notification</div>
					</a>
				</li>
				<li class="sideopt">
					<a href="#account-management">
						<b></b><b></b>
						<span class="icon" style = "width: auto; padding-top: 3px;"><ion-icon name="people"></ion-icon></span><div class="sideopt-text">Accounts</div></a></li>
				<?php
					}
				?>
			</ul>
		</div>
    </div>
    <div id="main-content">
        <div class="main-content">
            <?php
				if ($_SESSION['role'] == 'student') {
					include './Student-dashboard.php';
				}
				elseif ($_SESSION['role'] == 'admin') {
					include './Admin-dashboard.php';	
				}
			?>
        </div>
    </div>
    <?php include "../Essential Kits/php/Footer.php"; ?>
	<?php //include "../Essential Kits/php/Session-unloader.php"; ?>
</body>

</html>
<?php mysqli_close($conn); ?>