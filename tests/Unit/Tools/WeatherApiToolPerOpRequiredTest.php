<?php

declare(strict_types=1);

use Spora\Plugins\Weather\Tools\WeatherApiTool;
use Spora\Tools\Attributes\ToolParameter;

/**
 * Per-op `required[]` binding tests for WeatherApiTool.
 *
 * Reads `#[ToolParameter]` constructor arguments via reflection.
 * Independent of the bound spora-core version — once spora-core ships
 * the `bool|array $required` signature AND the plugin bumps its dep,
 * replace with `ToolParameterSchemaBuilder::build(WeatherApiTool::class)`.
 */
function weatherToolParameterArgs(string $name): array
{
    $reflection = new ReflectionClass(WeatherApiTool::class);
    foreach ($reflection->getAttributes(ToolParameter::class) as $attribute) {
        $args = $attribute->getArguments();
        if (($args['name'] ?? null) === $name) {
            return $args;
        }
    }

    throw new RuntimeException("ToolParameter '{$name}' not declared on " . WeatherApiTool::class);
}

it('binds location to current, forecast, astronomy', function () {
    $expected = ['current', 'forecast', 'astronomy'];
    $actual = weatherToolParameterArgs('location')['required'];
    sort($expected);
    sort($actual);
    expect($actual)->toBe($expected);
});

it('binds query to search only', function () {
    expect(weatherToolParameterArgs('query')['required'])->toBe(['search']);
});

it('binds days to forecast only', function () {
    expect(weatherToolParameterArgs('days')['required'])->toBe(['forecast']);
});

it('binds date to astronomy only', function () {
    expect(weatherToolParameterArgs('date')['required'])->toBe(['astronomy']);
});
