<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Illuminate\Support\Carbon;

// -----------------
// Content

if (!function_exists('moment')) {
	function moment(mixed $value, DateTimeZone|string|int|null $timezone = null): Carbon
	{
		return new Carbon($value, $timezone);
	}
}