<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                TextInput::make('nama_pemesanan')
                    ->label('Nama Pemesanan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('no_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->tel()
                    ->columnSpanFull()
                    ->maxLength(20),
                Forms\Components\DatePicker::make('day_start')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->displayFormat('d F Y')
                    ->maxDate(now()->addYear()),
                Forms\Components\DatePicker::make('day_end')
                    ->label('Tanggal Selesai')
                    ->required()
                    ->displayFormat('d F Y')
                    ->maxDate(now()->addYear()),
                Forms\Components\FileUpload::make('proof')
                    ->label('Bukti Pembayaran')
                    ->required()
                    ->image()
                    ->directory('proofs')
                    ->preserveFilenames()
                    ->maxSize(1024 * 5)
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpanFull(),
                Forms\Components\Select::make('products_id')
                    ->label('Produk')
                    ->relationship('product', 'nama_products')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
