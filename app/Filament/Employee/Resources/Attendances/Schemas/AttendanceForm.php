<?php

namespace App\Filament\Employee\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->required()
                    ->default(today())
                    ->disabled(),

                TimePicker::make('clock_in')
                    ->label('Clock In')
                    ->disabled(),

                TimePicker::make('clock_out')
                    ->label('Clock Out')
                    ->disabled(),
            ]);
    }
}
