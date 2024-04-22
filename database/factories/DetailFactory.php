<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DetailFactory extends Factory
{
    public function definition(): array
    {
        $contact = \App\Models\Contact::all()->toArray();
        $i = rand(0, 19);
        $types = \App\Models\Type::all()->toArray();
        $j = rand(0, 1);

        return [
            "contact_id" => $contact[$i]['id'],
            "type_id" => $types[$j]['id'],
            "type_title" => $types[$j]['title'],
            "detail_value" => fake()->phoneNumber,
        ];
    }
}
