<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class InputsSeeder extends AbstractBreadSeeder
{
    public function bread()
    {
        return [
                'name' => 'inputs',
                'slug' => 'inputs',
                'display_name_singular' => __('versatile::seeders.data_types.input.singular'),
                'display_name_plural'   => __('versatile::seeders.data_types.input.plural'),
                'icon' => 'versatile-documentation',
                'model_name' => 'Versatile\Forms\FormInput',
                'controller' => '\Versatile\Forms\Http\Controllers\InputController',
                'generate_permissions' => '1',
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
                'order' => 3,
            ],

            'form_id' => [
                'type' => 'number',
                'display_name' => 'form_id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'label' => [
                'type' => 'text',
                'display_name' => 'label',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'class' => [
                'type' => 'text',
                'display_name' => 'class',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'type' => [
                'type' => 'text',
                'display_name' => 'type',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'options' => [
                'type' => 'text',
                'display_name' => 'options',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'required' => [
                'type' => 'text',
                'display_name' => 'required',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'order' => [
                'type' => 'text',
                'display_name' => 'order',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'created_at' => [
                'type' => 'text',
                'display_name' => 'created_at',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'updated_at' => [
                'type' => 'text',
                'display_name' => 'updated_at',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

        ];
    }

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
