<?php

namespace Database\Seeders;

use App\Models\JabatanDisposisi;
use Illuminate\Database\Seeder;

class JabatanDisposisiTableSeeder extends Seeder
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
                'jabatan_id' => '1',
                'jabatan_dituju' => '2',
            ],
            [
                'jabatan_id' => '1',
                'jabatan_dituju' => '3',
            ],
            [
                'jabatan_id' => '1',
                'jabatan_dituju' => '4',
            ],
            [
                'jabatan_id' => '1',
                'jabatan_dituju' => '5',
            ],
            [
                'jabatan_id' => '1',
                'jabatan_dituju' => '6',
            ],
            [
                'jabatan_id' => '2',
                'jabatan_dituju' => '3',
            ],
            [
                'jabatan_id' => '3',
                'jabatan_dituju' => '4',
            ],
            [
                'jabatan_id' => '4',
                'jabatan_dituju' => '5',
            ],
            [
                'jabatan_id' => '5',
                'jabatan_dituju' => '6',
            ],
        ];

        try {
            foreach ($data as $key => $value) {
                $jabatanDisposisi = JabatanDisposisi::firstOrCreate($value);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
