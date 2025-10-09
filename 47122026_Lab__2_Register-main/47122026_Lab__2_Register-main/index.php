<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= isset($_SESSION['user_id']) ? 'Dashboard' : 'Home' ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.menu-tray {
			position: fixed;
			top: 16px;
			right: 16px;
			background: rgba(255,255,255,0.95);
			border: 1px solid #e6e6e6;
			border-radius: 8px;
			padding: 6px 10px;
			box-shadow: 0 4px 10px rgba(0,0,0,0.06);
			z-index: 1000;
		}
		.menu-tray a { margin-left: 8px; }
		.btn-custom {
			background-color: #D19C97;
			border-color: #D19C97;
			color: #fff;
		}
		.btn-custom:hover {
			background-color: #b77a7a;
			border-color: #b77a7a;
		}
		.card {
			border: none;
			border-radius: 15px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body>

	<?php if (isset($_SESSION['user_id'])): ?>
		<!-- Logged in user menu -->
		<div class="menu-tray">
			<span class="me-2">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
			<a href="login/logout.php" class="btn btn-sm btn-custom">Logout</a>
		</div>

		<div class="container" style="padding-top:120px;">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header text-center">
							<h4>Your Dashboard</h4>
						</div>
						<div class="card-body text-center">
							<h5>Hello, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h5>
							<p class="text-muted">You are logged in successfully.</p>
							<p><strong>User ID:</strong> <?= $_SESSION['user_id'] ?></p>
							<p><strong>Role:</strong> <?= $_SESSION['user_role'] == 1 ? 'Customer' : 'Restaurant Owner' ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<!-- Guest user menu -->
		<div class="menu-tray">
			<span class="me-2">Menu:</span>
			<a href="login/register.php" class="btn btn-sm btn-outline-primary">Register</a>
			<a href="login/login.php" class="btn btn-sm btn-outline-secondary">Login</a>
		</div>

		<div class="container" style="padding-top:120px;">
			<div class="text-center">
				<h1>Welcome</h1>
				<p class="text-muted">Use the menu in the top-right to Register or Login.</p>
			</div>
		</div>
	<?php endif; ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
