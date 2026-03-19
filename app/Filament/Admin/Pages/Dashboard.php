<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\AdminWidget;

class Dashboard extends Page
{
    protected string $view = 'filament.admin.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            AdminWidget::class,
        ];
    }
}
