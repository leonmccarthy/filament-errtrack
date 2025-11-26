<?php

namespace App\Filament\Resources\Errors\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ErrorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_name')
                    ->searchable(),
                TextColumn::make('error_description')
                    ->searchable(),
                TextColumn::make('error_steps')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Reporter')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('assigned_to')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('priority')
                    ->badge()
                    ->searchable(),
                TextColumn::make('assigner')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('corrective_actions_to_be_done')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('corrective_actions_done')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->successNotificationTitle('Error deleted successfully')
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
