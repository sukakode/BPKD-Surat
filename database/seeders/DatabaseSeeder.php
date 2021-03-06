<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(JabatanTableSeeder::class);
        $this->call(JabatanDisposisiTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
