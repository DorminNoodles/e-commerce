<?PHP

function	get_item($content, $name)
{
	foreach ($content as $index => $value)
	{
		if ($value['product'] === $name)
			$item = $value;
	}
	return ($item);
}

$content = file_get_contents("private/shop");
$content = unserialize($content);

function	create_display($content)
{
	foreach ($_SESSION['cart'] as $value)
	{
		$arr[] = get_item($content, $value['name']);
	}
	return ($arr);
}

function	product_qty($product)
{
	$i = 0;
	while ($_SESSION['cart'][$i] && $_SESSION['cart'][$i]['name'] != $product)
		$i++;
	return ($_SESSION['cart'][$i]['qty']);
}

function	sum_product($value)
{
	$sum = 0;
	return (product_qty($value['product']) * $value['price']);
}

function	show_cart_items($value)
{
	echo "<tr>";
	echo "<td class=\"items_img\"><img src=" . $value['picture'] . " width=150></td>";
	echo "<td class=\"item_name\"><a href=\"index.php?page=item&id=" . htmlspecialchars($value['product']) . "\">" . $value['product'];
	echo "<br /><span class=\"items_mark\">par ". $value['mark'] ."</td>";
	echo "<td class=\"items_price\">" . $value['price'] . "€</td>";
	echo "<td class=\"items_qty\">Qty : " . product_qty($value['product']) . "</td>";
	echo "<td class=\"delete_item_cart\"><a href=\"index.php?page=cart&action=del&id=" . htmlspecialchars($value['product']) . "\">delete</a></td>";
	echo "</tr>";
}

	if ($_GET['action'] === "del")
	{
		$i = 0;
		while ($_SESSION['cart'][$i] && $_SESSION['cart'][$i]['name'] != rawurldecode($_GET['id']))
			$i++;

		if ($_SESSION['cart'][$i]['name'])
		{
			$_SESSION['cart'][$i]['qty']--;
			if ($_SESSION['cart'][$i]['qty'] == 0)
			{
				unset($_SESSION['cart'][$i]);
				array_shift($_SESSION['cart']);
			}
		}
	}


?>

<div class="body_cart">
<?php
		if ($_SESSION['cart'] === NULL)
			echo "Votre panier est vide !\n";
?>
	<table class="table_cart">
<?php
		$sum = 0;
		if ($_SESSION['cart'])
		{
			$arr = create_display($content);
			foreach ($arr as $value)
			{
				$sum += sum_product($value);
				show_cart_items($value);
			}
		}
 ?>
	</table>
<?php
	echo "<div class=\"total\">Total : " . $sum . "€</div>";

	if ($_SESSION['logged_on_user'] && $_SESSION['cart'] != NULL)
		echo "<div class=\"total\"><form action='add_order.php' method='POST'><input class=\"btn_form\" type=\"submit\" name=\"submit\" value=\"OK\" /></form></div>";
?>
</div>
