<?PHP

if (file_exists('private/') == FALSE)
{
	$oldtime = time() + 3;
	echo 'Erreur : Veuillez executer install.php';
	while (time() < $oldtime)
		;
	return;
}

session_start();

if ($_SESSION['cart'] === NULL)
	$_SESSION['cart'] = array();
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/nav_bar.css">
		<link rel="stylesheet" type="text/css" href="css/content.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
	</head>
	<body>
		<?php include 'nav_bar.php' ?>
		<?php
			if ($_GET['page'] === 'create')
				include 'user/create.php';
			else if ($_GET['page'] === 'modif')
				include 'user/modif.html';
			else if ($_GET['page'] === 'settings')
				include 'user/settings.php';
			else if ($_GET['page'] === 'cat')
				include 'cat.php';
			else if($_GET['page'] === 'item')
				include 'items.php';
			else if($_GET['page'] === 'cart')
				include 'user/cart.php';
			else if($_GET['page'] === 'manage_items')
				include 'admin/manage_items.php';
			else if($_GET['page'] === 'manage_tags')
				include 'admin/manage_tags.php';
			else if($_GET['page'] === 'manage_users')
				include 'admin/manage_users.php';
			else if($_GET['page'] === 'outgoing')
				include 'admin/outgoing.php';
			else if($_GET['page'] === 'manage_tags')
				include 'admin/manage_tags.php';
			else
				include 'cat.php';
		?>
		<?php include 'content.php' ?>
		<?php include 'footer.php' ?>
	</body>
</html>
