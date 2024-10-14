<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
  use HasFactory;

  protected $table = 'job_listings';

  protected $fillable = [
    'title',
    'description',
    'salary',
    'tags',
    'job_type',
    'remote',
    'requirements',
    'benefits',
    'address',
    'city',
    'state',
    'zipcode',
    'contact_email',
    'contact_phone',
    'company_name',
    'company_description',
    'company_logo',
    'company_website',
    'user_id'
  ];

  // Relation avec le user
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  // Relation job avec favoris : un user peut avoir plusieurs favoris et les favoris peuvent être marqués par plusieurs users ($job->bookmarkedByUsers)
  public function bookmarkedByUsers(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'job_listings_bookmarks')->withTimestamps();
  }

  // Relation to candidats : 1 job peut avoir de nombreux candidats
  public function candidats(): HasMany
  {
    return $this->hasMany(Candidat::class);
  }
}
