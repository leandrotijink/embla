<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Fluent;

class Tab extends Fluent
{
	public static function route(string $name, array $parameters = []): static
	{
		return new static(['route' => new Fluent(['name' => $name, 'parameters' => $parameters])]);
	}

	public function label(string $label): static
	{
		return $this->set('label', $label);
	}

	public function badge($text = null, $args = []): static
	{
		return $this->set('badge', new Fluent([
			'text' => $text,
			'args' => $args
		]));
	}
}