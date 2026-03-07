<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);

        // bunun icini bele dagitmaq lazimdir. bunu unutma.
        // sehv isleyirsen. soyus soymursen
        // bunun beterini sikim.
        // soymesen olmur
    }
}
