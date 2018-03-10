<html><body>
<?PHP
if (file_exists('../private/order') == TRUE)
{
	echo 'Mes commandes :';
	$content = file_get_contents('../private/order');
	$order = unserialize($content);
	$i = 0;
	while ($order[$i] != NULL)
	{
		if ($order[$i]['user'] == $_SESSION['logged_on_user'];
		{
			echo date('Le d/m/y a [h:i:s],', $order[$i]['time'])." vous avez commande : <br />";
			$n = 0;
			while ($order[$i]['order'][$n])
			{
				echo $order[$i]['order'][$n]['qty']." x ".$order[$i]['order'][$n]['name'].';<br />';
				$n++;
			}
			echo '<br /><br /><br />';
		}
	}
}
else
	echo 'Aucune commande en attente.';
?>
</html><body>
