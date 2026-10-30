<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rule;

#[Layout('layouts.app')]
class CategoryForm extends Component
{
    public ?Category $category = null;

    public string $name = '';

    public function mount(?Category $category = null)
    {
        if ($category?->exists) {
            $this->category = $category;
            $this->name = $category->name;
        }
    }

    protected function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->category?->id),
            ],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->category) {
            $this->category->update($data);
        } else {
            Category::create($data);
        }

        return $this->redirectRoute('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.category-form');
    }
}
