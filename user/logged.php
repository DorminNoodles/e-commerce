<div class="logged">
	<div>
		<div class="hello_user">
				<!-- <? echo "Salut , ";?> -->
			<? echo look_after('private/account','f_name','login',$_SESSION['logged_on_user']);?>
			<? echo look_after('private/account','l_name','login',$_SESSION['logged_on_user']);?>
		</div>
		<table>
			<tr>
				<td><a href=index.php?page=settings><img src="img/icon_user.png" width=100></a></td>
				<td><a href=user/logout.php><img src="img/cross.png" width=50></a></td>
			</tr>
		</table>
	</div>
	<div class="cart">
		<a href=index.php?page=cart><img src="img/cart_icon.png" width=90/></a>
	</div>
</div>
