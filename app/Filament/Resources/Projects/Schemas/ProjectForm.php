<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('task')
                    ->required()
                    ->maxLength(255),
                
                Select::make('employee')
                    ->label('Employee')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                
                Toggle::make('activity')
                    ->label('Active')
                    ->default(true)
                    ->inline(false),
            ]);
    }
}
