<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titleList = [
            "Senior Engineer AWS",
            "Lead Frontend Developer",
            "Developer",
            "Back End Developer",
            "DevOps Engineer (m/f/d)",
            "Senior Data Engineer",
            "Senior Developer",
            "Developer",
            "Senior DevOps Specialist",
            "Full stack Developer",
            "Senior Backend/Cloud Engineer",
            "Infrastructure Engineer",
            "Solutions Engineer - Denmark",
            "Senior Engine/Systems Engineer",
            "Developer",
            "Senior Backend Engineer (Integrations)",
            "Linux Operations Engineer",
            "Senior Developer (Full-Stack)",
            "Operations Engineer - Windows Specialist",
            "Lead Salesforce Developer",
            "Senior Software Engineer",
            "Senior Data Engineer",
            "Senior Backend Engineer",
            "Software engineer internship",
            "Senior Developer Apps",
            "Developer Apps (iOS / Android)",
            "Backend Developer (m/f/d)",
            "Programmer",
        ];

        $programmingLanguagesList = [
            'Python',
            'Java',
            'JavaScript',
            'C/C++',
            'C#',
            'R',
            'PHP',
            'TypeScript',
            'Swift',
            'Objective-C',
            'Rust',
            'Go',
            'Kotlin',
            'Matlab',
            'Ada',
            'Dart',
            'Ruby',
            'PowerShell',
            'VBA',
            'Lua',
        ];

        return [
            'title' => $programmingLanguagesList[rand(0, count($programmingLanguagesList) - 1)] . ' ' . $titleList[rand(0, count($titleList) - 1)],
            'short_description' => fake()->sentence(),
            'long_description' => fake()->paragraph(30),
            'user_id' => rand(1, 10),
            'company_id' => rand(1, 10),
            'category_id' => rand(1, 4),
            'job_type_id' => rand(1, 4),
            'location_id' => rand(1, 6),
        ];
    }
}
