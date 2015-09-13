<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $collections = [
        'users',
        'roles',
        'products',
        'categories',
    ];

    /**
     * @var array
     */
    protected $seeders = [
        'UsersCollectionSeeder',
        'ProductsCollectionSeeder',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();

        foreach ($this->seeders as $seedClass) {
            $this->call($seedClass);
        }
    }

    /**
     * Clean out the database for a new seed generation.
     */
    private function cleanDatabase()
    {
        foreach ($this->collections as $collection) {
            DB::table($collection)->truncate();
        }
    }
}
