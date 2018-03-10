<?php

	$content = file_get_contents("private/shop");
	$content = unserialize($content);

	function	show_items($img, $name, $price, $mark)
	{
		echo "<tr>";
		echo "<td class=\"items_img\"><img src=" . $img . " width=150></td>";
		echo "<td class=\"item_name\"><a href=\"index.php?page=item&id=" . htmlspecialchars($name) . "\">" . $name;
		echo "<br /><span class=\"items_mark\">par ". $mark ."</td>";
		echo "<td class=\"items_price\">" . $price . "€</td>";
		echo "</tr>";
	}

	echo "<div class=cat_body>";
	echo "<table class=\"cat_table\">";
	$type = $_GET['cat'];
	foreach ($content as $index => $elem)
	{
		if ($elem['type1'] === $type || $elem['type2'] === $type || $elem['type3'] === $type)
			show_items($elem['picture'], $elem['product'], $elem['price'], $elem['mark']);
	}
	echo "</table>";
	echo "</div>"
?>
