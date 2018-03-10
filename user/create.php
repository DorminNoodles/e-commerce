<?PHP

function    create_search($array1, $array2)
{
	foreach($array1 as $e)
	{
		if ($e['login'] === $array2['login'])
			return (TRUE);
	}
	return (FALSE);
}

$_POST["login"] = strip_tags($_POST["login"]);
$_POST["passwd"] = strip_tags($_POST["passwd"]);
$_POST["submit"] = strip_tags($_POST["submit"]);
$_POST["f_name"] = strip_tags($_POST["f_name"]);
$_POST["l_name"] = strip_tags($_POST["l_name"]);
$_POST["address"] = strip_tags($_POST["address"]);
$_POST["pc"] = strip_tags($_POST["pc"]);
$_POST["city"] = strip_tags($_POST["city"]);

if ($_POST['submit'] == 'OK')
{
	if ($_POST["login"] != NULL && $_POST["login"] != "" && $_POST["passwd"] != NULL && $_POST["passwd"] != "" &&
		$_POST["f_name"] != NULL && $_POST["f_name"] != "" && $_POST["l_name"] != NULL && $_POST["l_name"] != "" &&
		$_POST["address"] != NULL && $_POST["address"] != "" && $_POST["pc"] != NULL && $_POST["pc"] != "" &&
		$_POST["city"] != NULL && $_POST["city"] != "")
	{
		$ret = '';
		$logs["login"] = $_POST["login"];
		$logs["f_name"] = $_POST["f_name"];
		$logs["l_name"] = $_POST["l_name"];
		$logs["address"] = $_POST["address"];
		$logs["pc"] = $_POST["pc"];
		$logs["city"] = $_POST["city"];
		$logs["rank"] = "basic";
		$logs["passwd"] = hash("whirlpool", $_POST["passwd"]);
		if (file_exists('private/account') == TRUE)
		{
			$content = file_get_contents("private/account");
			$content = unserialize($content);
			if (create_search($content, $logs) == FALSE)
			{
				$ret = 'ok';
				$content[] = $logs;
			}
			$final = $content;
		}
		else
		{
			$ret = 'ok';
			$final[0] = $logs;
		}
		if ($final != NULL)
		{
			$content = serialize($final);
			if (file_exists('private/') == FALSE)
				mkdir('private/');
			file_put_contents("private/account", $content);
			if ($ret == 'ok')
				echo "Inscription completee. Veuillez vous connecter s'il-vous-plait.";
			else
				echo 'Erreur : l\'identifiant existe deja.';
		}
	}
	else
		echo 'Erreur : le formulaire n\'est pas entierement complete.';
}

?>
<div class="create_body">
	<h1 class=title1>Cr&eacute;er votre compte</h1>
	<form class="text_form" action='index.php?page=create' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Identifiant: </td>
				<td><input type="text" name="login" value="" size="80"/></td>
			</tr>
			<tr>
				<td>Mot de passe: </td>
				<td><input type="password" name="passwd" value="" size="80"/></td>
			</tr>
			<tr>
				<td>Prenom: </td>
				<td><input type="text" name="f_name" value="" size="80"/></td>
			</tr>
			<tr>
				<td>Nom: </td>
				<td><input type="text" name="l_name" value="" size="80"/></td>
			</tr>
			<tr>
				<td>Adresse: </td>
				<td><textarea rows="4" cols="105" name="address" value="" size="80"/></textarea></td>
			</tr>
			<tr>
				<td>Code Postal: </td>
				<td><input type="text" name="pc" value="" size="80"/></td>
			</tr>
			<tr>
				<td>Ville: </td>
				<td><input type="text" name="city" value="" size="80"/></td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<input class="btn_form" type="submit" name="submit" value="OK" />
	</form>
</div>
