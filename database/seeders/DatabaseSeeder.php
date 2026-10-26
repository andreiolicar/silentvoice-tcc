<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Credenciais fictícias, destinadas exclusivamente à demonstração local.
        $admin = User::firstOrNew(['email' => 'admin@silentvoice.test']);
        $admin->fill(['name' => 'Administrador SilentVoice', 'password' => Hash::make('SilentVoice123!'), 'interest_type' => null]);
        $admin->is_admin = true;
        $admin->save();

        $names = ['Ana Silva', 'Bruno Costa', 'Carla Santos', 'Diego Lima', 'Elisa Rocha',
            'Felipe Alves', 'Gabriela Melo', 'Henrique Dias', 'Isabela Souza', 'João Pereira'];
        $types = ['usuario', 'investidor', 'outro'];

        foreach ($names as $index => $name) {
            User::updateOrCreate(
                ['email' => 'interessado'.($index + 1).'@example.test'],
                ['name' => $name, 'interest_type' => $types[$index % 3], 'password' => Hash::make('SilentVoice123!')],
            );
        }
    }
}
