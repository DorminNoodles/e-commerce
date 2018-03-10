<?PHP

include 'delete_case.php';

function    search_mod($array1, $array2)
{
	foreach($array1 as $e)
	{
		if ($e['tag'] === $array2['tag'])
			return (TRUE);
	}
	return (FALSE);
}

if (file_exists('private/tags'))
{
	$content = file_get_contents('private/tags');
	$content = unserialize($content);
}

$ret = "";
if ($_POST['submit'] == 'add' && $_POST['tag'] != NULL && $_POST['tag'] != "" && $_POST['name'] != NULL && $_POST['name'] != "")
{
	$logs['tag'] = $_POST['tag'];
	$logs['name'] = $_POST['name'];
	if (file_exists('private/tags') == TRUE)
	{
		if (search_mod($content, $logs) == FALSE)
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
		file_put_contents('private/tags', $content);
		if ($ret == 'ok')
			echo 'Ajout reussi.';
		else
			echo 'Erreur lors de l\'ajout';
	}
	else
		echo 'Erreur lors de l\'ajout';
}

if ($_POST['submit'] === "del" && $_POST['tag'] != NULL && $_POST['tag'] != "")
{
	if (delete_case('private/tags', 'tag', $_POST['tag']) == TRUE)
		echo 'Suppression reussie';
	else
		echo 'Erreur lors de la suppression';
}

if ($_POST['submit'] == 'mod' && $_POST['oldtag'] != NULL && $_POST['oldtag'] != "" && (($_POST['newtag'] != NULL && $_POST['newtag'] != "") ||
	($_POST['name'] != NULL && $_POST['name'] != "")) && $content != NULL)
{
	$i = 0;
	while ($content[$i] != NULL && $content[$i]['tag'] != $_POST['oldtag'])
		$i++;
	if ($content[$i]['tag'] == $_POST['oldtag'])
	{
		if ($_POST['newtag'] != NULL && $_POST['newtag'] != "")
			$content[$i]['tag'] = $_POST['newtag'];
		if ($_POST['name'] != NULL && $_POST['name'] != "")
			$content[$i]['name'] = $_POST['name'];
		$content = serialize($content);
		file_put_contents('private/tags', $content);
		echo 'Modification reussie.';
	}
	else
		echo 'Error';
}

?>

<div class="manage_users_body">
<h1 class="title1">AJOUTER TAG :</h1>
	<form action='index.php?page=manage_tags' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Mot-cle :  </td>
				<td><input type='text' name='tag' value='' /></td>
			</tr>
			<tr>
				<td>Nom : </td>
				<td><input type='text' name='name' value='' /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type='submit' name='submit' value='add' /></td>
			</tr>
		</table>
	</form>
<h1 class="title1">SUPPRIMER TAG: </h1>
	<form action='index.php?page=manage_tags' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Mot-cle :  </td>
				<td><input list='browsers' type='text' name='tag' value='' /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type='submit' name='submit' value='del' /></td>
			</tr>
		</table>
	</form>
<h1 class="title1">MODIFIER TAGS: </h1>
	<form action='index.php?page=manage_tags' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Ancien mot-cle :  </td>
				<td><input type='text' list="browsers" name='oldtag'></td>
			</tr>
			<tr>
				<td>Nouveau mot-cle :</td>
				<td><input type='text' name='newtag' value='' /></td>
			</tr>
			<tr>
				<td>Nouveau nom :</td>
				<td><input type='text' name='name' value='' /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type='submit' name='submit' value='mod' /></td>
			</tr>
		</table>
	</form>

<!--
	<form action='manage_tags.php' method='POST'>
		MODIFIER TAGS : <br /><br />
		Ancien mot-cle :  <input type='text' list="browsers" name='oldtag'>
		Nouveau mot-cle :  <input type='text' name='newtag' value='' />
		Nouveau nom : <input type='text' name='name' value='' />
		<input type='submit' name='submit' value='mod' />
	<datalist id="browsers">
	</datalist>
	</form> -->
