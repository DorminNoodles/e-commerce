<?PHP

include 'delete_case.php';

function    search_items($array1, $array2)
{
    foreach($array1 as $e)
    {
        if ($e['product'] === $array2['product'])
            return (TRUE);
    }
    return (FALSE);
}

if ($_SESSION['rank'] !== 'admin')
	return;

if ($_POST["submit"] == "add")
{
	if ($_POST["product"] != NULL && $_POST["product"] != "" && $_POST["type1"] != NULL && $_POST["type1"] != "" &&
		$_POST["picture"] != NULL && $_POST["picture"] != "" && $_POST["carac"] != NULL && $_POST["carac"] != "" && $_POST["mark"] != NULL && $_POST["mark"] != "" &&
		$_POST["price"] != NULL && $_POST["price"] != "" && $_POST["rank"] != NULL && $_POST["rank"] != "")
	{
		$ret = "";
		$logs["product"] = $_POST["product"];
		$logs["type1"] = $_POST["type1"];
		if ($_POST["type2"] != NULL && $_POST["type2"] != "")
			$logs["type2"] = $_POST["type2"];
		if ($_POST["type3"] != NULL && $_POST["type3"] != "")
			$logs["type3"] = $_POST["type3"];
		$logs["picture"] = $_POST["picture"];
		$logs["carac"] = $_POST["carac"];
		$logs["mark"] = $_POST["mark"];
		$logs["price"] = $_POST["price"];
		$logs["rank"] = $_POST["rank"];
		if (file_exists('private/shop') == TRUE)
		{
			$content = file_get_contents("private/shop");
			$content = unserialize($content);
			if (search_items($content, $logs) == FALSE)
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
			file_put_contents("private/shop", $content);
			if ($ret == 'ok')
				echo 'Ajout realise';
			else
				echo 'Erreur lors de l\'ajout';
		}
		else
			echo 'Erreur lors de l\'ajout';
	}
	else
		echo "Erreur : Pour cause de formulaire non rempli\n";
}


if ($_POST['product'] != NULL && $_POST['product'] != '' && $_POST['submit'] == 'del')
{
	if (delete_case('private/shop', 'product', $_POST['product'] == TRUE))
		echo 'Produit supprime';
	else
		echo 'Erreur de suppression';
}

if ($_POST['submit'] == 'mod' && $_POST["product"] != NULL && $_POST["product"] != "" && (($_POST["type1"] != NULL && $_POST["type1"] != "") &&
	($_POST["type2"] != NULL && $_POST["type2"] != "") || ($_POST["type3"] != NULL && $_POST["type3"] != "") || ($_POST["picture"] != NULL && $_POST["picture"] != "") ||
	($_POST["carac"] != NULL && $_POST["carac"] != "") || ($_POST["mark"] != NULL && $_POST["mark"] != "") ||
	($_POST["price"] != NULL && $_POST["price"] != "") || ($_POST["rank"] != NULL && $_POST["rank"] != "")))
{
	if (file_exists('private/shop') == TRUE)
	{
		$content = file_get_contents("private/shop");
		$content = unserialize($content);
		$i = 0;
		while ($content[$i] != NULL && $content[$i]['product'] != $_POST['product'])
			$i++;
		if ($content[$i]['product'] == $_POST['product'])
		{
			if ($_POST['type1'] != NULL && $_POST['type1'] != "")
				$content[$i]['type1'] = $_POST['type1'];
			if ($_POST['type2'] != NULL && $_POST['type2'] != "")
				$content[$i]['type2'] = $_POST['type2'];
			if ($_POST['type3'] != NULL && $_POST['type3'] != "")
				$content[$i]['type3'] = $_POST['type3'];
			if ($_POST['picture'] != NULL && $_POST['picture'] != "")
				$content[$i]['picture'] = $_POST['picture'];
			if ($_POST['carac'] != NULL && $_POST['carac'] != "")
				$content[$i]['carac'] = $_POST['carac'];
			if ($_POST['mark'] != NULL && $_POST['mark'] != "")
				$content[$i]['mark'] = $_POST['mark'];
			if ($_POST['price'] != NULL && $_POST['price'] != "")
				$content[$i]['price'] = $_POST['price'];
			if ($_POST['rank'] != NULL && $_POST['rank'] != "")
				$content[$i]['rank'] = $_POST['rank'];
			$content = serialize($content);
			file_put_contents('private/shop', $content);
			echo 'Modification reussie.';
		}
		else
			echo 'Modification erronee.';
	}
	else
		echo 'Modification erronee.';
}

?>
<div class="manage_users_body">
	<h1 class="title1">AJOUTER UN PRODUIT :</h1>
	<form action='index.php?page=manage_items' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Nom du produit: </td>
				<td><input type="text" name="product" value="" size=80 /></td>
			</tr>
			<tr>
				<td>Categorie 1: </td>
				<td><input type="text" name="type1" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Categorie 2: </td>
				<td><input type="text" name="type2" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Categorie 3: </td>
				<td><input type="text" name="type3" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Photo: </td>
				<td><input type="text" name="picture" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Descriptif: </td>
				<td><input type="text" name="carac" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Marque: </td>
				<td><input type="text" name="mark" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Prix: </td>
				<td><input type="text" name="price" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Rang: </td>
				<td><input type="text" name="rank" value="" size="80" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type="submit" name="submit" value="add" /></td>
			</tr>
		</table>
	</form>
	<h1 class="title1">MODIFIER UN PRODUIT :</h1>
	<form action='index.php?page=manage_items' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Nom du produit: </td>
				<td><input type="text" name="product" value="" size=80 /></td>
			</tr>
			<tr>
				<td>Categorie 1: </td>
				<td><input type="text" name="type1" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Categorie 2: </td>
				<td><input type="text" name="type2" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Categorie 3: </td>
				<td><input type="text" name="type3" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Photo: </td>
				<td><input type="text" name="picture" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Descriptif: </td>
				<td><input type="text" name="carac" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Marque: </td>
				<td><input type="text" name="mark" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Prix: </td>
				<td><input type="text" name="price" value="" size="80" /></td>
			</tr>
			<tr>
				<td>Rang: </td>
				<td><input type="text" name="rank" value="" size="80" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type="submit" name="submit" value="mod" /></td>
			</tr>
		</table>
	</form>
	<h1 class="title1">SUPPRIMER PRODUIT :</h1>
	<form action='index.php?page=manage_items' method='POST'>
		<table class="tab_form">
			<tr>
				<td>Nom du produit: </td>
				<td><input type="text" name="product" value="" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input class="btn_form" type="submit" name="submit" value="del" /></td>
			</tr>
		</table>
	</form>
</div>
