<?PHP

if ($_GET['action'] == 'del' && $_GET['id'] != NULL && $_GET['id'] != "")
{

	if (file_exists('private/order') == TRUE)
	{
		$content = file_get_contents('private/order');
		$order = unserialize($content);
		$i = 0;
		while ($order[$i] != NULL && $order[$i]['date'] != $_GET['id'])
			$id++;
		if ($order[$i]['date'] == $_GET['id'])
		{
			unset($order[$i]);
			$order = array_shift($order);
			echo "Suppression de la commande validee.";
		}
		else
			;
		$content = serialize($order);
		file_put_contents('private/order', $content);
	}
	else
		echo "Erreur car il n'a pas de commande.";
}

if ($_SESSION['rank'] != 'admin' || file_exists('private/order') == FALSE)
{
	echo '<span class=title1>Aucune commande en attente.<span>';
	return 0;
}
else
{
	$content = file_get_contents('private/order');
	$order = unserialize($content);
	if ($order != NULL)
	{
		echo "<div class=body_orders>";

		echo "<table class=\"tab_orders\">";
		foreach ($order as $elem)
		{
			echo "<tr>";

			echo "<td>";
			echo '<a href="index.php?page=outgoing&action=del&id='.$elem['date'].'">delete</a>   ';
			echo date('\L\e d/m/y \a [h:i:s]', $elem['date']);
			echo "</td>";
			echo "<td>";
			echo $elem['user'];
			echo "</td>";
			echo "<td>";
			echo "<table class=\"product\">";
			foreach ($elem['detail'] as $value)
			{
				echo "<tr>";
				echo "<td>";
				echo $value['name'];
				echo "</td>";
				echo "<td>";
				echo $value['qty'];
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";

		echo "</div>";
	}
	else
		echo '<span class=title1>Aucune commande en attente.<span>';
}


?>
