<?php

namespace App\Filament\Resources\Errors;

use App\Filament\Resources\Errors\Pages\AssignError;
use App\Filament\Resources\Errors\Pages\CreateError;
use App\Filament\Resources\Errors\Pages\EditError;
use App\Filament\Resources\Errors\Pages\ListAllErrors;
use App\Filament\Resources\Errors\Pages\MyReportedError;
use App\Filament\Resources\Errors\Pages\ViewError;
use App\Filament\Resources\Errors\Schemas\ErrorForm;
use App\Filament\Resources\Errors\Schemas\ErrorInfolist;
use App\Filament\Resources\Errors\Tables\ErrorsTable;
use App\Models\Error;
use BackedEnum;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ErrorResource extends Resource
{
    protected static ?string $model = Error::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static ?string $recordTitleAttribute = 'Errors';

    // protected static string | UnitEnum | null $navigationGroup = 'Error';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ErrorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ErrorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ErrorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAllErrors::route('/'),
            'create' => CreateError::route('/create'),
            'view' => ViewError::route('/{record}'),
            'edit' => EditError::route('/{record}/edit'),
            'assign' => AssignError::route('/{record}/assign'),
            'my-reported-errors' => MyReportedError::route('/my-reported-errors'),
        ];
    }

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make('Report Error')
                ->icon('heroicon-o-flag')
                ->url(static::getUrl('create'))
                ->sort(1)
                ->group('Error')
                ->isActiveWhen(fn():bool => request()->routeIs('filament.admin.resources.errors.create')),
            NavigationItem::make('My Reported Errors')
                ->icon('heroicon-o-exclamation-circle')
                ->url(static::getUrl('my-reported-errors'))
                ->sort(2)
                ->group('Error')
                ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.errors.my-reported-errors')),
            NavigationItem::make('All Errors')
                ->icon('heroicon-o-archive-box-x-mark')
                ->url(static::getUrl('index'))
                ->sort(3)
                ->group('Error')
                ->isActiveWhen(fn():bool => request()->routeIs('filament.admin.resources.errors.index')),
        ];
    }
}
