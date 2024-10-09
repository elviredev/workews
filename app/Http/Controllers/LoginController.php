<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
  /**
   * @desc Show form de connexion
   * @route GET /login
   * @return View
   */
  public function login(): View
  {
    return view('auth.login');
  }

  /**
   * @desc Authentifier user
   * @route POST /login
   * @param Request $request
   * @return RedirectResponse
   */
  public function authenticate(Request $request): RedirectResponse
  {
    // Validate the request data
    $credentials = $request->validate([
      'email' => 'required|string|email|max:100',
      'password' => 'required|string',
    ]);

    // Tentative de connexion de l'utilisateur
    if (Auth::attempt($credentials)) {
      // Régénérez la session pour éviter les attaques de fixation
      $request->session()->regenerate();

      // Redirect vers route prévue (intended route) ou route par défaut
      return redirect()->intended(route('home'))->with('success', 'Vous êtes maintenant connecté(e).');
    }

    // Si authentification échoue, redirect back with an error message
    return back()->withErrors([
      'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
  }

  /**
   * @desc Logout user
   * @route POST /logout
   * @param Request $request
   * @return RedirectResponse
   */
  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();

    // Invalidate the session
    $request->session()->invalidate();
    // Regenerate the CSRF token
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
