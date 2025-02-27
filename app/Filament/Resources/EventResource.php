<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use App\Filament\Resources\EventResource\RelationManagers\ParticipantsRelationManager;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $inverseRelationship = 'event';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Select::make('creator_id')
                                    ->relationship('creator', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\Select::make('city_category_id')
                                    ->relationship('cityCategory', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                            ]),
                    ]),

                Section::make('Event Details')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('events')
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('location_name')
                                    ->required(),

                                Forms\Components\TextInput::make('address')
                                    ->required(),

                                Forms\Components\TextInput::make('latitude')
                                    ->numeric()
                                    ->minValue(-90)
                                    ->maxValue(90),

                                Forms\Components\TextInput::make('longitude')
                                    ->numeric()
                                    ->minValue(-180)
                                    ->maxValue(180),

                                Forms\Components\DatePicker::make('event_date')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d/m/Y'),

                                Forms\Components\DatePicker::make('end_date')
                                    ->native(false)
                                    ->displayFormat('d/m/Y'),

                                Forms\Components\TimePicker::make('start_time')
                                    ->required()
                                    ->native(false),

                                Forms\Components\TimePicker::make('end_time')
                                    ->required()
                                    ->native(false),

                                Forms\Components\TextInput::make('ticket_quantity')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),

                                Forms\Components\TextInput::make('price_ticket')
                                    ->label('Ticket Price')
                                    ->numeric()
                                    ->minValue(0)
                                    ->prefix('Rp'),

                                Forms\Components\Toggle::make('requires_approval')
                                    ->label('Requires Approval')
                                    ->default(false),
                            ]),

                        Forms\Components\RichEditor::make('body')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->height(40),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Creator')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cityCategory.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('event_date')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_ticket')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ticket_quantity')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('requires_approval')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('participants_count')
                    ->counts('participants')
                    ->label('Participants')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('creator')
                    ->relationship('creator', 'name'),

                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),

                Tables\Filters\SelectFilter::make('cityCategory')
                    ->relationship('cityCategory', 'name'),

                Tables\Filters\Filter::make('upcoming')
                    ->query(fn(Builder $query): Builder => $query->where('event_date', '>=', now())),

                Tables\Filters\Filter::make('past')
                    ->query(fn(Builder $query): Builder => $query->where('event_date', '<', now())),

                Tables\Filters\Filter::make('requires_approval')
                    ->query(fn(Builder $query): Builder => $query->where('requires_approval', true)),

                Tables\Filters\Filter::make('free_events')
                    ->query(fn(Builder $query): Builder => $query->whereNull('price_ticket')->orWhere('price_ticket', 0)),

                Tables\Filters\Filter::make('paid_events')
                    ->query(fn(Builder $query): Builder => $query->where('price_ticket', '>', 0)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('event_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ParticipantsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
