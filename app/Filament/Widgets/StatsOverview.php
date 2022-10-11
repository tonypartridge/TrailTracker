<?php

namespace App\Filament\Widgets;

use App\Models\Events;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Future Events', Events::where('endDateTime', '>', date('Y-m-d 23:59:59'))->count()),
            Card::make('Past Events', Events::where('endDateTime', '<', date('Y-m-d 23:59:59'))->count()),
        ];
    }
}
