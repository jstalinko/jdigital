<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Order;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        // Check if the user has a specific role or permission
        return auth()->user()->hasRole('super_admin') || auth()->user()->can('view_my_widget');
    }
    
    protected function getStats(): array
    {
        return [
            Stat::make('Members' , User::count()),
            Stat::make('Products',  Product::count()),
            Stat::make('Orders',Order::count()),
            Stat::make('Income',Order::where('status','paid')->sum('amount'))
        ];
    }
}
