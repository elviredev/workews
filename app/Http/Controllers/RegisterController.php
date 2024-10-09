<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
  /**
   * @desc Show form d'inscription
   * @route GET /register
   * @return View
   */
  public function register(): View
  {
    return view('auth.register');
  }

  /**
   * @desc Stocker user in database
   * @route POST /register
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:100',
      'email' => 'required|string|email|max:100|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    // Hash password
    $validatedData['password'] = Hash::make($validatedData['password']);

    // Create user et l'enregistrer en bdd
    $user = User::create($validatedData);

    return redirect()->route('login')->with('success', 'Vous êtes inscrit(e), vous pouvez vous connecter !');
  }
}
