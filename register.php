<?php
session_start();
?>
<!doctype html>
<html lang="th">
<?php include('include/connect.php'); ?>
<?php include('include/headindex.php'); ?>
<link rel="stylesheet" href="include/logAreg.css">
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

<body class="bodylogAreg1" style="background-color: #333;">

	<div class="container">
		<a href="index.php"><i class='bx bx-left-arrow-alt'></i></a>
		<h2>สมัครสมาชิก</h2>
		<div class="box">

			<form action="register_save.php" method="POST">
			<?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
			<br>
				<div class="group">
					<input type="text" name="firstname"  >
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>First name</label>
				</div>

				<div class="group">
					<input type="text"  name="lastname">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Last name</label>
				</div>

				<div class="group">
					<input type="text"  name="email">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Email</label>
				</div>

				<div class="group">
					<input type="password"  name="password">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Password</label>
				</div>

				<div class="group">
					<input type="password"  name="c_password">
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>Confirm password</label>
				</div>
				<div class="btn-submit">
					<input class="btn" type="submit" value="สมัครสมาชิก" name="signup">
				</div>
			</form>
		</div><br>
		
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    </script>

</body>

</html>