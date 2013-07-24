<?php
class TextHelper
{
	public static function loadJson($path)
	{
		$contents = file_get_contents($path);
		$contents = preg_replace('/#(.*)$/m', '', $contents);
		return json_decode($contents);
	}

	public static function loadSimpleList($path)
	{
		$contents = file_get_contents($path);
		$contents = preg_replace('/#(.*)$/m', '', $contents);
		$lines = explode("\n", $contents);
		$lines = array_map('trim', $lines);
		$lines = array_filter($lines);
		return $lines;
	}

	private static function getNumberText($number, $short, $fmt, $shortForm, $longForm)
	{
		$txt = $short ? $shortForm : $longForm;
		if ($number == 0)
		{
			$number = '?';
			$txt .= 's';
		}
		elseif ($number > 1)
		{
			$txt .= 's';
		}
		return sprintf($fmt, $number, $txt);
	}

	public static function getVolumesText($number, $short = false, $fmt = '%s %s')
	{
		return self::getNumberText($number, $short, $fmt, 'vol', 'volume');
	}

	public static function getChaptersText($number, $short = false, $fmt = '%s %s')
	{
		return self::getNumberText($number, $short, $fmt, 'chap', 'chapter');
	}

	public static function getEpisodesText($number, $short = false, $fmt = '%s %s')
	{
		return self::getNumberText($number, $short, $fmt, 'ep', 'episode');
	}

	public static function replaceTokens($input, array $tokens)
	{
		$output = $input;
		foreach ($tokens as $key => $val)
		{
			if (is_object($val) or is_array($val))
			{
				continue;
			}
			$output = str_replace('{' . $key . '}', $val, $output);
		}
		return $output;
	}

}
