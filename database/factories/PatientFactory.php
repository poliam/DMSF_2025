<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'birth_date' => $this->faker->date('Y-m-d', '-18 years'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'street' => $this->faker->streetAddress,
            'brgy_address' => $this->faker->secondaryAddress,
            'address_landmark' => $this->faker->optional()->words(3, true),
            'occupation' => $this->faker->jobTitle,
            'highest_educational_attainment' => $this->faker->randomElement([
                'Elementary', 'High School', 'College', 'Post Graduate'
            ]),
            'marital_status' => $this->faker->randomElement([
                'Single', 'Married', 'Divorced', 'Widowed'
            ]),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'monthly_household_income' => $this->faker->numberBetween(5000, 50000),
            'religion' => $this->faker->randomElement([
                'Catholic', 'Protestant', 'Islam', 'Other'
            ]),
            'image_path' => $this->faker->optional()->imageUrl(200, 200, 'people'),
            'diagnosis' => $this->faker->optional()->sentence,
            'height' => $this->faker->numberBetween(150, 200), // cm
            'reference_number' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{6}'),
        ];
    }

    /**
     * Create a patient with specific gender
     */
    public function male()
    {
        return $this->state(function (array $attributes) {
            return [
                'gender' => 'male',
                'first_name' => $this->faker->firstNameMale,
            ];
        });
    }

    /**
     * Create a patient with specific gender
     */
    public function female()
    {
        return $this->state(function (array $attributes) {
            return [
                'gender' => 'female',
                'first_name' => $this->faker->firstNameFemale,
            ];
        });
    }

    /**
     * Create a patient with minimum required fields only
     */
    public function minimal()
    {
        return $this->state(function (array $attributes) {
            return [
                'middle_name' => null,
                'address_landmark' => null,
                'diagnosis' => null,
            ];
        });
    }
}