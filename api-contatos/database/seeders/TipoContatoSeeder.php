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
        DB::statement("INSERT INTO tipo (id, nome, created_at) VALUES (1, 'Telefone', now())");
        DB::statement("INSERT INTO tipo (id, nome, created_at) VALUES (2, 'Whatsapp', now())");
        DB::statement("INSERT INTO tipo (id, nome, created_at) VALUES (3, 'E-mail', now())");
    }
}
