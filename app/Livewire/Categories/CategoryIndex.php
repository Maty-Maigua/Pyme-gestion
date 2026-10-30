<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CategoryIndex extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public function delete(int $id): void
    {
        Category::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.categories.category-index', [
            'categories' => Category::query()
                ->where('name', 'like', "%{$this->search}%")
                ->orderBy('name')
                ->paginate(10),
        ]);
    }
}
