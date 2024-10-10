<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Charger les données du fichier job listings
      $jobListings = include database_path('seeders/data/job_listings.php');

      // Récupérer l'ID de l'utilisateur créé par TestUserSeeder
      $testUserId = User::where('email', 'test@test.com')->value('id');

      // Obtenir tous les autres user IDs
      $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

      // Parcourir les annonces pour pouvoir ajouter user_id et horodatage
      foreach ($jobListings as $index => &$listing) {
        if ($index < 2) {
          // Assign the first two job listings to the test user
          $listing['user_id'] = $testUserId;
        } else {
          // Assign the rest of job listings to random users
          $listing['user_id'] = $userIds[array_rand($userIds)];
        }

        // Add timestamps
        $listing['created_at'] = now();
        $listing['updated_at'] = now();
      }

      // Insert job listings
      DB::table('job_listings')->insert($jobListings);
      echo "Offres d'emploi créées avec succès !";
    }
}
