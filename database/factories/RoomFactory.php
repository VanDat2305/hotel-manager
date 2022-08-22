<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $table->id();
        //     $table->string('name');
        //     $table->integer('price');
        //     $table->string('image');
        //     $table->mediumText('description');
        //     $table->enum('status', [0, 1])->default(1)->comment('0: block, 1: active');
        //     $table->timestamps();
        return [
            'name'=>$this->faker->name(),
            'price'=>$this->faker->numberBetween($min = 150000, $max = 600000),
            'image' => '',
            'description' => $this->faker->paragraph(),
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}
