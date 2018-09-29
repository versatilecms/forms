<?php

use Versatile\Forms\Form;
use Versatile\Forms\FormInput;
use Illuminate\Database\Seeder;

class DataTableSeeder extends Seeder
{
    protected $inputs = [
        'name' => 'text',
        'email' => 'email',
        'phone' => 'text',
        'message' => 'text_area',
    ];

    public function run()
    {
        $form = $this->findForm('Contact Us');

        if (!$form->exists) {
            $form->fill([
                'title' => 'Contact Us',
                'mailto' => '',
                'layout' => 'default',
                'email_template' => 'default',
                'message_success' => 'Success! Thanks for your enquiry.',
            ])->save();

            $this->createFormInputs($form);
        }
    }

    protected function findForm($title)
    {
        return Form::firstOrNew(['title' => $title]);
    }

    protected function createFormInputs($form)
    {
        $order = 1;
        foreach ($this->inputs as $key => $value) {
            FormInput::create([
                'form_id' => $form->id,
                'label' => ucwords(str_replace('_', ' ', $key)),
                'type' => $value,
                'required' => true,
                'order' => $order,
            ])->save();

            $order++;
        }
    }
}
