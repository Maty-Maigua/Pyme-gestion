<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ProductIndex extends Component
{
    use AuthorizesRequests, WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();
        session()->flash('status', 'Producto eliminado.');
    }

    public function render()
    {
        return view('livewire.products.product-index', [
            'products' => Product::with('category')
                ->search($this->search)
                ->orderBy('name')
                ->paginate(10),
        ]);
    }
}
