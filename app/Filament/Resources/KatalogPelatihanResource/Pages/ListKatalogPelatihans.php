<?php

namespace App\Filament\Resources\KatalogPelatihanResource\Pages;

use App\Filament\Resources\KatalogPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKatalogPelatihans extends ListRecords
{
    protected static string $resource = KatalogPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
