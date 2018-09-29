<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class EnquiriesTableSeeder extends AbstractBreadSeeder
{
    public function permissions()
    {
        return [
            [
                'name' => 'browse_enquiries',
                'description' => null,
                'table_name' => 'enquiries',
                'roles' => ['admin']
            ],
            [
                'name' => 'read_enquiries',
                'description' => null,
                'table_name' => 'enquiries',
                'roles' => ['admin']
            ],
            [
                'name' => 'delete_enquiries',
                'description' => null,
                'table_name' => 'enquiries',
                'roles' => ['admin']
            ]
        ];
    }
}
