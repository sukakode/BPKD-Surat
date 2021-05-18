<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 
                'nip' => '19991230202105001',
                'nama' => 'Me Gilang R',
                'jabatan_id' => 1,
                'notelp' => '85722606696',
                'email' => 'megilangr1@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105002',
                'nama' => 'Admin',
                'jabatan_id' => 1,
                'notelp' => '85722606696',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
            ],
        ];

        try {
            foreach ($data as $key => $value) {
                $user = User::firstOrCreate($value);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
