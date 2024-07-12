<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Product;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecommendedProductUserWidget extends BaseWidget
{
    protected static ?int $sort = 3; 
    protected int | string | array $columnSpan = 'full';
    protected  function getTableHeading(): string
    {
        return 'Rekomendasi Produk Untuk Anda';
    }
    public static function canView(): bool
    {
        // Check if the user has a specific role or permission
        return auth()->user()->hasRole('panel_user') || auth()->user()->can('view_my_widget');
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query()->orderBy('views','desc')->limit(5))
            ->columns([
                TextColumn::make('name')->label('Nama Item'),
                TextColumn::make('price')->label('Harga')->money('IDR'),
                TextColumn::make('category.name')->label('Kategori')
            ])->actions([
                Action::make('Beli')->action(function(Product $product){
                    return redirect()->to('/product/checkout/'.$product->slug);
                })->icon('heroicon-s-shopping-cart')->color('success'),
                Action::make('Detail')->action(function(Product $product){
                    return redirect()->to('/product/'.$product->slug);
                })->icon('heroicon-o-list-bullet')->color('primary')
            ]);
    }
  
}
