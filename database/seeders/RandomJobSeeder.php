<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class RandomJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Create 10 job listings using factory
      $jobs = Job::factory(10)->create();
      echo 'Offres d\'emploi créées avec succès';
    }
}
