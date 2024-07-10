<?php

namespace App\Filament\Resources\RepositoriesResource\Pages;

use App\Filament\Resources\RepositoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRepositories extends ManageRecords
{
    protected static string $resource = RepositoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
