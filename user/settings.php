<?PHP

session_start();

$_POST['oldpw'] = strip_tags($_POST['oldpw']);
$_POST['newpw'] = strip_tags($_POST['newpw']);
$_POST['submit'] = strip_tags($_POST['submit']);
$_POST['f_name'] = strip_tags($_POST['f_name']);
$_POST['l_name'] = strip_tags($_POST['l_name']);
$_POST['address'] = strip_tags($_POST['address']);
$_POST['pc'] = strip_tags($_POST['pc']);
$_POST['city'] = strip_tags($_POST['city']);

if ($_POST['oldpw'] != NULL && $_POST['oldpw'] != "" && $_POST['newpw'] != NULL && $_POST['newpw'] != "")
{
	$oldpw = hash("whirlpool", $_POST["oldpw"]);
	$newpw = hash("whirlpool", $_POST["newpw"]);
}

if ($_POST["submit"] == "OK" && (($_POST["f_name"] != NULL && $_POST["f_name"] != "") || ($_POST["l_name"] != NULL && $_POST["l_name"] != "") ||
	($oldpw != NULL && $oldpw != "" && $newpw != NULL && $newpw != "" && look_after('private/account', 'passwd', 'login', $_SESSION['logged_on_user']) == $oldpw) ||
	($_POST["address"] != NULL && $_POST["address"] != "") || ($_POST["pc"] != NULL && $_POST["pc"] != "") ||
	($_POST["city"] != NULL && $_POST["city"] != "")) && file_exists('private/account') == TRUE)
{
	$content = file_get_contents("private/account");
	$content = unserialize($content);
	$i = 0;
	while ($content[$i] != NULL && $content[$i]['login'] != $_SESSION["logged_on_user"])
		$i++;
	if ($content[$i]['login'] == $_SESSION["logged_on_user"])
	{
		if ($_POST['oldpw'] != NULL && $_POST['oldpw'] != "" && $_POST['newpw'] != NULL && $_POST['newpw'] != "" &&
			look_after('private/account', 'passwd', 'login', $_SESSION['logged_on_user']) == $oldpw)
			$content[$i]['passwd'] = $newpw;
		if ($_POST["f_name"] != NULL && $_POST["f_name"] != "")
			$content[$i]['f_name'] = $_POST['f_name'];
		if ($_POST["l_name"] != NULL && $_POST["l_name"] != "")
			$content[$i]['l_name'] = $_POST['l_name'];
		if ($_POST["address"] != NULL && $_POST["address"] != "")
			$content[$i]['address'] = $_POST['address'];
		if ($_POST["pc"] != NULL && $_POST["pc"] != "")
			$content[$i]['pc'] = $_POST['pc'];
		if ($_POST["city"] != NULL && $_POST["city"] != "")
			$content[$i]['city'] = $_POST['city'];
		$content = serialize($content);
		file_put_contents("private/account", $content);
		echo 'Modification validee';
	}
	else
		echo 'Modification erronee';
}

	$old_f_name = look_after('private/account', 'f_name', 'login', $_SESSION['logged_on_user']);
	$old_l_name = look_after('private/account', 'l_name', 'login', $_SESSION['logged_on_user']);
	$old_address = look_after('private/account', 'address', 'login', $_SESSION['logged_on_user']);
	$old_pc = look_after('private/account', 'pc', 'login', $_SESSION['logged_on_user']);
	$old_city = look_after('private/account', 'city', 'login', $_SESSION['logged_on_user']);

?>

<div class="settings_body">
	<h1 class=title1>Panneau de configuration</h1>
	<form action='index.php?page=settings' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Prenom: </td>
				<td><input type="text" name="f_name" value="<?php echo $old_f_name; ?>" size="80"/></td>
			</tr>
			<tr>
				<td>Nom: </td>
				<td><input type="text" name="l_name" value="<?php echo $old_l_name; ?>" size="80"/></td>
			</tr>
			<tr>
				<td>Adresse: </td>
				<td><textarea rows="4" cols="119" name="address" size="80"/><?php echo $old_address; ?></textarea></td>
			</tr>
			<tr>
				<td>Code Postal: </td>
				<td><input type="text" name="cp" value="<?php echo $old_pc; ?>" size="80"/></td>
			</tr>
			<tr>
				<td>Ville: </td>
				<td><input type="text" name="city" value="<?php echo $old_city; ?>" size="80"/></td>
			</tr>
			<tr>
				<td>Ancien mot de passe: </td>
				<td><input type="password" name="oldpw" value="" size="80"/></td>
			</tr>
			<tr>
				<td>Nouveau mot de passe: </td>
				<td><input type="password" name="newpw" value="" size="80"/></td>
			</tr>
				<td>
				</td>
				<td>
					<input class="btn_form" type="submit" name="submit" value="OK" />
				</td>
		</table>
	</form>
</div>
