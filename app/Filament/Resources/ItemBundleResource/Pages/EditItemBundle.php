<?php

namespace App\Filament\Resources\ItemBundleResource\Pages;

use App\Filament\Resources\ProductBundleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemBundle extends EditRecord
{
    protected static string $resource = ProductBundleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
