<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles and permissions
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Create a sample user

        Product::factory()->count(10)->create();

    }
}
