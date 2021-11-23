<?php
declare(strict_types=1);

namespace Twirl\String\Traits;

/**
 * Trait Limit
 *
 * @package Twirl\String\Traits
 */
trait Limit
{

	/**
	 * Limit the number of characters in a string.
	 *
	 * @param string $string
	 * @param int    $limit
	 * @param string $end
	 *
	 * @return string
	 */
	public static function chars(string $string, int $limit = 100, string $end = '…'): string
	{
		$string = static::whitespace($string);

		if (mb_strwidth($string, 'UTF-8') <= $limit) {
			return $string;
		}

		return rtrim(mb_strimwidth($string, 0, $limit, '', 'UTF-8')) . $end;
	}

	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @param string $value
	 * @param string $cap
	 *
	 * @return string
	 */
	public static function finish(string $value, string $cap): string
	{
		$quoted = preg_quote($cap, '/');

		return preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
	}

	/**
	 * Return the length of the given string.
	 *
	 * @param string      $string
	 * @param string|null $encoding
	 *
	 * @return int
	 */
	public static function length(string $string, ?string $encoding = null): int
	{
		if ($encoding) {
			return mb_strlen($string, $encoding);
		}

		return mb_strlen($string);
	}

	/**
	 * @param string $string
	 * @param string $chars
	 * @param bool   $spaces
	 *
	 * @return string
	 */
	public static function ltrim(string $string, string $chars = '', bool $spaces = true): string
	{
		if ($spaces) {
			$chars .= '\pZ\pC';
		}

		return preg_replace('/^[' . $chars . ']+/u', '', $string);
	}

	/**
	 * @param string $string
	 * @param string $chars
	 * @param bool   $spaces
	 *
	 * @return string
	 */
	public static function rtrim(string $string, string $chars = '', bool $spaces = true): string
	{
		if ($spaces) {
			$chars .= '\pZ\pC';
		}

		return preg_replace('/[' . $chars . ']+$/u', '', $string);
	}

	/**
	 * @param string $string
	 * @param string $chars
	 * @param bool   $spaces
	 *
	 * @return string
	 */
	public static function trim(string $string, string $chars = '', bool $spaces = true): string
	{
		if ($spaces) {
			$chars .= '\pZ\pC';
		}

		return preg_replace('/^[' . $chars . ']+|[' . $chars . ']+$/u', '', $string);
	}

	/**
	 * Normalizes the whitespaces of a given string.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function whitespace(string $string): string
	{
		// Replace non-breaking space entities
		$string = str_replace([
			'&nbsp;',
			'&#x000A0;',
			'&#xA0;',
			'&#160;',
		], ' ', $string);
		// Replace non-breaking space Unicode
		$string = (string) preg_replace('/(\x{00A0})/iu', ' ', $string);
		// Remove multiple whitespaces and line breaks
		$string = (string) preg_replace('/\s+/u', ' ', $string);

		return trim($string);
	}

	/**
	 * Limit the number of words in a string.
	 *
	 * @param string $string
	 * @param int    $words
	 * @param string $end
	 *
	 * @return string
	 */
	public static function words(string $string, int $words = 100, string $end = '…'): string
	{
		$string = static::whitespace($string);

		preg_match('/^\s*+(\S++\s*+){1,' . $words . '}/u', $string, $matches);

		if (!isset($matches[0]) || static::length($string) === static::length($matches[0])) {
			return $string;
		}

		return static::rtrim($matches[0], '.:,;') . $end;
	}

}
