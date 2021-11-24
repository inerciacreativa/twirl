<?php
declare(strict_types=1);

namespace Twirl\Test\String;

use PHPUnit\Framework\TestCase;
use Twirl\String\Str;

/**
 * Class StrTest
 *
 * @package Spin\Test\Support
 */
final class StrTest extends TestCase
{

	/**
	 * Trait Extract
	 */

	public function testAfter(): void
	{
		$this->assertSame('nah', Str::after('hannah', 'han'));
		$this->assertSame('nah', Str::after('hannah', 'n'));
		$this->assertSame('nah', Str::after('ééé hannah', 'han'));
		$this->assertSame('hannah', Str::after('hannah', 'xxxx'));
		$this->assertSame('hannah', Str::after('hannah', ''));
		$this->assertSame('nah', Str::after('han0nah', '0'));
	}

	public function testAfterLast(): void
	{
		$this->assertSame('tte', Str::afterLast('yvette', 'yve'));
		$this->assertSame('e', Str::afterLast('yvette', 't'));
		$this->assertSame('e', Str::afterLast('ééé yvette', 't'));
		$this->assertSame('', Str::afterLast('yvette', 'tte'));
		$this->assertSame('yvette', Str::afterLast('yvette', 'xxxx'));
		$this->assertSame('yvette', Str::afterLast('yvette', ''));
		$this->assertSame('te', Str::afterLast('yv0et0te', '0'));
		$this->assertSame('foo', Str::afterLast('----foo', '---'));
	}

	public function testBefore(): void
	{
		$this->assertSame('han', Str::before('hannah', 'nah'));
		$this->assertSame('ha', Str::before('hannah', 'n'));
		$this->assertSame('ééé ', Str::before('ééé hannah', 'han'));
		$this->assertSame('hannah', Str::before('hannah', 'xxxx'));
		$this->assertSame('hannah', Str::before('hannah', ''));
		$this->assertSame('han', Str::before('han0nah', '0'));
	}

	public function testBeforeLast(): void
	{
		$this->assertSame('yve', Str::beforeLast('yvette', 'tte'));
		$this->assertSame('yvet', Str::beforeLast('yvette', 't'));
		$this->assertSame('ééé ', Str::beforeLast('ééé yvette', 'yve'));
		$this->assertSame('', Str::beforeLast('yvette', 'yve'));
		$this->assertSame('yvette', Str::beforeLast('yvette', 'xxxx'));
		$this->assertSame('yvette', Str::beforeLast('yvette', ''));
		$this->assertSame('yv0et', Str::beforeLast('yv0et0te', '0'));
	}

	public function testBetween(): void
	{
		$this->assertSame('abc', Str::between('abc', '', 'c'));
		$this->assertSame('abc', Str::between('abc', 'a', ''));
		$this->assertSame('abc', Str::between('abc', '', ''));
		$this->assertSame('b', Str::between('abc', 'a', 'c'));
		$this->assertSame('b', Str::between('dddabc', 'a', 'c'));
		$this->assertSame('b', Str::between('abcddd', 'a', 'c'));
		$this->assertSame('b', Str::between('dddabcddd', 'a', 'c'));
		$this->assertSame('nn', Str::between('hannah', 'ha', 'ah'));
		$this->assertSame('a]ab[b', Str::between('[a]ab[b]', '[', ']'));
		$this->assertSame('foo', Str::between('foofoobar', 'foo', 'bar'));
		$this->assertSame('bar', Str::between('foobarbar', 'foo', 'bar'));
	}

	public function testSubstring(): void
	{
		$this->assertSame('Ё', Str::substring('БГДЖИЛЁ', -1));
		$this->assertSame('ЛЁ', Str::substring('БГДЖИЛЁ', -2));
		$this->assertSame('И', Str::substring('БГДЖИЛЁ', -3, 1));
		$this->assertSame('ДЖИЛ', Str::substring('БГДЖИЛЁ', 2, -1));
		$this->assertEmpty(Str::substring('БГДЖИЛЁ', 4, -4));
		$this->assertSame('ИЛ', Str::substring('БГДЖИЛЁ', -3, -1));
		$this->assertSame('ГДЖИЛЁ', Str::substring('БГДЖИЛЁ', 1));
		$this->assertSame('ГДЖ', Str::substring('БГДЖИЛЁ', 1, 3));
		$this->assertSame('БГДЖ', Str::substring('БГДЖИЛЁ', 0, 4));
		$this->assertSame('Ё', Str::substring('БГДЖИЛЁ', -1, 1));
		$this->assertEmpty(Str::substring('Б', 2));
	}

	/**
	 * Trait Test
	 */

	public function testContains(): void
	{
		$this->assertTrue(Str::contains('taylor', 'ylo'));
		$this->assertTrue(Str::contains('taylor', 'taylor'));
		$this->assertTrue(Str::contains('taylor', ['ylo']));
		$this->assertTrue(Str::contains('taylor', ['xxx', 'ylo']));
		$this->assertFalse(Str::contains('taylor', 'xxx'));
		$this->assertFalse(Str::contains('taylor', ['xxx']));
		$this->assertFalse(Str::contains('taylor', ''));
		$this->assertFalse(Str::contains('', ''));
	}

	public function testContainsAll(): void
	{
		$this->assertTrue(Str::containsAll('taylor otwell', [
			'taylor',
			'otwell',
		]));
		$this->assertTrue(Str::containsAll('taylor otwell', ['taylor']));
		$this->assertFalse(Str::containsAll('taylor otwell', [
			'taylor',
			'xxx',
		]));
	}

	public function testEndsWith(): void
	{
		$this->assertTrue(Str::endsWith('jason', 'on'));
		$this->assertTrue(Str::endsWith('jason', 'jason'));
		$this->assertTrue(Str::endsWith('jason', ['on']));
		$this->assertTrue(Str::endsWith('jason', ['no', 'on']));
		$this->assertFalse(Str::endsWith('jason', 'no'));
		$this->assertFalse(Str::endsWith('jason', ['no']));
		$this->assertFalse(Str::endsWith('jason', ''));
		$this->assertFalse(Str::endsWith('', ''));
		$this->assertFalse(Str::endsWith('jason', [null]));
		$this->assertFalse(Str::endsWith('jason', null));
		$this->assertFalse(Str::endsWith('jason', 'N'));
		$this->assertFalse(Str::endsWith('7', ' 7'));
		$this->assertTrue(Str::endsWith('a7', '7'));
		$this->assertTrue(Str::endsWith('a7', 7));
		$this->assertTrue(Str::endsWith('a7.12', 7.12));
		$this->assertFalse(Str::endsWith('a7.12', 7.13));
		// Test for multibyte string support
		$this->assertTrue(Str::endsWith('Jönköping', 'öping'));
		$this->assertTrue(Str::endsWith('Malmö', 'mö'));
		$this->assertFalse(Str::endsWith('Jönköping', 'oping'));
		$this->assertFalse(Str::endsWith('Malmö', 'mo'));
		$this->assertTrue(Str::endsWith('你好', '好'));
		$this->assertFalse(Str::endsWith('你好', '你'));
		$this->assertFalse(Str::endsWith('你好', 'a'));
	}

	public function testStartsWith(): void
	{
		$this->assertTrue(Str::startsWith('jason', 'jas'));
		$this->assertTrue(Str::startsWith('jason', 'jason'));
		$this->assertTrue(Str::startsWith('jason', ['jas']));
		$this->assertTrue(Str::startsWith('jason', ['day', 'jas']));
		$this->assertFalse(Str::startsWith('jason', 'day'));
		$this->assertFalse(Str::startsWith('jason', ['day']));
		$this->assertFalse(Str::startsWith('jason', null));
		$this->assertFalse(Str::startsWith('jason', [null]));
		$this->assertFalse(Str::startsWith('0123', [null]));
		$this->assertTrue(Str::startsWith('0123', 0));
		$this->assertFalse(Str::startsWith('jason', 'J'));
		$this->assertFalse(Str::startsWith('jason', ''));
		$this->assertFalse(Str::startsWith('', ''));
		$this->assertFalse(Str::startsWith('7', ' 7'));
		$this->assertTrue(Str::startsWith('7a', '7'));
		$this->assertTrue(Str::startsWith('7a', 7));
		$this->assertTrue(Str::startsWith('7.12a', 7.12));
		$this->assertFalse(Str::startsWith('7.12a', 7.13));
		// Test for multibyte string support
		$this->assertTrue(Str::startsWith('Jönköping', 'Jö'));
		$this->assertTrue(Str::startsWith('Malmö', 'Malmö'));
		$this->assertFalse(Str::startsWith('Jönköping', 'Jonko'));
		$this->assertFalse(Str::startsWith('Malmö', 'Malmo'));
		$this->assertTrue(Str::startsWith('你好', '你'));
		$this->assertFalse(Str::startsWith('你好', '好'));
		$this->assertFalse(Str::startsWith('你好', 'a'));
	}

	/**
	 * Trait Replace
	 */

	public function testReplace(): void
	{
		$this->assertSame('foo bar twirl', Str::replace('foo bar baz', 'baz', 'twirl'));
		$this->assertSame('foo bar baz 8.x', Str::replace('foo bar baz ?', '?', '8.x'));
		$this->assertSame('foo/bar/baz', Str::replace('foo bar baz', ' ', '/'));
		$this->assertSame('foo bar baz', Str::replace('?1 ?2 ?3', ['?1', '?2', '?3'], ['foo', 'bar', 'baz']));
	}

	public function testReplaceArray(): void
	{
		$this->assertSame('foo/bar/baz', Str::replaceArray('?/?/?','?', ['foo', 'bar', 'baz']));
		$this->assertSame('foo/bar/baz/?', Str::replaceArray('?/?/?/?', '?', ['foo', 'bar', 'baz']));
		$this->assertSame('foo/bar', Str::replaceArray('?/?', '?', ['foo', 'bar', 'baz']));
		$this->assertSame('?/?/?', Str::replaceArray('?/?/?', 'x', ['foo', 'bar', 'baz']));
		// Ensure recursive replacements are avoided
		$this->assertSame('foo?/bar/baz', Str::replaceArray('?/?/?', '?', ['foo?', 'bar', 'baz']));
		// Test for associative array support
		$this->assertSame('foo/bar', Str::replaceArray('?/?', '?', [1 => 'foo', 2 => 'bar']));
		$this->assertSame('foo/bar', Str::replaceArray('?/?', '?', ['x' => 'foo', 'y' => 'bar']));
	}

	public function testReplaceFirst(): void
	{
		$this->assertSame('fooqux foobar', Str::replaceFirst('foobar foobar', 'bar', 'qux'));
		$this->assertSame('foo/qux? foo/bar?', Str::replaceFirst('foo/bar? foo/bar?', 'bar?', 'qux?'));
		$this->assertSame('foo foobar', Str::replaceFirst('foobar foobar', 'bar', ''));
		$this->assertSame('foobar foobar', Str::replaceFirst('foobar foobar', 'xxx', 'yyy'));
		$this->assertSame('foobar foobar', Str::replaceFirst('foobar foobar', '', 'yyy'));
		// Test for multibyte string support
		$this->assertSame('Jxxxnköping Malmö', Str::replaceFirst('Jönköping Malmö', 'ö', 'xxx'));
		$this->assertSame('Jönköping Malmö', Str::replaceFirst('Jönköping Malmö', '', 'yyy'));
	}

	public function testReplaceLast(): void
	{
		$this->assertSame('foobar fooqux', Str::replaceLast('foobar foobar', 'bar', 'qux'));
		$this->assertSame('foo/bar? foo/qux?', Str::replaceLast('foo/bar? foo/bar?', 'bar?', 'qux?'));
		$this->assertSame('foobar foo', Str::replaceLast('foobar foobar', 'bar', ''));
		$this->assertSame('foobar foobar', Str::replaceLast('foobar foobar', 'xxx', 'yyy'));
		$this->assertSame('foobar foobar', Str::replaceLast('foobar foobar', '', 'yyy'));
		// Test for multibyte string support
		$this->assertSame('Malmö Jönkxxxping', Str::replaceLast('Malmö Jönköping', 'ö', 'xxx'));
		$this->assertSame('Malmö Jönköping', Str::replaceLast('Malmö Jönköping', '', 'yyy'));
	}

	/**
	 * Trait Limit
	 */

	public function testChars(): void
	{
		$this->assertSame('Twirl is…', Str::chars('Twirl is a free, open source PHP library.', 8));
		$this->assertSame('这是一…', Str::chars('这是一段中文', 6));

		$string = 'The PHP library for web artisans.';
		$this->assertSame('The PHP…', Str::chars($string, 7));
		$this->assertSame('The PHP library', Str::chars($string, 15, ''));
		$this->assertSame('The PHP library for web artisans.', Str::chars($string, 50));

		$nonAsciiString = '这是一段中文';
		$this->assertSame('这是一…', Str::chars($nonAsciiString, 6));
		$this->assertSame('这是一', Str::chars($nonAsciiString, 6, ''));
	}

	public function testFinish(): void
	{
		$this->assertSame('abbc', Str::finish('ab', 'bc'));
		$this->assertSame('abbc', Str::finish('abbcbc', 'bc'));
		$this->assertSame('abcbbc', Str::finish('abcbbcbc', 'bc'));
		$this->assertSame('abcbbcbc/', Str::finish('abcbbcbc///', '/'));
	}

	public function testLength(): void
	{
		$this->assertEquals(11, Str::length('foo bar baz'));
		$this->assertEquals(11, Str::length('foo bar baz', 'UTF-8'));
	}

	public function testLtrim(): void
	{
		$spaces = Str::fromEntities('&#8202;&nbsp;  &thinsp;&thinsp;&emsp; &#12288;');

		$this->assertSame('Jose Cuesta', Str::ltrim($spaces . 'Jose Cuesta'));
		$this->assertSame('se Cuesta', Str::ltrim(' Jose Cuesta', 'Jo'));
		$this->assertSame(' Jose Cuesta', Str::ltrim(' Jose Cuesta', 'Jo', false));
		$this->assertSame('Jose Cuesta', Str::ltrim(' Jose Cuesta', 'H'));
		$this->assertSame('ose Cuesta', Str::ltrim(' Jose Cuesta', 'CJs'));
	}

	public function testRtrim(): void
	{
		$spaces = Str::fromEntities('&#8202;&nbsp;  &thinsp;&thinsp;&emsp; &#12288;');

		$this->assertSame('Jose Cuesta', Str::rtrim('Jose Cuesta' . $spaces));
		$this->assertSame(' Jose Cues', Str::rtrim(' Jose Cuesta ', 'ta'));
		$this->assertSame('Jose Cuesta ', Str::rtrim('Jose Cuesta ', 'a', false));
		$this->assertSame('Jose Cuesta', Str::rtrim('Jose Cuesta  ', 'X'));
		$this->assertSame('Jose Cue', Str::rtrim('Jose Cuesta  ', 'tsa'));
	}

	public function testTrim(): void
	{
		$spaces = Str::fromEntities('&#8202;&nbsp;  &thinsp;&thinsp;&emsp; &#12288;');

		$this->assertSame('Jose Cuesta', Str::trim('    Jose Cuesta' . $spaces));
		$this->assertSame('ose Cues', Str::trim(' Jose Cuesta ', 'taJ'));
		$this->assertSame(' Jose Cuesta ', Str::trim(' Jose Cuesta ', 'a', false));
	}

	public function testWhitespace(): void
	{
		$this->assertSame('hello world', Str::whitespace('hello world'));
		$this->assertSame('hello world', Str::whitespace('  hello    world'));
		$this->assertSame('hello world', Str::whitespace('hello		world'));
		$this->assertSame('hello world', Str::whitespace('hello
		world'));
		$this->assertSame('hello world', Str::whitespace(" hello\n\r\tworld"));
		$this->assertSame('hello world', Str::whitespace('hello&nbsp;&nbsp; world&#x000A0;'));
		$this->assertSame('hello&nbsp;world', Str::whitespace('  hello&nbsp;world  ', false));
	}

	public function testWords(): void
	{
		$this->assertSame('Jose…', Str::words('Jose Cuesta', 1));
		$this->assertSame('Jose___', Str::words('Jose Cuesta', 1, '___'));
		$this->assertSame('Jose Cuesta', Str::words('Jose Cuesta', 3));
		$this->assertSame('Twirl is a free.', Str::words('Twirl is a free, open source PHP library.', 4, '.'));
	}

	/**
	 * Trait Convert
	 */

	public function testAscii(): void
	{
		$this->assertSame('@', Str::ascii('@'));
		$this->assertSame('u', Str::ascii('ü'));
		$this->assertSame('h H sht Sht a A ia yo', Str::ascii('х Х щ Щ ъ Ъ иа йо', 'bg'));
		$this->assertSame('ae oe ue Ae Oe Ue', Str::ascii('ä ö ü Ä Ö Ü', 'de'));
	}

	public function testCamel(): void
	{
		$this->assertSame('twirlPHPFramework', Str::camel('Twirl_p_h_p_framework'));
		$this->assertSame('twirlPhpFramework', Str::camel('Twirl_php_framework'));
		$this->assertSame('twirlPhPFramework', Str::camel('Twirl-phP-framework'));
		$this->assertSame('twirlPhpFramework', Str::camel('Twirl  -_-  php   -_-   framework   '));

		$this->assertSame('fooBar', Str::camel('FooBar'));
		$this->assertSame('fooBar', Str::camel('foo_bar'));
		$this->assertSame('fooBar', Str::camel('foo_bar')); // test cache
		$this->assertSame('fooBarBaz', Str::camel('Foo-barBaz'));
		$this->assertSame('fooBarBaz', Str::camel('foo-bar_baz'));
	}

	public function testFromEntities(): void
	{
		$this->assertSame('José', Str::fromEntities('Jos&eacute;'));
		$this->assertSame('<span>España</span>', Str::fromEntities('<span>Espa&ntilde;a</span>'));
	}

	public function testKebab(): void
	{
		$this->assertSame('twirl-php-library', Str::kebab('TwirlPhpLibrary'));
	}

	public function testToEntities(): void
	{
		$this->assertSame('Jos&eacute;', Str::toEntities('José'));
		$this->assertSame('<span>Espa&ntilde;a</span>', Str::toEntities('<span>España</span>'));
	}

	public function testLower(): void
	{
		$this->assertSame('foo bar baz', Str::lower('FOO BAR BAZ'));
		$this->assertSame('foo bar baz', Str::lower('fOo Bar bAz'));
	}

	public function testSlug(): void
	{
		$this->assertSame('hello-world', Str::slug('hello world'));
		$this->assertSame('hello-world', Str::slug('hello-world'));
		$this->assertSame('hello-world', Str::slug('hello_world'));
		$this->assertSame('hello_world', Str::slug('hello_world', '_'));
		$this->assertSame('user-at-host', Str::slug('user@host'));
		$this->assertSame('سلام-دنیا', Str::slug('سلام دنیا', '-', null));
	}

	public function testSnake(): void
	{
		$this->assertSame('twirl_p_h_p_framework', Str::snake('TwirlPHPFramework'));
		$this->assertSame('twirl_php_framework', Str::snake('TwirlPhpFramework'));
		$this->assertSame('twirl php framework', Str::snake('TwirlPhpFramework', ' '));
		$this->assertSame('twirl_php_framework', Str::snake('Twirl Php Framework'));
		$this->assertSame('twirl_php_framework', Str::snake('Twirl    Php      Framework   '));
		// ensure cache keys don't overlap
		$this->assertSame('twirl__php__framework', Str::snake('TwirlPhpFramework', '__'));
		$this->assertSame('twirl_php_framework_', Str::snake('TwirlPhpFramework_', '_'));
		$this->assertSame('twirl_php_framework', Str::snake('twirl php Framework'));
		$this->assertSame('twirl_php_frame_work', Str::snake('twirl php FrameWork'));
		// prevent breaking changes
		$this->assertSame('foo-bar', Str::snake('foo-bar'));
		$this->assertSame('foo-_bar', Str::snake('Foo-Bar'));
		$this->assertSame('foo__bar', Str::snake('Foo_Bar'));
		$this->assertSame('żółtałódka', Str::snake('ŻółtaŁódka'));
	}

	public function testStudly(): void
	{
		$this->assertSame('TwirlPHPFramework', Str::studly('twirl_p_h_p_framework'));
		$this->assertSame('TwirlPhpFramework', Str::studly('twirl_php_framework'));
		$this->assertSame('TwirlPhPFramework', Str::studly('twirl-phP-framework'));
		$this->assertSame('TwirlPhpFramework', Str::studly('twirl  -_-  php   -_-   framework   '));

		$this->assertSame('FooBar', Str::studly('fooBar'));
		$this->assertSame('FooBar', Str::studly('foo_bar'));
		$this->assertSame('FooBar', Str::studly('foo_bar')); // test cache
		$this->assertSame('FooBarBaz', Str::studly('foo-barBaz'));
		$this->assertSame('FooBarBaz', Str::studly('foo-bar_baz'));
	}

	public function testUpper(): void
	{
		$this->assertSame('FOO BAR BAZ', Str::upper('foo bar baz'));
		$this->assertSame('FOO BAR BAZ', Str::upper('foO bAr BaZ'));
	}

}
