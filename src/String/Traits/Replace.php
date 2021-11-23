<?php
declare(strict_types=1);

namespace Twirl\String\Traits;

/**
 * Trait Replace
 *
 * @package Twirl\String\Traits
 */
trait Replace
{

	/**
	 * Replace the given value in the given string.
	 *
	 * @param string|string[] $subject
	 * @param string|string[] $search
	 * @param string|string[] $replace
	 *
	 * @return string
	 */
	public static function replace($subject, $search, $replace): string
	{
		return str_replace($search, $replace, $subject);
	}

	/**
	 * Replace a given value in the string sequentially with an array.
	 *
	 * @param string                    $subject
	 * @param string                    $search
	 * @param array<int|string, string> $replace
	 *
	 * @return string
	 */
	public static function replaceArray(string $subject, string $search, array $replace): string
	{
		$segments = explode($search, $subject);

		$result = array_shift($segments);

		foreach ($segments as $segment) {
			$result .= (array_shift($replace) ?? $search) . $segment;
		}

		return $result;
	}

	/**
	 * Replace the first occurrence of a given value in the string.
	 *
	 * @param string $subject
	 * @param string $search
	 * @param string $replace
	 *
	 * @return string
	 */
	public static function replaceFirst(string $subject, string $search, string $replace): string
	{
		if ($search === '') {
			return $subject;
		}

		$position = strpos($subject, $search);

		if ($position !== false) {
			return substr_replace($subject, $replace, $position, strlen($search));
		}

		return $subject;
	}

	/**
	 * Replace the last occurrence of a given value in the string.
	 *
	 * @param string $subject
	 * @param string $search
	 * @param string $replace
	 *
	 * @return string
	 */
	public static function replaceLast(string $subject, string $search, string $replace): string
	{
		if ($search === '') {
			return $subject;
		}

		$position = strrpos($subject, $search);

		if ($position !== false) {
			return substr_replace($subject, $replace, $position, strlen($search));
		}

		return $subject;
	}

}
