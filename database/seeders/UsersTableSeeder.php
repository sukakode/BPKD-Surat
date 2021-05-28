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
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105004',
                'nama' => 'Si Kaban 01',
                'jabatan_id' => 3,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kaban01@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105005',
                'nama' => 'Si Kaban 02',
                'jabatan_id' => 3,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kaban02@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105006',
                'nama' => 'Si Sekban 01',
                'jabatan_id' => 4,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'sekban01@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105007',
                'nama' => 'Si Sekban 02',
                'jabatan_id' => 4,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'sekban02@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105008',
                'nama' => 'Si Kabid 01',
                'jabatan_id' => 5,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kabid01@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105009',
                'nama' => 'Si Kabid 02',
                'jabatan_id' => 5,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kabid02@mail.com',
                'password' => Hash::make('nanozero1'),
            ],
            [ 
                'nip' => '19991230202105010',
                'nama' => 'Si Kasi',
                'jabatan_id' => 6,
                'notelp' => '8572260'. rand(1000, 9999),
                'email' => 'kasi@mail.com',
                'password' => Hash::make('nanozero1'),
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
