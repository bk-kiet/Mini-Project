<?php

namespace App\Filament\Resources\ItemBundleResource\Pages;

use App\Filament\Resources\ItemBundleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemBundles extends ListRecords
{
    protected static string $resource = ItemBundleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
