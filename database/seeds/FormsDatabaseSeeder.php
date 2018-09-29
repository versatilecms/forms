<?php

use Versatile\Core\Traits\Seedable;
use Versatile\Core\Seeders\AbstractBreadSeeder;

class FormsDatabaseSeeder extends AbstractBreadSeeder
{
    use Seedable;

    protected $seedersPath = __DIR__ . '/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('EnquiriesTableSeeder');
        $this->seed('FormsTableSeeder');
        $this->seed('InputsTableSeeder');
        $this->seed('DataTableSeeder');
    }
}
