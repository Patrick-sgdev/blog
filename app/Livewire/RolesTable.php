<?php

namespace App\Livewire;

use App\Models\Role;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class RolesTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function updated($name)
    {
        $this->dispatch('update-preline');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(trans('Name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(trans('Description'), "description")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make(trans('actions'))
                ->label(fn($row, Column $column) => view('components.table.roles.actions')->withValue($row->id)),
        ];
    }
}
