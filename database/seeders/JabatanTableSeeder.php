<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanTableSeeder extends Seeder
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
                'nama' => 'Administrator',
                'keterangan' => 'Programmer Administrator',
            ],
            [
                'nama' => 'FO',
                'keterangan' => null,
            ],
            [
                'nama' => 'Kaban',
                'keterangan' => null,
            ],
            [
                'nama' => 'Sekban',
                'keterangan' => null,
            ],
            [
                'nama' => 'Kabid',
                'keterangan' => null,
            ],
            [
                'nama' => 'Kasi',
                'keterangan' => null,
            ],
        ];

        try {
            foreach ($data as $key => $value) {
                $jabatan = Jabatan::firstOrCreate($value);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
