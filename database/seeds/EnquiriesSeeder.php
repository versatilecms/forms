<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class EnquiriesSeeder extends AbstractBreadSeeder
{
    public function bread()
    {
        return [
            'name' => 'enquiries',
            'slug' => 'enquiries',
            'display_name_singular' => __('versatile::seeders.data_types.enquiry.singular'),
            'display_name_plural'   => __('versatile::seeders.data_types.enquiry.plural'),
            'icon' => 'versatile-mail',
            'model_name' => 'Versatile\Forms\Enquiry',
            'controller' => '\Versatile\Forms\Http\Controllers\EnquiryController',
            'generate_permissions' => '1'
        ];
    }

    public function inputFields()
    {
        return [
            'id' => [
                'type' => 'number',
                'display_name' => 'ID',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 1,
            ],

            'form_id' => [
                'type' => 'number',
                'display_name' => 'Form ID',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 2,
            ],

            'data' => [
                'type' => 'text',
                'display_name' => 'Data',
                'required' => 1,
                'browse' => 0,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'mailto' => [
                'type' => 'text',
                'display_name' => 'Mailto',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 4,
            ],

            'ip_address' => [
                'type' => 'text',
                'display_name' => 'IP Address',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 5,
            ],

            'created_at' => [
                'type' => 'text',
                'display_name' => 'Created At',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 6,
            ],

            'updated_at' => [
                'type' => 'text',
                'display_name' => 'Updated At',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 7,
            ],
        ];
    }

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
