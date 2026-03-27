<?php

namespace App\Filament\Resources\Attendances\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Employee')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                DatePicker::make('date')
                    ->required()
                    ->default(now()),

                TimePicker::make('clock_in')
                    ->label('Clock In'),

                TimePicker::make('clock_out')
                    ->label('Clock Out'),

                Select::make('status')
                    ->options([
                        'present' => 'Present',
                        'absent' => 'Absent',
                        'late' => 'Late',
                        'half_day' => 'Half Day',
                    ])
                    ->required()
                    ->default('present'),

                Textarea::make('notes')
                    ->rows(3),
            ]);
    }
}
