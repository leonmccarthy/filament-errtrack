<?php

namespace App\Filament\Resources\Errors\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ErrorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('project_name')
                            ->minLength(3)
                            ->maxLength(80)
                            ->columnSpanFull()
                            ->required(),
                        Textarea::make('error_description')
                            ->columns(8)
                            ->rows(4)
                            ->required(),
                        Textarea::make('error_steps')
                            ->columns(8)
                            ->rows(4)
                            ->required(),
                        Hidden::make('reporter')
                            ->default(Auth::id()),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
            ]);
    }
}
