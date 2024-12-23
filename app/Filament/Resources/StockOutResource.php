<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockOutResource\Pages;
use App\Filament\Resources\StockOutResource\RelationManagers;
use App\Models\Stock;
use App\Models\StockOut;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class StockOutResource extends Resource
{
    protected static ?string $model = StockOut::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';

    protected static ?string $navigationLabel = 'Barang Keluar';

    protected static ?string $label = 'Barang Keluar';

    protected static ?string $navigationGroup = 'Kelola Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kode_barang')
                    ->label('Nama Barang')
                    ->options(Stock::all()->pluck('nama_barang', 'kode_barang'))
                    ->disabledOn('edit')
                    ->searchable(),
                TextInput::make('quantity')
                    ->required()
                    ->disabledOn('edit')
                    ->numeric(),
                TextInput::make('destination')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('tanggal_keluar')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->rowIndex(),
                TextColumn::make('stock.nama_barang')
                    ->label('Nama Barang')
                    ->copyable()
                    ->copyMessage('tercopy')
                    ->searchable(),
                TextColumn::make('no_barang_keluar')
                    ->copyable()
                    ->copyMessage('tercopy')
                    ->searchable(),
                TextColumn::make('kode_barang')
                    ->copyable()
                    ->copyMessage('tercopy')
                    ->searchable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('destination')
                    ->searchable(),
                TextColumn::make('tanggal_keluar')
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
                SelectFilter::make('stock')
                    ->relationship('stock', 'nama_barang')
                    ->label('Nama Barang')
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
            'index' => Pages\ListStockOuts::route('/'),
            'create' => Pages\CreateStockOut::route('/create'),
            'edit' => Pages\EditStockOut::route('/{record}/edit'),
        ];
    }
}
