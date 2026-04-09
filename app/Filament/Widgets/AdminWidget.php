<?php

namespace App\Filament\Widgets;

use App\Models\Data;
use App\Models\Project;
use App\Models\Client;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidget extends StatsOverviewWidget
{
    protected function getStats(): array {
        return [
            Stat::make('Total Projects', Project::query()->count()),
            Stat::make('Active Projects', Project::query()->count()),
            Stat::make('Total Clients', Client::query()->count()),
            Stat::make('Closed Clients', Client::query()->count())
        ];
    }
}
