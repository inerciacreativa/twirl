<?php
declare(strict_types=1);

namespace Twirl\String\Traits;

use voku\helper\ASCII;

/**
 * Trait Convert
 *
 * @package Twirl\String\Traits
 */
trait Convert
{

	/**
	 * The cache of snake-cased words.
	 *
	 * @var array
	 */
	protected static array $snakeCache = [];

	/**
	 * The cache of camel-cased words.
	 *
	 * @var array
	 */
	protected static array $camelCache = [];

	/**
	 * The cache of studly-cased words.
	 *
	 * @var array
	 */
	protected static array $studlyCache = [];

	/**
	 * Transliterate a UTF-8 value to ASCII.
	 *
	 * @param string $value
	 * @param string $language
	 *
	 * @return string
	 */
	public static function ascii(string $value, string $language = 'en'): string
	{
		return ASCII::to_ascii($value, $language);
	}

	/**
	 * Convert a value to camel case.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function camel(string $string): string
	{
		return static::$camelCache[$string] ?? (static::$camelCache[$string] = lcfirst(static::studly($string)));
	}

	/**
	 * @param string $string
	 * @param string $encoding
	 *
	 * @return string
	 */
	public static function convert(string $string, string $encoding): string
	{
		if (!mb_detect_encoding($string, $encoding)) {
			return mb_convert_encoding($string, $encoding);
		}

		return $string;
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 */
	public static function fromEntities(string $string): string
	{
		$string = html_entity_decode($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');

		return static::utf8($string);
	}

	/**
	 * Determine if a given string is 7 bit ASCII.
	 *
	 * @param string $value
	 *
	 * @return bool
	 */
	public static function isAscii($value): bool
	{
		return ASCII::is_ascii((string) $value);
	}

	/**
	 * Convert a string to kebab case.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function kebab(string $value): string
	{
		return static::snake($value, '-');
	}

	/**
	 * Convert the given string to lower-case.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function lower(string $string): string
	{
		return mb_strtolower($string, 'UTF-8');
	}

	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @param string      $string
	 * @param string      $separator
	 * @param string|null $language
	 *
	 * @return string
	 */
	public static function slug(string $string, string $separator = '-', ?string $language = 'en'): string
	{
		$string = $language ? static::ascii($string, $language) : $string;

		$flip = $separator === '-' ? '_' : '-';

		$string = preg_replace('![' . preg_quote($flip, '/') . ']+!u', $separator, $string);
		// Replace @ with the word 'at'
		$string = str_replace('@', $separator . 'at' . $separator, $string);
		// Remove all characters that are not the separator, letters, numbers, or whitespace
		$string = preg_replace('![^' . preg_quote($separator, '/') . '\pL\pN\s]+!u', '', static::lower($string));
		// Replace all separator characters and whitespace by a single separator
		$string = preg_replace('![' . preg_quote($separator, '/') . '\s]+!u', $separator, $string);

		return trim($string, $separator);
	}

	/**
	 * Convert a string to snake case.
	 *
	 * @param string $string
	 * @param string $delimiter
	 *
	 * @return string
	 */
	public static function snake(string $string, string $delimiter = '_'): string
	{
		$key = $string;

		if (isset(static::$snakeCache[$key][$delimiter])) {
			return static::$snakeCache[$key][$delimiter];
		}

		if (!ctype_lower($string)) {
			$string = preg_replace('/\s+/u', '', ucwords($string));
			$string = static::lower(preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $string));
		}

		return static::$snakeCache[$key][$delimiter] = $string;
	}

	/**
	 * Convert a value to studly caps case.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function studly(string $string): string
	{
		$key = $string;

		if (isset(static::$studlyCache[$key])) {
			return static::$studlyCache[$key];
		}

		$string = ucwords(str_replace(['-', '_'], ' ', $string));

		return static::$studlyCache[$key] = str_replace(' ', '', $string);
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 */
	public static function toEntities(string $string): string
	{
		$string = static::utf8($string);

		return static::convert($string, 'HTML-ENTITIES');
	}

	/**
	 * Convert the given string to upper-case.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function upper(string $string): string
	{
		return mb_strtoupper($string, 'UTF-8');
	}

	/**
	 * @param string $string
	 *
	 * @return string
	 */
	public static function utf8(string $string): string
	{
		return static::convert($string, 'UTF-8');
	}

}
