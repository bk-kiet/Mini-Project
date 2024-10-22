<?php

namespace App\Filament\Resources\ItemBundleResource\Pages;

use App\Filament\Resources\ProductBundleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateItemBundle extends CreateRecord
{
    protected static string $resource = ProductBundleResource::class;
}
