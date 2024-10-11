<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;


class BookmarkSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Get the test user
    $testUser = User::where('email', 'test@test.com')->firstOrFail();

    // Get all job IDs sous forme de tableau
    $jobIds = Job::pluck('id')->toArray();

    // Sélectionnez aléatoirement 3 job IDs à ajouter aux favoris
    $randomJobIds = array_rand($jobIds, 3);

    // Joindre les jobs sélectionnées sous forme de favoris pour l'utilisateur test
    foreach ($randomJobIds as $jobId) {
      $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
    }
  }
}
