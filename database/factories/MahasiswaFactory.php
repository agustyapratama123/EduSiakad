<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'nim' => $this->faker->unique()->numerify('20########'),
            'email' => $this->faker->unique()->safeEmail(),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-18 years'),
            'angkatan' => $this->faker->numberBetween(2020, 2024),
            'user_id' => null, // optional jika kamu hubungkan ke user
        ];
    }
}


