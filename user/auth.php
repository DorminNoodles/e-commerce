<?PHP

session_start();

function    search($array1, $string)
{
    foreach($array1 as $elem)
    {
        if ($elem['passwd'] == $string)
            return (TRUE);
    }
    return (FALSE);
}

function    auth($login, $passwd)
{
    if ($login != NULL && $passwd != NULL && file_exists('../private/account') == TRUE)
    {
        $verif_pw = hash("whirlpool", $passwd);
        $content = file_get_contents('../private/account');
        $content = unserialize($content);
        if (search($content, $verif_pw) == TRUE)
            return (TRUE);
    }
    return (FALSE);
}

include '../look_after.php';

$_POST['login'] = strip_tags($_POST['login']);
$_POST['passwd'] = strip_tags($_POST['passwd']);

if (auth($_POST['login'], $_POST['passwd']) == TRUE)
{
	$_SESSION['logged_on_user'] = $_POST['login'];
	$_SESSION['rank'] = look_after('../private/account', 'rank', 'login', $_POST['login']);
	if ($_POST['save'] == "save")
	{
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['passwd'] = $_POST['passwd'];
	}
	else
	{
		$_SESSION['login'] = "";
		$_SESSION['passwd'] = "";
	}
	header('Location: ../index.php');
}
else
{
	$_SESSION["logged_on_user"] = "";
	header('refresh:2; ../index.php');
	echo 'Mauvais login ou mot de passe. Redirection en cours.';
}
?>
