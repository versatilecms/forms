<?php

use Versatile\Core\Seeders\AbstractBreadSeeder;

class FormsTableSeeder extends AbstractBreadSeeder
{
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
