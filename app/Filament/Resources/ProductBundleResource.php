<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductBundleResource\Pages;
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
                    ->label('Bundle SKU') ->unique()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Repeater::make('Products')
                    ->label('Products')
                    ->schema([

                Forms\Components\Select::make('product_bundles_id')

                    ->label('Select Bundles')
                    //->multiple() // Allow selecting multiple bundles
                    ->relationship('products', 'name') // Assuming 'name' is a field in the ItemBundle model
                    ->searchable() // Allow searching through bundles
                    ->preload()
                    ->required()


                    ->reactive() // Make it reactive to watch for changes
                    ->afterStateUpdated(function ($state, callable $set , callable $get) { // Get the product price when a product is selected
                        if ($state) { //checking if the product is selected or not
                            //$state = Current value of the field
                            //$set =  function that lets you update other fields' values
                            $product = \App\Models\Product::find($state);
                            if ($product) {
                                $set('product_bundles_price', $product->price );

                            }

                        }
                    }),

                        Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required()
                            ->rules(['required', 'min:1'])
                            ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        // Get the price and calculate total here
                        $price = floatval($get('product_bundles_price'));
                        if ($price && $state) {
                            $total = $price * (int)$state;
                            $set('total_price', number_format($total, 2));
                        }
                    }),

                Forms\Components\TextInput::make('product_bundles_price')
                    ->label('(RM)Price'),

                        Forms\Components\TextInput::make('total_price')
                            ->label('(RM)Total Price')
                            ->disabled()//field cannot be edited
                          //  ->dehydrated(false),//this field won't be saved to the database

            ])
            ])
                        // column 1 this columns make every section all in one straight line
            ->columns(2); // column 2 make the section in row
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Bundle SKU')
                    ->searchable(),


                Tables\Columns\TextColumn::make('products.name')
                    ->label('Bundle Item')
                    ->badge()
                    ->searchable()
                    ->sortable(),



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
            'index' => Pages\ListProductBundles::route('/'),
            'create' => Pages\CreateProductBundle::route('/create'),
            'edit' => Pages\EditProductBundle::route('/{record}/edit'),
        ];
    }
}
