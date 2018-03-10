<?PHP

function    delete_case($file_path, $ref_class, $id)
{
	$ret = FALSE;
	if (file_exists($file_path) == TRUE)
	{
		$content = file_get_contents($file_path);
		$content = unserialize($content);
		$i = 0;
		while ($content[$i] != NULL && $content[$i][$ref_class] != $id)
			$i++;
		if ($content[$i][$ref_class] == $id)
		{
			unset($content[$i]);
			$content = array_values($content);
			$ret = TRUE;
		}
		$content = serialize($content);
		file_put_contents($file_path, $content);
	}
	return ($ret);
}

?>
