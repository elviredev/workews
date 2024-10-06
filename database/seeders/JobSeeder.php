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
      // Charger les données des job listings
      $jobListings = include database_path('seeders/data/job_listings.php');

      // Obtenir tous les ID utilisateur depuis le model User
      $userIds = User::pluck('id')->toArray();

      // Parcourir les annonces pour pouvoir ajouter user_id et horodatage
      foreach ($jobListings as &$listing) {
        // Assigner un user id à l'annonce
        $listing['user_id'] = $userIds[array_rand($userIds)];
        // Add timestamps
        $listing['created_at'] = now();
        $listing['updated_at'] = now();
      }

      // Insert job listings
      DB::table('job_listings')->insert($jobListings);
      echo "Offres d'emploi créées avec succès !";
    }
}
