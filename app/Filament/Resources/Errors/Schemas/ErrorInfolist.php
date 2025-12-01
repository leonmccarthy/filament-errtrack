<?php

namespace App\Filament\Resources\Errors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ErrorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('project_name'),
                        TextEntry::make('error_description'),
                        TextEntry::make('error_steps'),
                        TextEntry::make('repoter.name')
                            ->label('Reporter')
                            ->placeholder('-'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn($state)=>match($state){
                                'new' => 'primary',
                                'assigned' => 'warning',
                                'in_progress' => 'info',
                                'resolved' => 'success',
                                'closed' => 'secondary',
                                default => 'gray',
                            }),
                        TextEntry::make('assignee.name')
                            ->label('Assigned To')
                            ->placeholder('-'),
                        TextEntry::make('priority')
                            ->badge()
                            ->color(fn ($state)=>match($state){
                                'low' => 'success',
                                'medium' => 'warning',
                                'high' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('assigned_by.name')
                            ->label('Assigned By')
                            ->placeholder('-'),
                        TextEntry::make('corrective_actions_to_be_done')
                            ->numeric(),
                        TextEntry::make('corrective_actions_done')
                            ->numeric(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
            ]);
    }
}
