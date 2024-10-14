<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Job;

class BookmarkController extends Controller
{
  /**
   * @desc Obtenir les favoris des utilisateurs
   * @return View
   */
  public function index(): View
  {
    $user = Auth::user();
    // Obtenir tous les favoris de cet user
    $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
    return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
  }

  /**
   * @desc Ajouter un job aux favoris
   * @route POST /bookmarks/{job}
   * @param Job $job
   * @return RedirectResponse
   */
  public function store(Job $job): RedirectResponse
  {
    $user = Auth::user();
    // Vérifiez si le job est déjà mis en favori
    if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
      return back()->with('error', 'Ce poste est déjà mis en favoris.');
    }
    // Créer un nouveau favori
    $user->bookmarkedJobs()->attach($job->id);
    return back()->with('success', 'Poste ajouté avec succès aux favoris.');
  }

  /**
   * @desc Supprimer un job des favoris
   * @route DELETE /bookmarks/{job}
   * @param Job $job
   * @return RedirectResponse
   */
  public function destroy(Job $job): RedirectResponse
  {
    $user = Auth::user();
    // Vérifiez si le job n'est pas en favori
    if (!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
      return back()->with('error', 'Ce poste n\'est pas en favori.');
    }
    // Supprimer le favori
    $user->bookmarkedJobs()->detach($job->id);
    return back()->with('success', 'Poste supprimé des favoris avec succès.');
  }
}
