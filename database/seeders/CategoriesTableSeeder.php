<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ 'name' => 'Клавиатуры', 'alias' => 'keyboads', ],
            [ 'name' => 'Мыши', 'alias' => 'mice', ],
            [ 'name' => 'Игровые приставки', 'alias' => 'playstation', ],
            [ 'name' => 'Мониторы', 'alias' => 'displays', ],
            [ 'name' => 'Камеры', 'alias' => 'camers', ],
            [ 'name' => 'Наушники', 'alias' => 'headphones', ],
        ]);
    }
}
