<?php

namespace App\Filament\Resources\Errors\Tables;

use Filament\Actions\Action;
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
                    ->searchable()
                    ->wrap(),
                TextColumn::make('error_steps')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('repoter.name')
                    ->label('Reporter')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state)=> match ($state){
                        'new' => 'primary',
                        'assigned' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                        'closed' => 'secondary',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('assignee.name')
                    ->label('Assigned To')
                    ->sortable(),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn ($state)=> match ($state){
                        'low' => 'success',
                        'medium' => 'warning',
                        'high' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('assigned_by.name')
                    ->label('Assigned By')
                    ->sortable(),
                TextColumn::make('corrective_actions_to_be_done')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('corrective_actions_done')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    Action::make('assign')
                        ->label('Assign')
                        ->icon('heroicon-o-clipboard-document-check')
                        ->color('secondary')
                        ->url(fn ($record)=> route('filament.admin.resources.errors.assign', $record)),
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
