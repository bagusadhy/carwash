<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarStoreResource\RelationManagers\StorePhotosRelationManager;
use Filament\Forms;
use Filament\Tables;
use App\Models\CarStore;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\CarStoreResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CarStoreResource\RelationManagers;

class CarStoreResource extends Resource
{
    protected static ?string $model = CarStore::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->helperText('The name of the car store.')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->helperText('The phone number of the car store.')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('cs_name')
                            ->label('Customer Service Name')
                            ->helperText('The name of the customer service of the car store.')
                            ->required()
                            ->maxLength(255),
                        Select::make('is_open')
                            ->label('Is Open')
                            ->options([
                                true => 'Open',
                                false => 'Closed',
                            ])
                            ->required(),
                        Select::make('is_full')
                            ->label('Is Full')
                            ->options([
                                true => 'Full Booked',
                                false => 'Available',
                            ])
                            ->required(),
                        Select::make('city_id')
                            ->label('City')
                            ->relationship('city', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                ]),
                Section::make()
                    ->columns(1)
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->image()
                            ->required()
                            ->label('Thumbnail')
                            ->helpertext('The thumbnail of the car store.'),
                        Textarea::make('address')
                            ->label('Address')
                            ->helperText('The address of the car store.')
                            ->rows(10)
                            ->cols(20)
                            ->required(),
                        Repeater::make('storeServices')
                            ->relationship()
                            ->schema([
                                Select::make('car_service_id')
                                    ->label('Car Service')
                                    ->relationship('carService', 'name')
                                    ->preload()
                                    ->required()
                    ]),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('Phone')
                    ->searchable(),
                TextColumn::make('cs_name')
                    ->label('Cs Name')
                    ->searchable(),
                TextColumn::make('city.name')
                    ->label('City')
                    ->searchable(),
                BooleanColumn::make('is_open')
                    ->label('Open')
                    ->sortable(),
                BooleanColumn::make('is_full')
                    ->label('Full')
                    ->sortable(),
                ImageColumn::make('storeServices.carService.icon')
                    ->circular()
                    ->stacked()
                    ->limit(2)
                    ->limitedRemainingText(),
                ImageColumn ::make('thumbnail')
                    ->label('Thumbnail')
            ])
            ->filters([
                //
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('Service')
                    ->label('Service')
                    ->relationship('storeServices.carService', 'name')
                    ->preload()
                    ->searchable(),
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
            StorePhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarStores::route('/'),
            'create' => Pages\CreateCarStore::route('/create'),
            'edit' => Pages\EditCarStore::route('/{record}/edit'),
        ];
    }
}
