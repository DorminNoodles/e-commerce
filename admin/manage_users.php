<?PHP

include 'delete_case.php';

function    create_search($array1, $array2)
{
	foreach($array1 as $e)
	{
		if ($e['login'] === $array2['login'])
			return (TRUE);
	}
	return (FALSE);
}

if ($_POST['submit'] == 'add')
{
	if ($_POST["login"] != NULL && $_POST["login"] != "" && $_POST["passwd"] != NULL && $_POST["passwd"] != "" && $_POST["f_name"] != NULL && $_POST["f_name"] != "" &&
		$_POST["l_name"] != NULL && $_POST["l_name"] != "" && $_POST["address"] != NULL && $_POST["address"] != "" &&
		$_POST["pc"] != NULL && $_POST["pc"] != "" && $_POST["city"] != NULL && $_POST["city"] != "" && $_POST["rank"] != NULL && $_POST["rank"] != "")
	{
		$ret = "";
		$logs["login"] = $_POST["login"];
		$logs["f_name"] = $_POST["f_name"];
		$logs["l_name"] = $_POST["l_name"];
		$logs["address"] = $_POST["address"];
		$logs["pc"] = $_POST["pc"];
		$logs["city"] = $_POST["city"];
		$logs["rank"] = $_POST["rank"];;
		$logs["passwd"] = hash("whirlpool", $_POST["passwd"]);
		if (file_exists('private/account') == TRUE)
		{
			$content = file_get_contents("private/account");
			$content = unserialize($content);
			if (create_search($content, $logs) == FALSE)
			{
				$ret = "ok";
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
				echo "Identifiant cree.";
			else
				echo 'Erreur lors de la creation : l\'identifiant existe deja.';
		}
		else
			echo 'Erreur lors de la creation : l\'identifiant existe deja.';
	}
	else
		echo 'Erreur lors de la creation : l\'un des champs est vide ou mal rempli.';
}

if ($_POST['submit'] == 'del')
{
	if ($_POST['login'] != NULL && $_POST['login'] != '')
	{
		if (delete_case('private/account', 'login', $_POST['login']) == TRUE)
			echo 'Utilisateur supprime';
		else
			echo 'Erreur de suppression';
	}
	else
		echo 'Erreur de suppression : la case login est vide.';
}

if ($_POST['submit'] == 'mod')
{
	if ($_POST["login"] != NULL && $_POST["login"] != "" && (($_POST["passwd"] != NULL && $_POST["passwd"] != "") &&
		($_POST["f_name"] != NULL && $_POST["f_name"] != "") || ($_POST["l_name"] != NULL && $_POST["l_name"] != "") || ($_POST["address"] != NULL && $_POST["address"] != "") ||
		($_POST["pc"] != NULL && $_POST["pc"] != "") || ($_POST["city"] != NULL && $_POST["city"] != "") ||
		($_POST["rank"] != NULL && $_POST["rank"] != "")))
	{
		if (file_exists('private/account') == TRUE)
		{
			$content = file_get_contents("private/account");
			$content = unserialize($content);
			$i = 0;
			while ($content[$i] != NULL && $content[$i]['login'] != $_POST['login'])
				$i++;
			if ($content[$i]['login'] == $_POST['login'])
			{
				if ($_POST['passwd'] != NULL && $_POST['passwd'] != "")
					$content[$i]['passwd'] = hash("whirlpool", $_POST["passwd"]);
				if ($_POST['f_name'] != NULL && $_POST['f_name'] != "")
					$content[$i]['f_name'] = $_POST['f_name'];
				if ($_POST['l_name'] != NULL && $_POST['l_name'] != "")
					$content[$i]['l_name'] = $_POST['l_name'];
				if ($_POST['address'] != NULL && $_POST['address'] != "")
					$content[$i]['address'] = $_POST['address'];
				if ($_POST['pc'] != NULL && $_POST['pc'] != "")
					$content[$i]['pc'] = $_POST['pc'];
				if ($_POST['city'] != NULL && $_POST['city'] != "")
					$content[$i]['city'] = $_POST['city'];
				if ($_POST['rank'] != NULL && $_POST['rank'] != "")
					$content[$i]['rank'] = $_POST['rank'];
				$content = serialize($content);
				file_put_contents('private/account', $content);
				echo 'Modification reussie.';
			}
			else
				echo 'Modification erronee. L\'identifiant n\'existe pas';
		}
		else
			echo 'Modification erronee. Le registre n\'existe pas';
	}
	else
		echo 'Modification erronee : le formulaire n\'est pas rempli correctement (login + autre categorie).';
}

if ($_SESSION['logged_on_user'] === FALSE || $_SESSION['rank'] !== "admin")
{
	echo "<div class=\"error\">ERROR BAD ACCESS</div>\n";
	return;
}
?>

<div class="manage_users_body">
	<h1 class="title1">AJOUTER UN UTILISATEUR :</h1>
	<form action='index.php?page=manage_users' method='POST'>
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
				<td><input type="text" name="address" value="" size="80"/></td>
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
				<td>Droits: </td>
				<td><input type="text" name="rank" value="" size="80"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type="submit" name="submit" value="add" /></td>
			</tr>
		</table>
	</form>
	<h1 class="title1">MODIFIER UN UTILISATEUR :</h1>
	<form action='index.php?page=manage_users' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Identifiant: </td>
				<td><input type="text" name="login" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Mot de passe: </td>
				<td><input type="text" name="passwd" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Prenom: </td>
				<td><input type="text" name="f_name" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Nom: </td>
				<td><input type="text" name="l_name" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Adresse: </td>
				<td><input type="text" name="address" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Code Postal: </td>
				<td><input type="text" name="pc" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Ville: </td>
				<td><input type="text" name="city" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Droits: </td>
				<td><input type="text" name="rank" value="" size="80" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type="submit" name="submit" value="mod" /></td>
			</tr>
		</table>
	</form>
	<h1 class="title1">SUPPRIMER UN UTILISATEUR :</h1>
	<form action='index.php?page=manage_users' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Identifiant: </td>
				<td><input type="text" name="login" value="" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form"type="submit" name="submit" value="del" /></td>
			</tr>
		</table>
	</form>
</div>
