<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CatalogTableSeeder.
 */
class CatalogTableSeeder extends Seeder
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

        $this->call(ProductTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
