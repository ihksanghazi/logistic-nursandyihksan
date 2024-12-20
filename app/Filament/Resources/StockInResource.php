<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockInResource\Pages;
use App\Filament\Resources\StockInResource\RelationManagers;
use App\Models\StockIn;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockInResource extends Resource
{
    protected static ?string $model = StockIn::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_barang')
                    ->required()
                    ->maxLength(255),
                TextInput::make('no_barang_masuk')
                    ->required()
                    ->maxLength(255),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('origin')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('tanggal_masuk')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->searchable(),
                TextColumn::make('no_barang_masuk')
                    ->searchable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('origin')
                    ->searchable(),
                TextColumn::make('tanggal_masuk')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListStockIns::route('/'),
            'create' => Pages\CreateStockIn::route('/create'),
            'edit' => Pages\EditStockIn::route('/{record}/edit'),
        ];
    }
}
