<?php

namespace App\Filament\Resources\Errors\Pages;

use App\Filament\Resources\Errors\ErrorResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;

class ManageErrorSteps extends Page implements HasForms
{
    use InteractsWithRecord;
    use InteractsWithForms;

    protected static string $resource = ErrorResource::class;

    protected array $data = [];

    protected string $view = 'filament.resources.errors.pages.manage-error-steps';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getFormSchema(): array
    {
        return [
            Section::make('Error Details')
                ->schema([
                    TextInput::make('project_name')
                        ->disabled(),
                    TextInput::make('repoter.name')
                        ->label('Reported by')
                        ->disabled(),
                    Textarea::make('error_description')
                        ->rows(2)
                        ->columns(8)
                        ->disabled(),
                    Textarea::make('error_steps')
                        ->rows(2)
                        ->columns(8)
                        ->disabled(),
                    TextInput::make('status')
                        ->disabled(),
                    TextInput::make('assigner')
                        ->label('Assigned by')
                        ->disabled(),
                    TextInput::make('assignee.name')
                        ->label('Assigned to')
                        ->disabled()
                        ->columnSpanFull()
                ])
                ->columns(2),
            Section::make('Manage Error Steps')
                    ->schema([
                        TextInput::make('corrective_actions_to_be_done')
                            ->label('Steps to be done')
                            ->helperText('Number of corrective steps to be performed')
                            ->numeric(),
                        TextInput::make('corrective_actions_done')
                            ->label('Steps to be done')
                            ->helperText('Number of corrective steps to be performed')
                            ->numeric()
                    ])
                    ->footerActions([
                        Action::make('save')
                            ->label('Save')
                            ->color('primary')
                            ->action('submit'),
                        Action::make('cancel')
                            ->color('gray')
                            ->label('Cancel')
                            ->url(url()->previous())
                    ])
                    ->columns(2)
        ];
    }
}
