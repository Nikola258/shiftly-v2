<?php

namespace App\Filament\Widgets;

use App\Models\Data;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidget extends StatsOverviewWidget
{
    protected function getStats(): array {
        return [
            Stat::make('Tasks', Data::whereNotNull('task')->count())        ];
    }
}
