<?php

use Faker\Generator as Faker;

$factory->define(\Versatile\Forms\Enquiry::class, function (Faker $faker) {
    return [
        'form_id' => factory(\Versatile\Forms\Form::class)->create()->id,
        'data' => json_encode([
            'first_name' => 'Jonathon',
            'last_name' => 'Spoons',
            'gender' => 'Chameleon',
            'attitude' => 'Savage',
        ]),
        'mailto' => $faker->safeEmail,
        'hook' => $faker->url,
        'ip_address' => $faker->ipv4,
    ];
});
