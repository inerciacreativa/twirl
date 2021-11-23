<?php

if (!function_exists('str_contains')) {
	function str_contains(string $haystack, string $needle): bool
	{
		return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}

if (!function_exists('str_ends_with')) {
	function str_ends_with(string $haystack, string $needle): bool
	{
		return $needle !== '' && mb_substr($haystack, -mb_strlen($needle)) === $needle;
	}
}

if (!function_exists('str_starts_with')) {
	function str_starts_with(string $haystack, string $needle): bool
	{
		return $needle !== '' && mb_strpos($haystack, $needle) === 0;
	}
}
