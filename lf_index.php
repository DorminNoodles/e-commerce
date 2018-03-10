<?PHP

function    lf_index($file_path, $lf_class, $ref_class, $id, $index)
{
	if (file_exists($file_path) == TRUE)
	{
		$content = file_get_contents($file_path);
		$content = unserialize($content);
		if ($content[$index][$ref_class] == $id)
			return ($content[$index][$lf_class]);
	}
	return (FALSE);
}
?>
