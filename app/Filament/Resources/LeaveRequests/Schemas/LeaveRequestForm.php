<?php

namespace App\Filament\Resources\LeaveRequests\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Employee')
                    ->options(User::where('role', 'employee')->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->native(false),
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
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required()
                    ->native(false),
                Textarea::make('notes')->nullable()->rows(3),
                Textarea::make('rejection_reason')->nullable()->rows(2),
            ]);
    }
}
