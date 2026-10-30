<?php

namespace App\Livewire\Customers;

use App\Models\Customers;
use Livewire\Component;

class CustomerForm extends Component
{
    protected function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],

            'cuit' => [
                'required',
                'regex:/^\d{2}-\d{8}-\d{1}$/'
            ]
        ];
    }
    public function render()
    {
        return view('livewire.customers.customer-form');
    }
}
