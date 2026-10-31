<?php

namespace App\Livewire\Products;

use App\Models\{Category, Product};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProductForm extends Component
{
    use AuthorizesRequests;

    public ?Product $product = null;

    public ?int $category_id = null;
    public string $sku = '';
    public string $name = '';
    public string $price = '';
    public string $cost = '0';
    public int $min_stock = 0;
    public bool $active = true;

    public function mount(?Product $product = null): void
    {
        if ($product?->exists) {
            $this->authorize('update', $product);
            $this->product = $product;
            $this->fill($product->only(
                'category_id', 'sku', 'name',
                 'price', 'cost',
                  'min_stock', 'active'
            ));
        } else {
            $this->authorize('create', Product::class);
        }
    }

    protected function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'sku' => ['required', 'string', 'max:50', Rule::unique('products', 'sku')->ignore($this->product?->id)],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['required', 'numeric', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
            'active' => ['boolean'],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->product) {
            $this->product->update($data);
        } else {
            Product::create($data);
        }

        session()->flash('status', 'Producto guardado.');

        return $this->redirectRoute('products.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.products.product-form', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
