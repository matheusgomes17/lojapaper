<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
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
            DB::table(config('catalog.products_table'))->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM '.config('catalog.products_table'));
        } else {
            //For PostgreSQL or anything else
            DB::statement('TRUNCATE TABLE '.config('catalog.products_table').' CASCADE');
        }

        factory(\Snaketec\Models\Catalog\Product\Product::class, 50)->create();

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}