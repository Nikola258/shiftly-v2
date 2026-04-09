<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Models\Project;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Project Name')
                    ->required()
                    ->maxLength(255),

                Select::make('task')
                    ->label('Task')
                    ->options([
                        'recruitment' => 'Recruitment',
                        'onboarding' => 'Onboarding',
                        'training' => 'Training & Development',
                        'performance_review' => 'Performance Review',
                        'payroll' => 'Payroll Processing',
                        'benefits_admin' => 'Benefits Administration',
                        'employee_relations' => 'Employee Relations',
                        'compliance' => 'Compliance & Policy',
                        'offboarding' => 'Offboarding',
                        'attendance' => 'Attendance Management',
                        'leave_management' => 'Leave Management',
                        'documentation' => 'Documentation',
                        'other' => 'Other',
                    ])
                    ->searchable()
                    ->required(),

                Select::make('employee')
                    ->label('Employee')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Toggle::make('activity')
                    ->label('Active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Project Name')->sortable()->searchable(),
                TextColumn::make('task')->sortable()->searchable(),
                TextColumn::make('employee')
                    ->formatStateUsing(fn ($state) => User::find($state)?->name ?? 'N/A')
                    ->sortable(),
                IconColumn::make('activity')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
