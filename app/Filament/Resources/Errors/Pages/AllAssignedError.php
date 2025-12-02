<?php

namespace App\Filament\Resources\Errors\Pages;

use App\Filament\Resources\Errors\ErrorResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class AllAssignedError extends ListRecords
{
    protected static string $resource = ErrorResource::class;

   public function getTitle(): string {
        return 'All Assigned Errors';
   }

   public function getBreadcrumb(): string|null {
        return 'All Assigned Errors';
   }

   public static function shouldRegisterNavigation(array $parameters = []): bool
   {
    return false;
   }

   public function getTableQuery(): Builder|Relation|null {
    return parent::getTableQuery()->where('status', 'assigned');
   }
}
