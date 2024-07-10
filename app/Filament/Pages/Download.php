<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Download extends Page
{
    protected static ?string $navigationIcon = 'heroicon-c-cloud-arrow-down';

    protected static string $view = 'filament.pages.download';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Pembelian';
}
