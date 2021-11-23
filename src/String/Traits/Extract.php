<?php
declare(strict_types=1);

namespace Twirl\String\Traits;

/**
 * Trait Extract
 *
 * @package Twirl\String\Traits
 */
trait Extract
{

	/**
	 * Return the remainder of a string after the first occurrence of a given value.
	 *
	 * @param string $subject
	 * @param string $search
	 *
	 * @return string
	 */
	public static function after(string $subject, string $search): string
	{
		return $search === '' ? $subject : array_reverse(explode($search, $subject, 2))[0];
	}

	/**
	 * Return the remainder of a string after the last occurrence of a given value.
	 *
	 * @param string $subject
	 * @param string $search
	 *
	 * @return string
	 */
	public static function afterLast(string $subject, string $search): string
	{
		if ($search === '') {
			return $subject;
		}

		$position = strrpos($subject, $search);

		if ($position === false) {
			return $subject;
		}

		return substr($subject, $position + strlen($search));
	}

	/**
	 * Get the portion of a string before the first occurrence of a given value.
	 *
	 * @param string $subject
	 * @param string $search
	 *
	 * @return string
	 */
	public static function before(string $subject, string $search): string
	{
		if ($search === '') {
			return $subject;
		}

		$result = strstr($subject, $search, true);

		return $result === false ? $subject : $result;
	}

	/**
	 * Get the portion of a string before the last occurrence of a given value.
	 *
	 * @param string $subject
	 * @param string $search
	 *
	 * @return string
	 */
	public static function beforeLast(string $subject, string $search): string
	{
		if ($search === '') {
			return $subject;
		}

		$pos = mb_strrpos($subject, $search);

		if ($pos === false) {
			return $subject;
		}

		return static::substring($subject, 0, $pos);
	}

	/**
	 * Get the portion of a string between two given values.
	 *
	 * @param string $subject
	 * @param string $from
	 * @param string $to
	 *
	 * @return string
	 */
	public static function between(string $subject, string $from, string $to): string
	{
		if ($from === '' || $to === '') {
			return $subject;
		}

		return static::beforeLast(static::after($subject, $from), $to);
	}

	/**
	 * Returns the portion of string specified by the start and length parameters.
	 *
	 * @param string   $string
	 * @param int      $start
	 * @param int|null $length
	 *
	 * @return string
	 */
	public static function substring(string $string, int $start, int $length = null): string
	{
		return mb_substr($string, $start, $length, 'UTF-8');
	}

}
