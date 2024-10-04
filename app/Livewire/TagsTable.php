<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class TagsTable extends DataTableComponent
{
    protected $model = Tag::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        if (hasRole('administrator')) {
            return Tag::query();
        }

        return Tag::query()->whereIn('user_id', auth()->user()->id);
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
            Column::make(trans('Nome'), "name")
                ->sortable()
                ->searchable(),
            Column::make(trans('Descrição'), "description")
                ->sortable()
                ->searchable(),
            Column::make(trans('Criado em'), "created_at")
                ->sortable(),
            Column::make(trans('Ações'))
                ->label(fn($row, Column $column) => view('components.table.tags.actions')->withValue($row->id)),
        ];
    }
}
