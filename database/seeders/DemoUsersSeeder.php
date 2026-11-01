<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Administrator PAUD',
                'email' => 'admin@paud.test',
                'password' => 'Admin123!',
                'role' => 'administrator',
            ],
            [
                'name' => 'Guru PAUD',
                'email' => 'guru@paud.test',
                'password' => 'Guru123!',
                'role' => 'pendidik',
            ],
            [
                'name' => 'Orang Tua',
                'email' => 'orangtua@paud.test',
                'password' => 'Ortu123!',
                'role' => 'orang_tua',
            ],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrNew([
                'email' => $account['email'],
            ]);

            $user->name = $account['name'];
            $user->password = Hash::make($account['password']);
            $user->role = $account['role'];
            $user->save();
        }
    }
}