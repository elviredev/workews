<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidat extends Model
{
  use HasFactory;

  protected $fillable = [
    'job_id',
    'user_id',
    'full_name',
    'contact_phone',
    'contact_email',
    'message',
    'location',
    'resume_path'
  ];

  // Relation to job : un candidat appartient à un job
  public function job(): BelongsTo
  {
    return $this->belongsTo(Job::class);
  }

  // Relation to user : un candidat appartient à un user
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
