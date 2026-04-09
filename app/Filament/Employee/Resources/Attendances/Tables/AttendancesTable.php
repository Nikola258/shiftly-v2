<?php

namespace App\Filament\Employee\Resources\Attendances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\Attendance::where('user_id', Auth::id())
            )
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),

                TextColumn::make('clock_in')
                    ->time()
                    ->label('Clock In'),

                TextColumn::make('clock_out')
                    ->time()
                    ->label('Clock Out'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'present' => 'success',
                        'late' => 'warning',
                        'half_day' => 'info',
                        'absent' => 'danger',
                    }),
            ])
            ->defaultSort('date', 'desc')
            ->recordActions([])
            ->toolbarActions([]);
    }
}
