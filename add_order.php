<?PHP

session_start();

if ($_POST['submit'] == 'OK' && $_SESSION['logged_on_user'] != '' && $_SESSION['logged_on_user'] != NULL &&
	$_SESSION['cart'] != NULL)
{
	$ret = '';
	if ($_SESSION['count'] == NULL)
		$_SESSION['count'] == 1;
	else
		$_SESSION['count'] += 1;
	$new['user'] = $_SESSION['logged_on_user'];
	$time = time();
	$new['date'] = $time;
	$new['detail'] = $_SESSION['cart']; 
	if (file_exists('private/order') == TRUE)
	{
		$content = file_get_contents('private/order');
		$order = unserialize($content);
		$i = 0;
		while ($order[$i] != NULL && $order[$i]['date'] != $new['date'])
			$i++;
		if ($order[$i]['date'] != $new['date'])
		{
			$ret = 'ok';
			$order[] = $new;
		}
	}
	else
	{
		$ret = 'ok';
		$order[] = $new;
	}
	unset($_SESSION['cart']);
	$content = serialize($order);
	if (file_exists('private/') == FALSE)
		mkdir('private/');
	file_put_contents('private/order', $content);
	header('refresh:3; index.php');
	if ($ret == 'ok')
		echo 'Commande validee. Nous vous remercions pour votre confiance !';
	else
		echo 'Malheureusement votre commande n\'a pas pu aboutir.';
}

?>
