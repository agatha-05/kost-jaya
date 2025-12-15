<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Models\BoardingHouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Manajemen Kost';
    protected static ?string $navigationLabel = 'Boarding House';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Boarding House Tabs')
            ->tabs([
            // =======================
            // TAB 1 : Informasi Umum
            // =======================
            Forms\Components\Tabs\Tab::make('Informasi Umum')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->image()
                        ->directory('boarding-houses')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->debounce(300)
                        ->reactive()
                        ->afterStateUpdated(fn ($state, $set) => 
                            $set('slug', Str::slug($state))
                        ),

                    Forms\Components\TextInput::make('slug')
                        ->required(),

                    Forms\Components\Select::make('city_id')
                        ->relationship('city', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->prefix('Rp ')
                        ->required(),

                    Forms\Components\Textarea::make('address')
                        ->required()
                        ->columnSpanFull(),
                ]),

            // =======================
            // TAB 2 : Bonus Ngekos
            // =======================
            Forms\Components\Tabs\Tab::make('Bonus Ngekos')
                ->icon('heroicon-o-gift')
                ->schema([
                    Forms\Components\Repeater::make('bonuses')
                        ->relationship('bonuses')
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                                ->image()
                                ->directory('bonuses')
                                ->required(),

                            Forms\Components\TextInput::make('name')
                                ->required(),

                            Forms\Components\TextInput::make('description')
                                ->required(),
                        ])
                        ->columnSpanFull()
                ]),

            // =======================
            // TAB 3 : Kamar
            // =======================
            Forms\Components\Tabs\Tab::make('Kamar')
                ->icon('heroicon-o-home-modern')
                ->schema([
            Forms\Components\Repeater::make('rooms')
                ->relationship('rooms')
                ->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('room_type')->required(),
            Forms\Components\TextInput::make('square_feet')->numeric()->required(),
            Forms\Components\TextInput::make('capacity')->numeric()->required(),
            Forms\Components\TextInput::make('price_per_month')
                ->numeric()
                ->prefix('Rp ')
                ->required(),
            Forms\Components\Toggle::make('is_available')->required(),

            Forms\Components\Repeater::make('roomImages')
                ->relationship('roomImages')
                ->schema([
            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('room-images')
                ->required(),
                ])
            ])
            ->columnSpanFull()
                ]),
        ])
        ->columnSpanFull()

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular()
                    ->label('Thumbnail'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city.name')
                    ->label('Kota')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('idr', true)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city_id')
                    ->relationship('city', 'name')
                    ->label('Filter Kota'),

                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori'),
            ])
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
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
