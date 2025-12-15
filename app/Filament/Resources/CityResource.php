<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Cities';
    protected static ?string $pluralLabel = 'Kota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Detail cities')
                    ->description('Pastikan nama Cities dan Image sudah sesuai.')
                    ->icon('heroicon-o-map')
                    ->columns(2)
                    ->schema([

                        // FOTO
                        Forms\Components\FileUpload::make('image')
                            ->label('Image cities')
                            ->image()
                            ->imageEditor()
                            ->directory('cities')
                            ->required()
                            ->columnSpan(1)
                            ->avatar(),

                        // Kolom Nama & Slug
                        Forms\Components\Grid::make(1)
                            ->schema([

                                Forms\Components\TextInput::make('name')
                                    ->label('Nama cities')
                                    ->required()
                                    ->debounce(300)
                                    ->reactive()
                                    ->autofocus()
                                    ->afterStateUpdated(fn ($state, callable $set) =>
                                        $set('slug', Str::slug($state))
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (Otomatis)')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->helperText('Slug dibuat otomatis dari nama cities.'),

                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->size(45)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->color('primary')
                    ->weight('bold')
                    ->limit(40),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin!')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
