<?php

declare(strict_types=1);

namespace Spora\Plugins\Weather;

use Spora\Plugins\AbstractPlugin;
use Spora\Plugins\Weather\Tools\WeatherApiTool;

/**
 * WeatherAPI.com current conditions and forecasts for Spora agents.
 */
final class WeatherPlugin extends AbstractPlugin
{
    public function getName(): string
    {
        return 'Weather';
    }

    /** @return array<class-string<\Spora\Tools\ToolInterface>> */
    public function tools(): array
    {
        return [
            WeatherApiTool::class,
        ];
    }
}
