<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
  /**
   * @desc Update profile user
   * @route PUT /profile
   * @param Request $request
   * @return RedirectResponse
   */
  public function update(Request $request): RedirectResponse
  {
    // Obtenir le user connecté
    $user = Auth::user();

    // Obtenir les données validées
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Obtenir user name and email individuellement
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Gérer le téléchargement de l'avatar
    if ($request->hasFile('avatar')) {
      // Supprimer l'ancien avatar s'il existe
      if ($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
      }

      // Stocker le nouveau avatar
      $avatarPath = $request->file('avatar')->store('avatars', 'public');
      // Définir avatar au path
      $user->avatar = $avatarPath;
    }

    // Update user info
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Les informations du profil ont été mises à jour !');
  }
}
