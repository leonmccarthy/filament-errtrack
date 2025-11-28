<?php

namespace App\Filament\Resources\Errors\Pages;

use App\Enums\PriorityEnum;
use App\Filament\Resources\Errors\ErrorResource;
use App\Models\Error;
use App\Models\User;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Forms\Form;

class AssignError extends Page implements HasForms
{
    use InteractsWithRecord;
    use InteractsWithForms;
    protected static string $resource = ErrorResource::class;

    protected string $view = 'filament.resources.errors.pages.assign-error';

    protected string $formStatePath = 'data';
    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->form->fill([
                'project_name' => $this->record->project_name,
                'error_description' => $this->record->error_description,
                'error_steps' => $this->record->error_steps,
                'priority' => $this->record->priority,
                'assigned_to' => $this->record->assigned_to,
                'status' => $this->record->status
            ]
        );
    }

    public function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema($this->getFormSchema())
                ->statePath($this->formStatePath),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Error Details')
                ->schema([
                    TextInput::make('project_name')
                        ->disabled()
                        ->columnSpanFull(),
                    Textarea::make('error_description')
                        ->rows(4)
                        ->columns(8)
                        ->disabled(),
                    Textarea::make('error_steps')
                        ->rows(4)
                        ->columns(8)
                        ->disabled(),
                ])
                ->columns(2),

            Section::make('Assign Error')
                    ->schema([
                        Select::make('priority')
                            ->options([
                                'low' => PriorityEnum::LOW->value,
                                'medium' => PriorityEnum::MEDIUM->value,
                                'high' => PriorityEnum::HIGH->value,
                            ])
                            ->required(),
                        Select::make('assigned_to')
                            ->label('Assign Developer')
                            ->options(User::role('developer')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Hidden::make('status')
                            ->default('assigned'),
                    ])
                    ->columns(2)
        ];
    }

    public function submit(){
        $this->record->update($this->form->getState());

        $this->notify('success', 'Error assigned successfully.');

        return redirect()->route('filament.admin.resources.errors.index');
    }
}
