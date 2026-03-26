<?php

namespace App\Filament\Employee\Resources\LeaveRequests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(Auth::id()),
                Select::make('type')
                    ->options([
                        'vacation' => 'Vacation',
                        'sick' => 'Sick Leave',
                        'personal' => 'Personal',
                        'unpaid' => 'Unpaid',
                    ])
                    ->required()
                    ->native(false),
                DatePicker::make('start_date')->required(),
                DatePicker::make('end_date')->required()->afterOrEqual('start_date'),
                Textarea::make('notes')
                    ->label('Additional Notes')
                    ->nullable()
                    ->rows(3),
            ]);
    }
}
