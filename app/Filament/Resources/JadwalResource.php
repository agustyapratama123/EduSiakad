<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalResource\Pages;
use App\Filament\Resources\JadwalResource\RelationManagers;
use App\Models\Jadwal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mata_kuliah_id')
                    ->relationship('mataKuliah', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Select::make('dosen_id')
                    ->relationship('dosen', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('ruang')
                    ->required()
                    ->maxLength(10),

                Forms\Components\Select::make('hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->required(),

                Forms\Components\TimePicker::make('jam_mulai')
                    ->required()
                    ->seconds(false),

                Forms\Components\TimePicker::make('jam_selesai')
                    ->required()
                    ->seconds(false),

                Forms\Components\TextInput::make('semester')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(14),

                Forms\Components\TextInput::make('tahun_ajaran')
                    ->required()
                    ->placeholder('2023/2024')
                    ->maxLength(9),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mataKuliah.nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('dosen.nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('ruang')
                    ->searchable(),

                Tables\Columns\TextColumn::make('hari')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jam_mulai')
                    ->time(),

                Tables\Columns\TextColumn::make('jam_selesai')
                    ->time(),

                Tables\Columns\TextColumn::make('semester'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        1 => 'Semester 1',
                        2 => 'Semester 2',
                        3 => 'Semester 3',
                        4 => 'Semester 4',
                        5 => 'Semester 5',
                        6 => 'Semester 6',
                        7 => 'Semester 7',
                        8 => 'Semester 8',
                        9 => 'Semester 9',
                        10 => 'Semester 10',
                    ]),
                
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
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Akademik';
    }
}
