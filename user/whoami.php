<?PHP

include 'look_after.php';

if ($_SESSION != NULL && $_SESSION['logged_on_user'] != NULL && $_SESSION['logged_on_user'] != "")
{
	// echo 'Salut '.look_after('private/account','f_name','login',$_SESSION['logged_on_user'])." ".
	// 	strtoupper(look_after('private/account','l_name','login',$_SESSION['logged_on_user'])).' !';
	// echo '<a href="index.php?page=settings" >Panneau de configuration</a><br />';
	// echo '<a href="user/logout.php" >Deconnection</a><br />';

	include 'logged.php';
}
else
	include 'user/login.html';

?>
