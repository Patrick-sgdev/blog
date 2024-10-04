<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CategoriesTable extends DataTableComponent
{
    protected $model = Category::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        if (hasRole('administrator')) {
            return Category::query();
        }

        return Category::query()->whereIn('user_id', auth()->user()->id);
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
                ->label(fn($row, Column $column) => view('components.table.categories.actions')->withValue($row->id)),
        ];
    }
}
