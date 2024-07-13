<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected  function mutateFormDataBeforeCreate(array $data): array
    {
        $parseAssetId = Str::afterLast($data['product_file'] , '/');
        $data['slug'] = Str::slug($data['name']);
        $data['active'] = true;
        $data['github_data'] = json_encode(['repo' => $data['github_repo'] , 'release_id' => $data['release_id'] , 'asset_id' => $parseAssetId ]);
        return $data;
    }
}
