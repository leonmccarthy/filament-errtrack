<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->successNotificationTitle('User deleted successfully'),
        ];
    }

    public function getSavedNotificationTitle(): ?string
    {
        return 'User updated successfully';
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', [ 'record' =>$this->record]);
    }
}
