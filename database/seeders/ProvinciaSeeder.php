<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dados das províncias
        $provincias = [
            ['id' => 1, 'pronome' => 'Bengo', 'abreviacao' => 'BO'],
            ['id' => 2, 'pronome' => 'Benguela', 'abreviacao' => 'BA'],
            ['id' => 3, 'pronome' => 'Bié', 'abreviacao' => 'BE'],
            ['id' => 4, 'pronome' => 'Cabinda', 'abreviacao' => 'CA'],
            ['id' => 5, 'pronome' => 'Cuando-Cubango', 'abreviacao' => 'CC'],
            ['id' => 6, 'pronome' => 'Cunene', 'abreviacao' => 'CE'],
            ['id' => 7, 'pronome' => 'Huambo', 'abreviacao' => 'HO'],
            ['id' => 8, 'pronome' => 'Huíla', 'abreviacao' => 'HA'],
            ['id' => 9, 'pronome' => 'Kwanza Sul', 'abreviacao' => 'KS'],
            ['id' => 10, 'pronome' => 'Kwanza Norte', 'abreviacao' => 'KN'],
            ['id' => 11, 'pronome' => 'Luanda', 'abreviacao' => 'LA'],
            ['id' => 12, 'pronome' => 'Lunda Norte', 'abreviacao' => 'LN'],
            ['id' => 13, 'pronome' => 'Lunda Sul', 'abreviacao' => 'LS'],
            ['id' => 14, 'pronome' => 'Malanje', 'abreviacao' => 'ME'],
            ['id' => 15, 'pronome' => 'Moxico', 'abreviacao' => 'MO'],
            ['id' => 16, 'pronome' => 'Namibe', 'abreviacao' => 'NE'],
            ['id' => 17, 'pronome' => 'Uíge', 'abreviacao' => 'UE'],
            ['id' => 18, 'pronome' => 'Zaire', 'abreviacao' => 'ZE'],
        ];

        // Inserir os dados na tabela
        DB::table('provincias')->insert($provincias);
    }
}
