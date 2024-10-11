<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
  /**
   * @desc Show les offres d'emploi du user connecté
   * @route GET /dashboard
   * @return View
   */
  public function index(): View
  {
    // Obtenir le user authentifié
    $user = Auth::user();

    // Obtenir les annonces du user connecté
    $jobs = Job::where('user_id', $user->id)->get();

    return view('dashboard.index', compact('user','jobs'));
  }
}
