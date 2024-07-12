<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['deal_bid'] = 0;
        $data['notes'] = '-';
        $data['user_id'] = auth()->user()->id;
        $data['payment_status'] = 'unpaid';
        $data['project_status'] = 'applied';

        return $data;
    }
}
