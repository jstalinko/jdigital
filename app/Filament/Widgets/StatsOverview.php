<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Members' , User::count()),
            Stat::make('Products',  Product::count()),
            

        ];
    }
}
