<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Administrador',
            'cpf' => '18491385088',
            'password' => bcrypt('admin123'),
        ]);

        Account::factory()->create([
            'user_id' => $admin->id,
            'account_number' => 'ACC' . str_pad($admin->id, 6, '0', STR_PAD_LEFT),
            'balance' => 0,
        ]);

        User::factory(5)->create()->each(function ($user) {
            Account::factory()->create([
                'user_id' => $user->id,
                'account_number' => 'ACC' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                'balance' => 0,
            ]);
        });
    }
}
