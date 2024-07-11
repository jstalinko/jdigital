<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Order;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Download extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function render()
    {
        return view('livewire.download');
    }
    public function table(Table $table)
    {
        return $table->query(Order::where('user_id', auth()->user()->id)->where('status', 'paid'))
            ->columns([
                Tables\Columns\TextColumn::make('invoice')->label('Invoice')->url(fn ($state) => url('/invoice/' . $state)),
                Tables\Columns\TextColumn::make('product.name')->label('Nama Produk'),
                Tables\Columns\TextColumn::make('product.updated_at')->label('Update'),
            ])->actions([
                Action::make('download')
                    ->icon('heroicon-m-cloud-arrow-down')
                    ->action(function (Order $record) {
                        $productLink = $record->product->product_file;
                        $productLink = str_replace('{product_id}', $record->product->id, $productLink);
                        if ($record->product->product_type == 'file') {
                            $productLink = $productLink . '&sig=' . base64_encode($record->id);
                            return redirect()->to($productLink);
                        } elseif ($record->product->product_type == 'github') {
                            
                            return redirect()->to('/download/'.$record->product->id.'?file=github&sig='.base64_encode($record->id));
                        }
                    })
                    ->successNotificationTitle('Download started')
                    ->color('success')
            ]);
    }
}
