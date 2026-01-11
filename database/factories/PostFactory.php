<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 8));
        
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(6), // Уникальный slug с добавлением случайной строки
            'text' => $this->generatePostContent(),
            'is_published' => $this->faker->boolean(70), // 70% шанс быть опубликованным
            'user_id' => 1,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Генерирует контент поста с HTML-разметкой
     */
    private function generatePostContent(): string
    {
        $content = '<p>' . $this->faker->paragraph(rand(5, 10)) . '</p>';
        
        // Добавляем подзаголовки
        for ($i = 0; $i < rand(2, 4); $i++) {
            $content .= '<h3>' . $this->faker->sentence(rand(4, 7)) . '</h3>';
            $content .= '<p>' . $this->faker->paragraph(rand(3, 8)) . '</p>';
            
            // Иногда добавляем список
            if ($this->faker->boolean(30)) {
                $content .= '<ul>';
                for ($j = 0; $j < rand(3, 6); $j++) {
                    $content .= '<li>' . $this->faker->sentence(rand(3, 6)) . '</li>';
                }
                $content .= '</ul>';
            }
        }
        
        // Добавляем заключение
        $content .= '<p>' . $this->faker->paragraph(rand(3, 6)) . '</p>';
        
        return $content;
    }    
}
