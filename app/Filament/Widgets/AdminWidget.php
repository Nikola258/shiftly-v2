<?php

namespace App\Filament\Widgets;

use App\Models\Data;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidget extends StatsOverviewWidget
{
    protected function getStats(): array {
        return [
            Stat::make('Projects', Project::query()->count())
        ];
    }
}
