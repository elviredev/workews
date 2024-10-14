<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'avatar'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
      'password',
      'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
      return [
          'email_verified_at' => 'datetime',
          'password' => 'hashed',
      ];
  }

  // Relation avec job listing
  public function jobListings(): HasMany
  {
    return $this->hasMany(Job::class);
  }

  // Relation user avec favoris ($user->bookmarquedJob)
  public function bookmarkedJobs(): BelongsToMany
  {
    return $this->belongsToMany(Job::class, 'job_user_bookmarks')->withTimestamps();
  }

  // Relation to candidats : 1 utilisateur peut avoir plusieurs candidatures
  public function candidatures(): HasMany
  {
    return $this->hasMany(Candidat::class, 'user_id');
  }
}
