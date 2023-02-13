<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AreaSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->truncate();

        DB::table('areas')->insert([
            ['nome' => 'Jurídica'],
            ['nome' => 'Social'],
            ['nome' => 'Psicológia'],
            ['nome' => 'Multidisciplinar'],
        ]);
    }
}