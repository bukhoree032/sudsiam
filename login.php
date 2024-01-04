<?php
session_start();
?>
<!doctype html>
<html lang="th">
<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<link rel="stylesheet" href="include/logAreg.css">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body class="bodylogAreg" style="background-color: #333;">

	<div class="container">
		<a href="index.php"><i class='bx bx-left-arrow-alt'></i></a>
		<h2>เข้าสู่ระบบ</h2>
		<div class="box">
			<form action="login_save.php" method="post">
				<?php if (isset($_SESSION['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?php
						echo $_SESSION['error'];
						unset($_SESSION['error']);
						?>
					</div>
				<?php } ?>

				<?php if (isset($_SESSION['close'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?php
						echo $_SESSION['close'];
						unset($_SESSION['close']);
						?>
					</div>
				<?php } ?>

				<?php if (isset($_SESSION['success'])) { ?>
					<div class="alert alert-success" role="alert">
						<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
						?>
					</div>
				<?php } ?><br>
				<div class="group">
					<input type="text" name="email">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Email</label>
				</div>

				<div class="group">
					<input type="password" name="password">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Password</label>
				</div>
				<div class="btn-submit">
					<input class="btn" type="submit" value="ล็อกอิน" name="login">
				</div>
			</form>
		</div><br>

	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>