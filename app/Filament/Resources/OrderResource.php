<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Orders';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                TextInput::make('nama_pemesan')
                    ->label('Nama Pemesan')
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
                ToggleButtons::make('proof')
                                ->label('Approve?')
                                ->boolean()
                                ->grouped()
                                ->required()
                                ->icons([
                                    true=> 'heroicon-o-pencil',
                                    false=> 'heroicon-o-clock',
                                ]),
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
                Tables\Columns\TextColumn::make('product.nama_products')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pemesan')
                    ->label('Nama Pemesan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor HP')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_start_formatted')
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('day_end_formatted')
                    ->label('Tanggal Selesai'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->action(function (Order $record){
                    $record->proof = true;
                    $record->save();

                    Notification::make()
                    ->title('Order Approved')
                    ->success()
                    ->body('The Order has ben succefully approved.')
                    ->send();
                })
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (Order $record) => !$record->proof),
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
