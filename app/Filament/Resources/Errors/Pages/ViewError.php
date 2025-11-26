<?php

namespace App\Filament\Resources\Errors\Pages;

use App\Filament\Resources\Errors\ErrorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewError extends ViewRecord
{
    protected static string $resource = ErrorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
