<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MyOrder extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static string $view = 'filament.pages.my-order';
    protected static ?string $navigationGroup = 'Pembelian';
    protected static ?int $navigationSort = 1; 

}
