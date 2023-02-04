<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstadoSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->truncate();

        DB::table('estados')->insert([
            ['id' => 1, 'nome' => 'Acre', 'sigla' => 'AC', 'is_estrangeiro' => 'false' ],
            ['id' => 2, 'nome' => 'Alagoas', 'sigla' => 'AL', 'is_estrangeiro' => 'false' ],
            ['id' => 3, 'nome' => 'Amapá', 'sigla' => 'AP', 'is_estrangeiro' => 'false' ],
            ['id' => 4, 'nome' => 'Amazonas', 'sigla' => 'AM', 'is_estrangeiro' => 'false' ],
            ['id' => 5, 'nome' => 'Bahia', 'sigla' => 'BA', 'is_estrangeiro' => 'false' ],
            ['id' => 6, 'nome' => 'Ceará', 'sigla' => 'CE', 'is_estrangeiro' => 'false' ],
            ['id' => 7, 'nome' => 'Distrito Federal', 'sigla' => 'DF', 'is_estrangeiro' => 'false' ],
            ['id' => 8, 'nome' => 'Espírito Santo', 'sigla' => 'ES', 'is_estrangeiro' => 'false' ],
            ['id' => 9, 'nome' => 'Goiás', 'sigla' => 'GO', 'is_estrangeiro' => 'false' ],
            ['id' => 10, 'nome' => 'Maranhão', 'sigla' => 'MA', 'is_estrangeiro' => 'false' ],
            ['id' => 11, 'nome' => 'Mato Grosso', 'sigla' => 'MT', 'is_estrangeiro' => 'false' ],
            ['id' => 12, 'nome' => 'Mato Grosso do Sul', 'sigla' => 'MS', 'is_estrangeiro' => 'false' ],
            ['id' => 13, 'nome' => 'Minas Gerais', 'sigla' => 'MG', 'is_estrangeiro' => 'false' ],
            ['id' => 14, 'nome' => 'Pará', 'sigla' => 'PA', 'is_estrangeiro' => 'false' ],
            ['id' => 15, 'nome' => 'Paraíba', 'sigla' => 'PB', 'is_estrangeiro' => 'false' ],
            ['id' => 16, 'nome' => 'Paraná', 'sigla' => 'PR', 'is_estrangeiro' => 'false' ],
            ['id' => 17, 'nome' => 'Pernambuco', 'sigla' => 'PE', 'is_estrangeiro' => 'false' ],
            ['id' => 18, 'nome' => 'Piauí', 'sigla' => 'PI', 'is_estrangeiro' => 'false' ],
            ['id' => 19, 'nome' => 'Rio de Janeiro', 'sigla' => 'RJ', 'is_estrangeiro' => 'false' ],
            ['id' => 20, 'nome' => 'Rio Grande do Norte', 'sigla' => 'RN', 'is_estrangeiro' => 'false' ],
            ['id' => 21, 'nome' => 'Rio Grande do Sul', 'sigla' => 'RS', 'is_estrangeiro' => 'false' ],
            ['id' => 22, 'nome' => 'Rondônia', 'sigla' => 'RO', 'is_estrangeiro' => 'false' ],
            ['id' => 23, 'nome' => 'Roraima', 'sigla' => 'RR', 'is_estrangeiro' => 'false' ],
            ['id' => 24, 'nome' => 'Santa Catarina', 'sigla' => 'SC', 'is_estrangeiro' => 'false' ],
            ['id' => 25, 'nome' => 'São Paulo', 'sigla' => 'SP', 'is_estrangeiro' => 'false' ],
            ['id' => 26, 'nome' => 'Sergipe', 'sigla' => 'SE', 'is_estrangeiro' => 'false' ],
            ['id' => 27, 'nome' => 'Tocantins', 'sigla' => 'TO', 'is_estrangeiro' => 'false' ],
            ['id' => 28, 'nome' => 'Outro País', 'sigla' => 'OP', 'is_estrangeiro' => 'true' ],
        ]);
    }

}