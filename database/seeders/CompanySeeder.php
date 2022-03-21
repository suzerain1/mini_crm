<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => Str::random(8),
            'email' => Str::random(6).'@gmail.com',
            'logo' => Str::random(5).'jpg',
            'website' => Str::random(8).'.com',
        ]);
    }
}
