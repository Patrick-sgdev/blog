<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(trans("Name"), "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
                Column::make(trans("Roles"), "roles.name")
                ->label(function($row) {
                    return $row->roles->pluck('name')->join(', ');
                })
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
                Column::make(trans('actions'))
                ->label(fn($row, Column $column) => view('components.table.users.actions')->withValue($row->id)),
        ];
    }
}
