<?php

namespace App\Filament\Resources\ProductBundleResource\Pages;

use App\Filament\Resources\ProductBundleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductBundle extends CreateRecord
{
    protected static string $resource = ProductBundleResource::class;
    protected function afterCreate(): void
    {
        // Get the repeater data
        $products = $this->data['Products'] ?? [];  // Matches your repeater name 'Products'

        foreach ($products as $item) {
            // Ensure quantity is at least 1
            $quantity = max(1, intval($item['quantity']));

            $this->record->products()->attach(
                $item['product_bundles_id'],
                [
                    'quantity' => $quantity
                ]
            );
        }
    }

}
