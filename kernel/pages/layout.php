<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= APP_NAME . ' - ' . $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="/twbootstrap/bootstrap.css">
	<link rel="stylesheet" href="/kissfile.css">
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
</head>
<body id="kissfile">
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/"><?= APP_NAME ?></a>
				<div class="nav-collapse">
				<?php
				if ( User::is_logged( ) ) {
				?>
					<ul class="nav pull-right">
						<li class="dropdown">
							<li><a href="/?logout">Se déconnecter</a></li>
						</li>
					</ul>
				<?php
				}
				?>

				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container">
		<?php
		foreach( \Notification::pull(  ) as $notification ) {
		?>
			<div class="alert alert-<?= $notification->level ?>">
				<?= $notification ?>
			</div>
		<?php
		}
		echo $content;
		?>
	</div>

	<script src="/twbootstrap/jquery.js"></script>
	<script src="/twbootstrap/bootstrap-dropdown.js"></script>
</body>
</html>
