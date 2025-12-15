<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Manajemen Kost';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Transaksi')
                    ->icon('heroicon-o-credit-card')
                    ->columns(2)
                    ->schema([

                        Forms\Components\TextInput::make('code')
                            ->label('Kode Transaksi')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('boarding_house_id')
                            ->label('Nama Kost')
                            ->relationship('boardingHouse', 'name')
                            ->required()
                            ->searchable(),

                        Forms\Components\Select::make('room_id')
                            ->label('Nama Kamar')
                            ->relationship('room', 'name')
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Penyewa')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),

                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->required(),

                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'down_payment' => 'Down Payment',
                                'full_payment' => 'Full Payment',
                            ])
                            ->required(),

                        Forms\Components\Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                            ])
                            ->required(),

                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required(),

                        Forms\Components\TextInput::make('duration')
                            ->label('Durasi (bulan)')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('total_amount')
                            ->label('Total Pembayaran')
                            ->numeric()
                            ->prefix('Rp ')
                            ->required(),

                        Forms\Components\DatePicker::make('transaction_date')
                            ->label('Tanggal Transaksi')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('boardingHouse.name')
                    ->label('Kost')
                    ->searchable(),

                Tables\Columns\TextColumn::make('room.name')
                    ->label('Kamar')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Penyewa')
                    ->searchable(),

                // Badge warna status
                Tables\Columns\BadgeColumn::make('payment_method')
                    ->label('Metode')
                    ->colors([
                        'primary',
                        'warning' => 'down_payment',
                        'success' => 'full_payment',
                    ])
                    ->formatStateUsing(fn($state) => ucfirst(str_replace('_', ' ', $state))),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger' => 'failed',
                    ])
                    ->formatStateUsing(fn($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('idr', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'down_payment' => 'Down Payment',
                        'full_payment' => 'Full Payment',
                    ]),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
