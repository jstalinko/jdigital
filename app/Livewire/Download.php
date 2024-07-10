<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Order;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Download extends Component implements HasForms,HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    
    public function render()
    {
        return view('livewire.download');
    }
    public function table(Table $table)
    {
        return $table->query(Order::where('user_id' , auth()->user()->id)->where('status','paid'))
        ->columns([
            Tables\Columns\TextColumn::make('product.name'),
            Tables\Columns\TextColumn::make('product.updated_at'),
        ]);
    }
}
