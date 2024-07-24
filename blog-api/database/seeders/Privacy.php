<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Privacy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('privacy_policies')->insert([
            'title' => 'deneme',
            'slug' => 'deneme',
            'description' => 'deneme',
        ]);
    }
}
