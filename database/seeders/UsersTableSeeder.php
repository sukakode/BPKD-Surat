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
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'megilangr1@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105002',
                'nama' => 'Admin',
                'jabatan_id' => 1,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
            ],
            [ 
                'nip' => '19991230202105003',
                'nama' => 'Si FO',
                'jabatan_id' => 2,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'fo@mail.com',
                'password' => Hash::make('fo'),
            ],
            [ 
                'nip' => '19991230202105004',
                'nama' => 'Si Kaban',
                'jabatan_id' => 3,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kaban@mail.com',
                'password' => Hash::make('kaban'),
            ], 
            [ 
                'nip' => '19991230202105006',
                'nama' => 'Si Sekban',
                'jabatan_id' => 4,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'sekban@mail.com',
                'password' => Hash::make('sekban'),
            ], 
            [ 
                'nip' => '19991230202105008',
                'nama' => 'Si Kabid 01',
                'jabatan_id' => 5,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kabid01@mail.com',
                'password' => Hash::make('kabid01'),
            ],
            [ 
                'nip' => '19991230202105009',
                'nama' => 'Si Kabid 02',
                'jabatan_id' => 5,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kabid02@mail.com',
                'password' => Hash::make('kabid02'),
            ],
            [ 
                'nip' => '19991230202105011',
                'nama' => 'Si Kabid 03',
                'jabatan_id' => 5,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kabid03@mail.com',
                'password' => Hash::make('kabid03'),
            ],
            [ 
                'nip' => '19991230202105011',
                'nama' => 'Si Kabid 04',
                'jabatan_id' => 5,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kabid04@mail.com',
                'password' => Hash::make('kabid04'),
            ],
            [ 
                'nip' => '19991230202105010',
                'nama' => 'Si Kasi',
                'jabatan_id' => 6,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kasi@mail.com',
                'password' => Hash::make('kasi'),
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
