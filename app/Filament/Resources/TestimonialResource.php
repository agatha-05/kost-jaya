<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Manajemen Kost';
    protected static ?string $navigationLabel = 'Testimoni Pengguna';
    protected static ?string $pluralModelLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Testimoni')
                    ->description('Pastikan foto, rating, dan isi testimoni sesuai agar kredibilitas terjaga.')
                    ->icon('heroicon-o-star')
                    ->columns(2)
                    ->schema([

                        /** FOTO USER */
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto Pengguna')
                            ->image()
                            ->avatar()
                            ->imageEditor()
                            ->directory('testimonials')
                            ->required()
                            ->columnSpan(1),

                        /** FORM KANAN */
                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([

                                Forms\Components\Select::make('boarding_house_id')
                                    ->label('Kost Terkait')
                                    ->relationship('boardingHouse', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Pengguna')
                                    ->required(),

                                Forms\Components\TextInput::make('rating')
                                    ->label('Rating (1–5)')
                                    ->numeric()
                                    ->required()
                                    ->minValue(1)
                                    ->maxValue(5),

                                Forms\Components\Textarea::make('content')
                                    ->label('Isi Testimoni')
                                    ->required()
                                    ->rows(4),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                /** FOTO - circular besar */
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->size(50, 50),

                /** NAMA */
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->limit(30),

                /** NAMA KOST */
                Tables\Columns\TextColumn::make('boardingHouse.name')
                    ->label('Kost')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-home')
                    ->color('info')
                    ->limit(30),

                /** RATING */
                Tables\Columns\TextColumn::make('rating')
                    ->badge()
                    ->colors([
                        'success' => fn ($state) => $state >= 4,
                        'warning' => fn ($state) => $state == 3,
                        'danger' => fn ($state) => $state <= 2,
                    ]),

                /** KONTEN TESTIMONI */
                Tables\Columns\TextColumn::make('content')
                    ->label('Testimoni')
                    ->limit(50)
                    ->toggleable(),

                /** CREATED AT */
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(),

                /** UPDATED AT */
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->since()
                    ->sortable()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            /** FILTER */
            ->filters([
                Tables\Filters\SelectFilter::make('boarding_house_id')
                    ->label('Filter Kost')
                    ->relationship('boardingHouse', 'name'),

                Tables\Filters\SelectFilter::make('rating')
                    ->label('Filter Rating')
                    ->options([
                        5 => '★★★★★',
                        4 => '★★★★',
                        3 => '★★★',
                        2 => '★★',
                        1 => '★',
                    ]),
            ])

            /** ACTIONS */
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])

            /** BULK ACTION */
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])

            /** DEFAULT SORT */
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
