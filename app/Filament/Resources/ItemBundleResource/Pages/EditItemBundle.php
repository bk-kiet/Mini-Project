<?php

namespace App\Filament\Resources\ItemBundleResource\Pages;

use App\Filament\Resources\ItemBundleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemBundle extends EditRecord
{
    protected static string $resource = ItemBundleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
