<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverviewUser extends BaseWidget
{
    public static function canView(): bool
    {
        // Check if the user has a specific role or permission
        return auth()->user()->hasRole('panel_user') || auth()->user()->can('view_my_widget');
    }

    protected function getStats(): array
    {
        return [
            Stat::make('My Order' , Order::where('user_id' , auth()->user()->id)->count()),
            Stat::make('My Project',Project::where('user_id' , auth()->user()->id)->count()),
            Stat::make('Level', Order::userLevel(auth()->user()->id)),
        ];
    }
}
