<?PHP

function	look_after($file_path, $lf_class, $ref_class, $id)
{
	if (file_exists($file_path) == TRUE)
	{
		$content = file_get_contents($file_path);
		$content = unserialize($content);
		foreach($content as $elem)
		{
			if ($elem[$ref_class] == $id)
				 return ($elem[$lf_class]);
		}
	}
	return (FALSE);
}
?>
