<?php

use Faker\Generator as Faker;

$factory->define(\Versatile\Forms\FormInput::class, function (Faker $faker) {
    return [
        'form_id' => factory(\Versatile\Forms\Form::class)->create()->id,
        'label' => 'Email',
        'class' => 'form-input',
        'type' => 'email',
        'required' => true,
        'order' => 0,
    ];
});
