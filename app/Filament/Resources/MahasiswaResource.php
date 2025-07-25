<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationLabel = 'Data Mahasiswa';
    
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama'),
                Forms\Components\TextInput::make('nim')
                                        ->numeric()
                                        ->step(9),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('angkatan')
                                        ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('angkatan'),
            ])
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),

                SelectFilter::make('angkatan')
                    ->label('Angkatan')
                    ->options(
                        fn () => \App\Models\Mahasiswa::query()
                            ->select('angkatan')
                            ->distinct()
                            ->pluck('angkatan', 'angkatan')
                            ->toArray()
                    ),
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Akademik';
    }

    
}
