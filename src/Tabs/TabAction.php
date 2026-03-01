<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Conditionable;

class TabAction extends Fluent
{
	use Conditionable;

	// -----------------

	public static function route(string $name, array $parameters = []): static
	{
		return new static(['route' => new Fluent(['name' => $name, 'parameters' => $parameters])]);
	}

	public function icon(string $icon): static
	{
		return $this->set('icon', $icon);
	}
}