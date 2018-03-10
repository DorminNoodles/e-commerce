<?php

	$content = file_get_contents("private/shop");
	$content = unserialize($content);

	foreach ($content as $value)
	{
		if ($value['product'] === rawurldecode($_GET['id']))
		{
			$item_name = $value['product'];
			$img_url = $value['picture'];
			$item_price = $value['price'];
			$item_carac = $value['carac'];
		}
	}
	if ($_POST["submit"] === "Ajouter au panier")
	{
		$i = 0;
		while ($_SESSION['cart'][$i] != NULL && $_SESSION['cart'][$i]['name'] != rawurldecode($_GET['id']))
			$i++;
		if ($_SESSION['cart'][$i]['name'] == rawurldecode($_GET['id']))
			$_SESSION['cart'][$i]['qty'] += 1;
		else {
			$_SESSION['cart'][$i]['name'] = rawurldecode($_GET['id']);
			$_SESSION['cart'][$i]['qty'] = 1;
		}
	}
?>
<div class="body_item">
	<table>
		<tr>
			<td>
				<div class="img_item">
					<img src="<?php 	echo $_GET['action'];	echo $img_url;  ?>" width=350>
				</div>
			</td>
			<td>
				<div class="item_infos">
					<h2><?php echo $item_name; ?></h2>
					<br />
					<span class="price"><?php echo $item_price; ?>€</span>
					<br />
					<form action="" method='POST'></br>
						<input class="btn_form" type="submit" name="submit" value="Ajouter au panier" />
					</form>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="carac_items">
					<h1 class=title2>Description Produit</h1>
					<p>
						<?php echo $item_carac ?>
					</p>
				<div/>
			</td>
		</tr>
	</table>
</div>
<?php
	if ($_POST['submit'] !== 'Ajouter au panier')
		return;
?>
	<div class="in_cart">
		Article ajoute au panier !
	</div>
