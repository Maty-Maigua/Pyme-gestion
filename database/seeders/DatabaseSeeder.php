<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\{Category, Customer, Product, User};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Billy',
            'email' => 'billy@demo.test',
            'password' => 'password',
            'role' => Role::Admin,
        ]);

        User::factory()->create([
            'name' => 'marcus',
            'email' => 'marcus@demo.test',
            'password' => 'password',
            'role' => Role::Operator,
        ]);

        $categories = Category::factory(5)->create();

        Product::factory(40)->recycle($categories)->create();

        Customer::factory(15)->create();
    }
}
