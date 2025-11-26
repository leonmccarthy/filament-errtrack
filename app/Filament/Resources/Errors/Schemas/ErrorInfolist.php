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
                        TextEntry::make('user.name')
                            ->label('Reporter')
                            ->placeholder('-'),
                        TextEntry::make('status')
                            ->badge(),
                        TextEntry::make('assigned_to')
                            ->numeric()
                            ->placeholder('-'),
                        TextEntry::make('priority')
                            ->badge(),
                        TextEntry::make('assigner')
                            ->numeric()
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
