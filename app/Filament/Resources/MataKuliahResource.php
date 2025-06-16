<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MataKuliahResource\Pages;
use App\Filament\Resources\MataKuliahResource\RelationManagers;
use App\Models\MataKuliah;
use App\Models\Role;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MataKuliahResource extends Resource
{
    protected static ?string $model = MataKuliah::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                                        ->required(),
                Forms\Components\TextInput::make('kode')
                                        ->required(),
                Forms\Components\TextInput::make('semester')
                                        ->required(),
                Forms\Components\TextInput::make('sks')
                                        ->numeric()
                                        ->required(),
                Forms\Components\Textarea::make('deskripsi')
                                        ->required(),
                Select::make('dosen')
                    ->relationship('dosen', 'nama') // 'name' adalah kolom yang ditampilkan
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->columnSpanFull()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi'),
                TextColumn::make('dosen.nama')
                ->listWithLineBreaks()
                ->limitList(3)
                ->expandableLimitedList(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(function () {
                        $user = Filament::auth()->user();  
                        if($user->role_id == Role::ADMIN){
                            return true;
                        }
                        
                    })
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
            'index' => Pages\ListMataKuliahs::route('/'),
            'create' => Pages\CreateMataKuliah::route('/create'),
            'edit' => Pages\EditMataKuliah::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Akademik';
    }
}
