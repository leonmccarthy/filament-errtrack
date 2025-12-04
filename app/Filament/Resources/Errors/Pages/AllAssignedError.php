<?php

namespace App\Filament\Resources\Errors\Pages;

use App\Filament\Resources\Errors\ErrorResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Filament\Tables\Table;
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

   public function getTable(): Table
   {
     return parent::getTable()
          ->recordActions([
               ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()
                         ->color('warning'),
                    Action::make('Manage Steps')
                         ->color('secondary')
                         ->icon('heroicon-o-clipboard-document')
                         ->url(fn ($record)=>route('filament.admin.resources.errors.manage-error-steps', $record)),
                    DeleteAction::make()
               ])
          ]);
   }
}
