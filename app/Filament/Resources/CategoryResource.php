<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'category';
    protected static ?string $pluralModelLabel = 'Kategori';

    /* -----------------------------
       FORM (UPGRADED)
    ----------------------------- */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Informasi Kategori')
                    ->description('Isi detail kategori secara lengkap dan akurat.')
                    ->icon('heroicon-o-rectangle-stack')
                    ->columns(2)
                    ->schema([

                        // Upload + image preview hover
                        Forms\Components\FileUpload::make('image')
                            ->label('image')
                            ->image()
                            ->previewable(true)
                            ->imageEditor()
                            ->directory('categories')
                            ->required()
                            ->avatar()
                            ->columnSpan(1),

                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Kategori')
                                    ->required()
                                    ->reactive()
                                    ->debounce(300)
                                    ->afterStateUpdated(fn($state, $set) => 
                                        $set('slug', Str::slug($state))
                                    )
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->required()
                                    ->helperText('Slug otomatis mengikuti nama kategori.'),

                            ]),
                    ]),

            ]);
    }

    /* -----------------------------
       TABLE (SUPER UPGRADED)
    ----------------------------- */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                // FOTO
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->size(45)
                    ->circular()
                    ->extraAttributes([
                        'class' => 'transition hover:scale-110 duration-150',
                    ]),

                // NAMA (dengan badge warna)
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->weight('bold')
                    ->extraAttributes(['class' => 'text-base']),

                // SLUG (copyable)
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->copyMessage('Slug disalin!')
                    ->toggleable(isToggledHiddenByDefault: true),

                // 🔥 Jumlah relasi (opsional, kalau model punya relasi)
                Tables\Columns\TextColumn::make('boarding_houses_count')
                    ->label('Jumlah Kost')
                    ->counts('boardingHouses')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                // WAKTU
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->toggleable(),

            ])

            /* ------- FILTER -------- */
            ->filters([
                Tables\Filters\Filter::make('created_today')
                    ->label('Dibuat Hari Ini')
                    ->query(fn($query) =>
                        $query->whereDate('created_at', today())
                    ),

                Tables\Filters\Filter::make('recent')
                    ->label('7 Hari Terakhir')
                    ->query(fn($query) =>
                        $query->where('created_at', '>=', now()->subDays(7))
                    ),
            ])

            /* -------- ACTIONS (UPGRADED) -------- */
            ->actions([
                Tables\Actions\ViewAction::make(),

                // 🔥 Quick Edit (tidak harus masuk halaman edit)
                Tables\Actions\EditAction::make()
                    ->label('Quick Edit')
                    ->modalWidth('lg'),

                // Delete dengan modal custom
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Yakin ingin menghapus kategori ini?')
                    ->modalDescription('Data yang dihapus tidak dapat dikembalikan.'),
            ])

            /* ------- BULK ACTION -------- */
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->label('Hapus Terpilih'),
                ]),
            ])

            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
