<?PHP

function	inc_val($tag)
{
	if (file_exists('private/tags') == TRUE)
	{
		$content = file_get_contents('private/tags');
		$tags = unserialize($content);
		$i = 0;
		while ($tags[$i] != NULL && $tags[$i]['tag'] != $tag)
			$i++;
		if ($tags[$i]['tag'] == $tag)
		{
			if ($tags[$i]['pop'] == NULL)
				$tags[$i]['pop'] = 1;
			else
				$tags[$i]['pop'] += 1;
		}
		$content = serialize($tags);
		$content = file_put_contents('private/tags', $content);
	}
}

function	voteforme()
{
	if (file_exists('private/tags') == TRUE)
	{
		$i = 0;
		$content = file_get_contents('private/tags');
		$tags = unserialize($content);
		$tmp = 0;
		while ($tags[$i] != NULL)
		{
			if ($tags[$i]['pop'] > $tmp['pop'])
				$tmp = $tags[$i];
			$i++;
		}
		$vote[0] = $tmp;
		$i = 0;
		$tmp = 0;
		while ($tags[$i] != NULL)
		{
			if ($tags[$i]['pop'] >= $tmp['pop'] && $tags[$i]['pop'] <= $vote[0]['pop'] && $tags[$i]['tag'] != $vote[0]['tag'])
				$tmp = $tags[$i];
			$i++;
		}
		$vote[1] = $tmp;
		$i = 0;
		$tmp = 0;
		while ($tags[$i] != NULL)
		{
			if ($tags[$i]['pop'] >= $tmp['pop'] && $tags[$i]['pop'] <= $vote[1]['pop'] && $tags[$i]['tag'] != $vote[1]['tag'] && $tags[$i]['tag'] != $vote[0]['tag'])
				$tmp = $tags[$i];
			$i++;
		}
		$vote[2] = $tmp;
		$i = 0;
		$tmp = 0;
		while ($tags[$i] != NULL)
		{
			if ($tags[$i]['pop'] >= $tmp['pop'] && $tags[$i]['pop'] <= $vote[2]['pop'] && $tags[$i]['tag'] != $vote[2]['tag'] && $tags[$i]['tag'] != $vote[1]['tag'] && $tags[$i]['tag'] != $vote[0]['tag'])
				$tmp = $tags[$i];
			$i++;
		}
		$vote[3] = $tmp;
		$i = 0;
		$tmp = 0;
		while ($tags[$i] != NULL)
		{
			if ($tags[$i]['pop'] >= $tmp['pop'] && $tags[$i]['pop'] <= $vote[3]['pop'] && $tags[$i]['tag'] != $vote[3]['tag'] && $tags[$i]['tag'] != $vote[2]['tag'] && $tags[$i]['tag'] != $vote[1]['tag'] && $tags[$i]['tag'] != $vote[0]['tag'])
				$tmp = $tags[$i];
			$i++;
		}
		$vote[4] = $tmp;
		$i = 0;
		$tmp = 0;
		while ($tags[$i] != NULL)
		{
			if ($tags[$i]['pop'] >= $tmp['pop'] && $tags[$i]['pop'] <= $vote[4]['pop'] && $tags[$i]['tag'] != $vote[4]['tag'] && $tags[$i]['tag'] != $vote[3]['tag'] && $tags[$i]['tag'] != $vote[2]['tag'] && $tags[$i]['tag'] != $vote[1]['tag'] && $tags[$i]['tag'] != $vote[0]['tag'])
				$tmp = $tags[$i];
			$i++;
		}
		$vote[5] = $tmp;
		$content = serialize($tags);
		$content = file_put_contents('private/tags', $content);
		return ($vote);
	}
	return (FALSE);
}

function	set_pop()
{
	if (file_exists('private/tags') == TRUE)
	{
		$content = file_get_contents('private/tags');
		$tags = unserialize($content);
		$i = 0;
		while ($tags[$i] != NULL)
		{
			$tags[$i]['pop'] = NULL;
			$i++;
		}
		$content = serialize($tags);
		$content = file_put_contents('private/tags', $content);
	}
}

function	whatistop()
{
	if (file_exists('private/shop') == TRUE)
	{
		set_pop();
		$content = file_get_contents('private/shop');
		$shop = unserialize($content);
		$i = 0;
		while ($shop[$i] != NULL)
		{
			if ($shop[$i]['type1'] != NULL && $shop[$i]['type1'] != '')
				inc_val($shop[$i]['type1']);
			if ($shop[$i]['type2'] != NULL && $shop[$i]['type2'] != '')
				inc_val($shop[$i]['type2']);
			if ($shop[$i]['type3'] != NULL && $shop[$i]['type3'] != '')
				inc_val($shop[$i]['type3']);
			$i++;
		}
		$content = serialize($shop);
		$content = file_put_contents('private/shop', $content);
		return(voteforme());
	}
	else
		echo 'Erreur pour whatistop car registre n\'existe pas';
	return (FALSE);
}

?>
