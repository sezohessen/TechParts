<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;
use DB;
class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker_ar=$this->faker->locale("ar_AA");
        return [
            'question' => $this->faker->name,
            'question_ar' => $faker_ar->name,
            'answer' => $this->faker->name,
            'answer_ar' =>$faker_ar->name,
        ];
    }
}
