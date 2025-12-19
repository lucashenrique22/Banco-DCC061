<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Administrador',
            'cpf' => '18491385088',
            'password' => bcrypt('admin123'),
        ]);

        User::factory(5)->create();
    }
}
