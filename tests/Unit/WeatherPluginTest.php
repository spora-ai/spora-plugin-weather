<?php

declare(strict_types=1);

use Spora\Plugins\Weather\Tools\WeatherApiTool;
use Spora\Plugins\Weather\WeatherPlugin;

it('returns plugin name', function () {
    $plugin = new WeatherPlugin();
    expect($plugin->getName())->toBe('Weather');
});

it('contributes the WeatherApiTool', function () {
    $plugin = new WeatherPlugin();
    expect($plugin->tools())->toBe([WeatherApiTool::class]);
});
