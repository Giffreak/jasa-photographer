<?php

namespace App\Filament\Resources\ProductsGalleryResource\Pages;

use App\Filament\Resources\ProductsGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductsGalleries extends ListRecords
{
    protected static string $resource = ProductsGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
