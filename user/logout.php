<?PHP

session_start();

$_SESSION["logged_on_user"] = "";
$_SESSION['rank'] = "";
header( 'refresh:2; ../index.php');
echo "A bientot ".$_SESSION["logged_on_user"].'<br />';

?>
