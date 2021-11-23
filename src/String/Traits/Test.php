<?php
declare(strict_types=1);

namespace Twirl\String\Traits;

/**
 * Trait Test
 *
 * @package Twirl\String\Traits
 */
trait Test
{

	/**
	 * Determine if a given string contains a given substring.
	 *
	 * @param string          $haystack
	 * @param string|string[] $needles
	 *
	 * @return bool
	 */
	public static function contains(string $haystack, $needles): bool
	{
		foreach ((array) $needles as $needle) {
			if (str_contains($haystack, (string) $needle)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Determine if a given string contains all array values.
	 *
	 * @param string   $haystack
	 * @param string[] $needles
	 *
	 * @return bool
	 */
	public static function containsAll(string $haystack, array $needles): bool
	{
		foreach ($needles as $needle) {
			if (!str_contains($haystack, (string) $needle)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Determine if a given string ends with a given substring.
	 *
	 * @param string          $haystack
	 * @param string|string[] $needles
	 *
	 * @return bool
	 */
	public static function endsWith(string $haystack, $needles): bool
	{
		foreach ((array) $needles as $needle) {
			if (str_ends_with($haystack, (string) $needle)) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param string          $haystack
	 * @param string|string[] $needles
	 *
	 * @return bool
	 */
	public static function startsWith(string $haystack, $needles): bool
	{
		foreach ((array) $needles as $needle) {
			if (str_starts_with($haystack, (string) $needle)) {
				return true;
			}
		}

		return false;
	}

}
