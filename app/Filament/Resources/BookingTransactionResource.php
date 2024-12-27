<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\CarService;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use App\Models\StoreService;
use Filament\Resources\Resource;
use App\Models\BookingTransaction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->helperText('The name of the customer.')
                    ->required(),
                TextInput::make('trx_id')
                    ->label('Transaction ID')
                    ->required(),
               Select::make('car_store_id')
                    ->label('Store')
                    ->relationship('carStore', 'name')
                    ->reactive()
                    ->required(),
                Select::make('car_service_id')
                    ->label('Service')
                    ->options(function (callable $get) {
                        $storeId = $get('car_store_id');
                        if (!$storeId) {
                            return [];
                        }

                        return StoreService::where('car_store_id', $storeId)
                            ->with('carService')
                            ->get()
                            ->pluck('carService.name', 'carService.id');
                    })
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {
                            // Fetch the price of the selected service
                            $price = CarService::find($state)?->price ?? 0;
                            $set('total_amount', $price); // Directly set the price
                        }
                    })
                    ->reactive()
                    ->required(),
                TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('IDR')
                    ->label('Total Amount')
                    ->disabled() // Prevent manual editing
                    ->dehydrated(true) // Ensure it's submitted
                    ->reactive()
                    ->required(),
                TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required(),
                Select::make('is_paid')
                    ->label('Is Paid')
                    ->options([
                        true => 'Paid',
                        false => 'Unpaid',
                    ])
                    ->required(),
                DatePicker::make('started_at')
                    ->label('Started At')
                    ->minDate(now()->toDateString())
                    ->required(),
                TimePicker::make('time_at')
                    ->label('Time At')
                    ->required(),
                FileUpload::make('proof')
                    ->columnSpan(2)
                    ->label('Proof of Payment')
                    ->image()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('trx_id')
                    ->label('Transaction ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('carStore.name')
                    ->label('Store')
                    ->searchable(),
                Tables\Columns\TextColumn::make('carService.name')
                    ->label('Service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->money('IDR')
                    ->label('Total Amount'),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('is_paid')
                    ->label('Paid'),
                Tables\Columns\TextColumn::make('started_at')
                    ->label('Date'),
                Tables\Columns\TextColumn::make('time_at')
                    ->label('Time'),
                Tables\Columns\ImageColumn::make('proof')
                    ->label('Proof of Payment'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
