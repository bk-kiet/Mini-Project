<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('main data')
                  //  ->description('Phone brand')
                     ->label('Main data')
                    ->heading(__('Brand'))

                    ->schema([              //ADD FORM COMPONENT

                        Forms\Components\TextInput::make('name')
                                ->label(__('Product name'))
                                ->required(),

                        Forms\Components\TextInput::make('sku')
                            ->label(__('Product SKU'))
                            ->required(),


                         Forms\Components\Select::make('category_id')  // Reference the foreign key field
                                ->label('Category')
                                ->relationship('category', 'name')  // Pulls the category name from the Category model
                                ->required(),


/*                            //example that you put ->columnSpan(2)  < mean make full width which form section you want.
                            Forms\Components\RichEditor::make('description')
                                ->columnSpanFull()*/

/*                            Forms\Components\Select::make('item_bundles')
                                ->label('Select Bundles')
                                ->multiple() // Allow selecting multiple bundles
                                ->relationship('itemBundles', 'name') // Assuming 'name' is a field in the ItemBundle model
                                ->searchable() // Allow searching through bundles
                                ->preload(),*/

                            ])
            ])
                        //this columns make every section all in one straight line
                    ->columns(1);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(components: array(

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Product name'))
                    ->searchable(),
                    //->rules(['required', 'min:3']),
                Tables\Columns\TextColumn::make('sku')
                    ->label(__('Product SKU'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),


            ))


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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
