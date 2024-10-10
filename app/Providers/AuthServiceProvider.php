<?php

namespace App\Providers;

use App\Models\Job;
use App\Policies\JobPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  // Créer la propriété de policy pour relier le model Job à la policy JobPolicy
  protected $policies = [
    Job::class => JobPolicy::class
  ];
  /**
   * Register services.
   */
  public function register(): void
  {
      //
  }

  /**
   * Bootstrap services.
   * Enregistrer la JobPolicy qu'on a créé dans le model Job
   */
  public function boot(): void
  {
      $this->registerPolicies();
  }
}
