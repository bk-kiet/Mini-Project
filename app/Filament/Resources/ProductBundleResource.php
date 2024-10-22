<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemBundleResource\Pages;
use App\Models\ProductBundle;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductBundleResource extends Resource
{
    protected static ?string $model = ProductBundle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->label('Bundle SKU')
                    ->required()
                    ->maxLength(255),

                               //Repeater Form method
/*                Forms\Components\Repeater::make('items')
                    ->label('Items')
                    ->schema([
                        TextInput::make('name_bundle')
                            ->label('Item Name')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->minItems(1)
                    ->maxItems(10) // You can change this to allow more items
                    ->createItemButtonLabel('Add Item'),*/


                Forms\Components\Select::make('product_bundles')

                    ->label('Select Bundles')
                    //->multiple() // Allow selecting multiple bundles
                    ->relationship('products', 'name') // Assuming 'name' is a field in the ItemBundle model
                    ->searchable() // Allow searching through bundles
                    ->preload(),

                TextInput::make('quantity')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),


/*                Forms\Components\Select::make('product_bundles_price')
                    ->label('(RM)Price')
                    ->preload(),*/

            ])
                        //this columns make every section all in one straight line
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextInputColumn::make('name')
                    ->label('Bundle SKU')
                    ->searchable()
                    ->rules(['required', 'min:5']),

                Tables\Columns\TextColumn::make('products.name')
                    ->label('Bundle Item')
                    ->badge()
                    ->searchable(),

                /*                Tables\Columns\TextColumn::make('products.name')
                    ->label(__('Products'))
                    ->listWithLineBreaks()
                    ->searchable()
                    ->sortable(),*/

            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemBundles::route('/'),
            'create' => Pages\CreateItemBundle::route('/create'),
            'edit' => Pages\EditItemBundle::route('/{record}/edit'),
        ];
    }
}
