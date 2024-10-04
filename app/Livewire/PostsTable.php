<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use App\Models\Order;
use App\Models\Auction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PostsTable extends DataTableComponent
{
    protected $model = Post::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function updated($name)
    {
        $this->dispatch('update-preline');
    }

    public function builder(): Builder
    {
        if (hasRole('administrator')) {
            return Post::query()->with('author');
        }

        return Post::query()->with('author')->whereIn('user_id', auth()->user()->id);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(trans('Autor'), 'author.name'),
            Column::make(trans('Título'), "title")
                ->sortable()
                ->searchable(),
            Column::make(trans('Status'), "status")
                ->sortable()
                ->searchable(),
            Column::make(trans('Criado em'), "created_at")
                ->sortable(),
            Column::make(trans('Ações'))
                ->label(fn($row, Column $column) => view('components.table.posts.actions')->withValue($row->id)),
        ];
    }
}
