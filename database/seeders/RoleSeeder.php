<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'isAdmin'
            ],
            [
                'name' => 'isTranslater'
            ],
            [
                'name' => 'isEmailVerified'
            ],
            [
                'name' => 'isVerified'
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
