<?php
declare(strict_types=1);

namespace Twirl\String\Traits;

/**
 * Trait Html
 *
 * @package Twirl\String\Traits
 */
trait Html
{

	/**
	 * @param string $string
	 * @param int    $limit
	 * @param bool   $empty
	 *
	 * @return array
	 */
	public static function paragraphs(string $string, int $limit = -1, bool $empty = false): array
	{
		$flags = $empty ? 0 : PREG_SPLIT_NO_EMPTY;

		return preg_split('/<p([^>])*>/', str_replace('</p>', '', $string), $limit, $flags);
	}

	/**
	 * Strip all HTML tags. It also removes the contents of script, style
	 * and the tags specified in $blockTags.
	 *
	 * @param string   $string
	 * @param string[] $blockTags
	 *
	 * @return string
	 */
	public static function stripTags(string $string, array $blockTags = []): string
	{
		$string = self::stripBlockTags($string, array_merge($blockTags, [
			'script',
			'style',
		]));
		$string = strip_tags($string);

		return trim($string);
	}

	/**
	 * Strip HTML tags and their contents.
	 *
	 * @param string   $string
	 * @param string[] $tags
	 *
	 * @return string
	 */
	public static function stripBlockTags(string $string, array $tags): string
	{
		$tags = array_map(static function (string $tag) {
			return preg_replace('/[^A-Z1-6]/i', '', $tag);
		}, $tags);

		if (!empty($tags)) {
			$string = preg_replace('@<(' . implode('|', $tags) . ')[^>]*?>.*?</\\1>@si', '', $string);
		}

		return trim($string);
	}

	/**
	 * Strip only specified HTML tags.
	 *
	 * @param string $string
	 * @param string[]  $tags
	 *
	 * @return string
	 */
	public static function stripOnlyTags(string $string, array $tags): string
	{
		return preg_replace('@</?(' . implode('|', $tags) . ')[^>]*?>@si', '', $string);
	}

}
