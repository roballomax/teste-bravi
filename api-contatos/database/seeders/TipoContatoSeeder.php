<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo')->insert([
            [
                "id"            => 1,
                "nome"          => 'Telefone',
                "created_at"    => date('Y-m-d H:i:s'),
            ],
            [
                "id"            => 2,
                "nome"          => 'Whatsapp',
                "created_at"    => date('Y-m-d H:i:s'),
            ],
            [
                "id"            => 3,
                "nome"          => 'E-mail',
                "created_at"    => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
