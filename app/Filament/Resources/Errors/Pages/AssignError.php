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
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AssignError extends Page implements HasForms
{
    use InteractsWithRecord;
    use InteractsWithForms;
    protected static string $resource = ErrorResource::class;

    protected string $view = 'filament.resources.errors.pages.assign-error';

    protected string $formStatePath = 'data';
    public ?array $data = [];

    public function mount($record): void
{
    $this->record = $this->resolveRecord($record);

    $this->form->fill(array_merge(
        $this->record->only([
            'project_name',
            'error_description',
            'error_steps',
            'priority',
            'assigned_to',
            'status',
        ]),
        [
            'reporter' => optional($this->record->repoter)->name,
        ]
    ));
}

    public function form(Schema $form): Schema
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath($this->formStatePath);
            
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Error Details')
                ->schema([
                    TextInput::make('project_name')
                        ->disabled(),
                    TextInput::make('reporter')
                        ->label('Reporter')
                        ->disabled(),
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
                    ])
                    ->columns(2)
        ];
    }

    public function submit(){

        $data = $this->form->getState();
        $data['assigner'] = Auth::id();
        $data['status'] = 'assigned';
        $this->record->update($data);

        Notification::make()
            ->body('Error assigned successfully.')
            ->success()
            ->send();

        return redirect()->route('filament.admin.resources.errors.index');
    }
}
