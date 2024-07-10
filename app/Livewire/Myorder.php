<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class Myorder extends Component implements HasForms,HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    //use \Filament\Forms\Concerns\InteractsWithForms;
    public function render(): View
    {
        return view('livewire.myorder');
    }
    public function table(Table $table)
    {
        return $table->query(Order::where('user_id',auth()->user()->id))
        ->columns([
            Tables\Columns\TextColumn::make('invoice')->url(fn (string $state) => url('/invoice/'.$state) , true),
            Tables\Columns\TextColumn::make('product.name'),
            Tables\Columns\TextColumn::make('payment_method_code'),
            Tables\Columns\TextColumn::make('total'),
            Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                'unpaid' => 'warning',
                'paid' => 'success',
                'cancelled' => 'danger',
                'expired' => 'gray',
            })
        ])
        ->filters([
            
        ])
        ->actions([
            // ...
        ])
        ->bulkActions([
            // ...
        ]);
    }
}
