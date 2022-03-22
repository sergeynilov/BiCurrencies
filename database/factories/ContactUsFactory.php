<?php

namespace Database\Factories;

use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => $this->faker->randomElement(User::all())['id'],
            'title' => $this->faker->text(30),
            'content_message' => $this->faker->paragraph(),
            'accepted' => 0,
        ];
    }


}
