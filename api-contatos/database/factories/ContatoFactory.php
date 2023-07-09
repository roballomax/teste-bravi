<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contato>
 */
class ContatoFactory extends Factory
{

    private const PHONE_TYPE = 1;
    private const CELLPHONE_TYPE = 2;
    private const EMAIL_TYPE = 3;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $type = rand(1, 3);
        $value = '';
        $brazilianPhones = [
            '(47) 99689-5685',
            '(48) 96865-6532',
            '(55) 3412-5682',
            '(11) 99689-5685',
            '(21) 98565-4538',
        ];

        switch($type) {
            case self::PHONE_TYPE       : $value = $brazilianPhones[rand(0, 4)]; break;
            case self::CELLPHONE_TYPE   : $value = $brazilianPhones[rand(0, 4)]; break;
            case self::EMAIL_TYPE       : $value = fake()->email(); break;
        }

        return [
            'valor' => $value,
            'tipo_id'  => $type,
            'pessoa_id' => rand(1, 5),
        ];
    }
}
