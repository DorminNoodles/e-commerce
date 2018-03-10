<div class="nav_bar">
	<div class="logo">
		<a href="index.php"><img src="img/logo.png" width="100"><span>LEMMINGS</span></a>
	</div>
	<?php include 'user/whoami.php' ?>
</div>
<div class="nav_menu">
<table>
	<tr>
<?PHP

include 'whatishot.php';
$pop = whatistop();
$i = 0;
while ($pop[$i] != NULL)
{
	if ($i != 0)
		echo '<td>|</td>';
	echo '<td><a href="index.php?page=cat&cat='.$pop[$i]['tag'].'">'.$pop[$i]['name'].'</a></td>';
	$i++;
}
if ($_SESSION['logged_on_user'] && $_SESSION['rank'] === "admin")
{
	echo '<td>|</td>';
	echo "<td><a href=\"index.php?page=manage_users\">MANAGE USERS</a></td>";
	echo "<td>|</td>";
	echo "<td><a href=\"index.php?page=manage_items\">MANAGE ITEMS</a></td>";
	echo "<td>|</td>";
	echo "<td><a href=\"index.php?page=manage_tags\">MANAGE TAGS</a></td>";
	echo "<td>|</td>";
	echo "<td><a href=\"index.php?page=outgoing\">COMMANDES</a></td>";
}
?>
	</tr>
</table>
</div>
