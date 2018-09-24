<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class FormsSeeder extends AbstractBreadSeeder
{
    public function bread()
    {
        return [
            'name' => 'forms',
            'slug' => 'forms',
            'display_name_singular' => __('versatile::seeders.data_types.form.singular'),
            'display_name_plural' => __('versatile::seeders.data_types.form.plural'),
            'icon' => 'versatile-documentation',
            'model_name' => 'Versatile\Forms\Form',
            'controller' => '\Versatile\Forms\Http\Controllers\FormController',
            'generate_permissions' => '1',
        ];
    }

    public function inputFields()
    {
        return [
            'id' => [
                'type' => 'number',
                'display_name' => 'id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'title' => [
                'type' => 'text',
                'display_name' => 'title',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'mailto' => [
                'type' => 'text',
                'display_name' => 'mailto',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'hook' => [
                'type' => 'text',
                'display_name' => 'hook',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'layout' => [
                'type' => 'text',
                'display_name' => 'layout',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'email_template' => [
                'type' => 'text',
                'display_name' => 'email_template',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 3,
            ],

            'message_success' => [
                'type' => 'text',
                'display_name' => 'message_success',
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

    public function menu()
    {
        return [
            [
                'role' => 'admin',
                'title' => __('versatile::seeders.menu_items.forms'),
                'icon_class' => 'versatile-documentation',
                'order' => 7,
                'children' => [
                    [
                        'title' => __('versatile::seeders.menu_items.form_management'),
                        'icon_class' => 'versatile-documentation',
                        'order' => 1,
                        'route' => 'versatile.forms.index',
                    ],
                    [
                        'title' => __('versatile::seeders.menu_items.enquiries'),
                        'icon_class' => 'versatile-mail',
                        'order' => 2,
                        'route' => 'versatile.enquiries.index',
                    ],

                ]
            ]
        ];
    }

    public function settings()
    {
        return [
            [
                'key' => 'forms.default_to_email',
                'display_name' => 'Default Enquiry To Email',
                'value' => 'contact@example.com',
                'details' => 'The default email address to send form enquiries to',
                'type' => 'text',
                'order' => 1,
                'group' => 'Forms',
            ],
            [
                'key' => 'forms.default_from_email',
                'display_name' => 'Default Enquiry From Email',
                'value' => 'contact@example.com',
                'details' => 'The default email address to use as the sender address for form enquiries',
                'type' => 'text',
                'order' => 2,
                'group' => 'Forms',
            ],
            [
                'key' => 'admin.google_recaptcha_site_key',
                'display_name' => 'Google reCAPTCHA Site Key (public)',
                'value' => '',
                'details' => 'This key can be found in your Google reCAPTCHA console',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ],
            [
                'key' => 'admin.google_recaptcha_secret_key',
                'display_name' => 'Google reCAPTCHA Secret Key',
                'value' => '',
                'details' => 'This key can be found in your Google reCAPTCHA console',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ]
        ];
    }

    public function permissions()
    {
        return [
            [
                'name' => 'browse_forms',
                'description' => null,
                'table_name' => 'forms',
                'roles' => ['admin']
            ],
            [
                'name' => 'edit_forms',
                'description' => null,
                'table_name' => 'forms',
                'roles' => ['admin']
            ],
            [
                'name' => 'add_forms',
                'description' => null,
                'table_name' => 'forms',
                'roles' => ['admin']
            ],
            [
                'name' => 'delete_forms',
                'description' => null,
                'table_name' => 'forms',
                'roles' => ['admin']
            ]
        ];
    }
}
