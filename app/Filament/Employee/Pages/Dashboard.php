<?php

namespace App\Filament\Employee\Pages;

use App\Models\Attendance;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Page
{
    protected string $view = 'filament.employee.pages.dashboard';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('clock_in')
                ->label('Clock In')
                ->color('success')
                ->icon('heroicon-o-play')
                ->visible(fn () => !Attendance::where('user_id', Auth::id())->whereDate('date', today())->whereNull('clock_out')->exists())
                ->action(function () {
                    Attendance::create([
                        'user_id' => Auth::id(),
                        'date' => today(),
                        'clock_in' => now()->format('H:i:s'),
                        'status' => 'present',
                    ]);
                    Notification::make()->success()->title('Clocked in at ' . now()->format('H:i'))->send();
                }),

            Action::make('clock_out')
                ->label('Clock Out')
                ->color('danger')
                ->icon('heroicon-o-stop')
                ->visible(fn () => Attendance::where('user_id', Auth::id())->whereDate('date', today())->whereNull('clock_out')->exists())
                ->action(function () {
                    $today = Attendance::where('user_id', Auth::id())
                        ->whereDate('date', today())
                        ->whereNull('clock_out')
                        ->latest()
                        ->first();

                    $clockIn = \Carbon\Carbon::parse($today->clock_in);
                    $clockOut = now();

                    $status = match(true) {
                        $clockIn->format('H:i') > '09:00' => 'late',
                        $clockIn->diffInHours($clockOut) < 5 => 'half_day',
                        default => 'present',
                    };

                    $today->update([
                        'clock_out' => $clockOut->format('H:i:s'),
                        'status' => $status,
                    ]);
                    Notification::make()->success()->title('Clocked out at ' . $clockOut->format('H:i'))->send();
                }),
        ];
    }
}
