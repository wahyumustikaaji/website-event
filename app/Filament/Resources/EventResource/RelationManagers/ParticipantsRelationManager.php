<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipantsRelationManager extends RelationManager
{
    protected static string $relationship = 'participants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\Toggle::make('is_approved')
                    ->label('Approved')
                    ->default(false)
                    ->visible(fn($record) => $record?->event?->requires_approval ?? false),

                Forms\Components\Toggle::make('payment_status')
                    ->label('Payment Completed')
                    ->default(false)
                    ->visible(fn($record) => $record?->event?->price_ticket > 0),

                Forms\Components\FileUpload::make('payment_receipt')
                    ->image()
                    ->directory('payment-receipts')
                    ->visible(fn($record) => $record?->event?->price_ticket > 0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('payment_status')
                    ->label('Payment')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('payment_receipt')
                    ->circular(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_approved')
                    ->query(fn(Builder $query): Builder => $query->where('is_approved', true))
                    ->label('Approved Participants'),

                Tables\Filters\Filter::make('not_approved')
                    ->query(fn(Builder $query): Builder => $query->where('is_approved', false))
                    ->label('Pending Approval'),

                Tables\Filters\Filter::make('payment_complete')
                    ->query(fn(Builder $query): Builder => $query->where('payment_status', true))
                    ->label('Payment Complete'),

                Tables\Filters\Filter::make('payment_pending')
                    ->query(fn(Builder $query): Builder => $query->where('payment_status', false))
                    ->label('Payment Pending'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn($record) => $record->update(['is_approved' => true]))
                    ->visible(fn($record) => $record->event->requires_approval && !$record->is_approved),

                Tables\Actions\Action::make('confirm_payment')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->action(fn($record) => $record->update(['payment_status' => true]))
                    ->visible(fn($record) => $record->event->price_ticket > 0 && !$record->payment_status),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(fn($records) => $records->each->update(['is_approved' => true]))
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('confirm_payments')
                        ->label('Confirm Payments')
                        ->icon('heroicon-o-currency-dollar')
                        ->color('success')
                        ->action(fn($records) => $records->each->update(['payment_status' => true]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }
}
