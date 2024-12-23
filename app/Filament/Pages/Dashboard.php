<?php

namespace App\Filament\Pages;

use App\Models\Stock;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            Section::make('')->schema([
                Select::make('kode_barang')
                    ->label('Nama Barang')
                    ->options(Stock::all()->pluck('nama_barang', 'kode_barang'))
                    ->searchable(),
                DatePicker::make('start_date')
                    ->label("Tanggal Mulai"),
                DatePicker::make('end_date')
                    ->label("Tanggal Akhir"),
            ])->columns(3)
        ]);
    }
}
