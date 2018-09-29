<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class InputsTableSeeder extends AbstractBreadSeeder
{
    public function permissions()
    {
        return [
            [
                'name' => 'browse_inputs',
                'description' => null,
                'table_name' => 'form_inputs',
                'roles' => ['admin']
            ],
            [
                'name' => 'read_inputs',
                'description' => null,
                'table_name' => 'form_inputs',
                'roles' => ['admin']
            ],
            [
                'name' => 'edit_inputs',
                'description' => null,
                'table_name' => 'form_inputs',
                'roles' => ['admin']
            ],
            [
                'name' => 'add_inputs',
                'description' => null,
                'table_name' => 'form_inputs',
                'roles' => ['admin']
            ],
            [
                'name' => 'delete_inputs',
                'description' => null,
                'table_name' => 'form_inputs',
                'roles' => ['admin']
            ]
        ];
    }
}
