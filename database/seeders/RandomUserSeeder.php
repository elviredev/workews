<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class RandomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Create 10 users using the UserFactory
      $user = User::factory(10)->create();
      echo 'Utilisateurs créés avec succès';
    }
}
