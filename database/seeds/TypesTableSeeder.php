<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert(
            [
            [
                'id'=>1,
                'name' => 'default',
                'display_name' => '默认分类',
                'description' => '默认分类',
                'model_name' => \App\Models\Link::class
            ],
            [
                'id'=>2,
                'name' => 'search',
                'display_name' => '搜索引擎',
                'description' => '最大的中文搜索引擎',
                'model_name' => \App\Models\Link::class
            ],
            ]
        );
    }
}
