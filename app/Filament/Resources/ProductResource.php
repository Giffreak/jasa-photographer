<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Dom\Text;
use Faker\Core\File;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Mask;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
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
                TextInput::make('nama_products')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),
                TextInput::make('totalPrice')
                    ->label('Total Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp ')
                    ->maxLength(20),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->maxLength(1000)
                    ->columnSpanFull(),
                FileUpload::make('thumbnails')
                    ->label('Gambar Produk')
                    ->image()
                    ->preserveFilenames()
                    ->required()
                    ->maxSize(1024 * 5)
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_products')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('totalPrice')
                    ->label('Total Harga')
                    ->searchable()
                    ->sortable()
                    ->numeric()
                    ->prefix('Rp '),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
