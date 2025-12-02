<?php

namespace App\Filament\Resources\Errors\Pages;

use App\Filament\Resources\Errors\ErrorResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

class MyReportedError extends ListRecords
{
    protected static string $resource = ErrorResource::class;

    public function mount(): void
    {
        dd('mounted');
    }
    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return false;
    }

    public function getTitle(): string {
        return 'My Reported Errors';
    }

    public function getBreadcrumb(): string|null {
        return 'My Reported Errors';
    }

    public function getTableQuery(): Builder|Relation|null {
        return parent::getTableQuery()->where('reporter', Auth::id());
    }
}
