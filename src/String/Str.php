<?php
declare(strict_types=1);

namespace Twirl\String;

use Twirl\String\Traits\Convert;
use Twirl\String\Traits\Extract;
use Twirl\String\Traits\Html;
use Twirl\String\Traits\Limit;
use Twirl\String\Traits\Replace;
use Twirl\String\Traits\Test;

/**
 * Class Str
 *
 * @package Twirl\String
 */
class Str
{

	use Convert;

	use Extract;

	use Html;

	use Limit;

	use Replace;

	use Test;
}
