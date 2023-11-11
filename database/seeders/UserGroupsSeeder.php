<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_groups')->insert([
            [
                'title'         => 'Super Admin',
                'acronym'       => 'SU',
                'level'         => 1,
                'status'        => 1,
                'id'            => 1,
            ],
            [
                'title'         => 'Admin',
                'acronym'       => 'ADM',
                'level'         => 10,
                'status'        => 1,
                'id'            => 2,
            ],
            [
                'title'         => 'Usuário',
                'acronym'       => 'USU',
                'level'         => 100,
                'status'        => 1,
                'id'            => 3,
            ]

        ]);
    }
}
