<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::table(config('catalog.categories_table'))->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM '.config('catalog.categories_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE '.config('catalog.categories_table').' CASCADE');
        }

        //Add the master administrator, user id of 1
        $categories = [
            [
                '_lft'              => 1,
                '_rgt'              => 6,
                'parent_id'         => null,
                'user_id'           => 1,
                'name'         	    => 'Categoria Mãe',
                'description'       => 'Está é uma categoria principal',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                '_lft'              => 2,
                '_rgt'              => 3,
                'parent_id'         => 1,
                'user_id'           => 1,
                'name'              => 'Categoria Filha',
                'description'       => 'Está é uma sub-categoria',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                '_lft'              => 4,
                '_rgt'              => 5,
                'parent_id'         => 1,
                'user_id'           => 1,
                'name'              => 'Categoria Filha',
                'description'       => 'Está é uma sub-categoria',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table(config('catalog.categories_table'))->insert($categories);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}