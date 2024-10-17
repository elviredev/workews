<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Job;
use App\Mail\JobApplied;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CandidatController extends Controller
{
  /**
   * @desc Stocker une nouvelle candidature à un poste
   * @route POST /jobs/{job}/postuler
   * @param Request $request
   * @param Job $job
   * @return RedirectResponse
   */
  public function store(Request $request, Job $job): RedirectResponse
  {
    // Vérifier si l'utilisateur a déjà postulé pour le poste
    $existingCandidature = Candidat::where('job_id', $job->id)
                                   ->where('user_id', auth()->id())
                                   ->exists();

    if ($existingCandidature) {
      return redirect()->back()->with('error', 'Vous avez déjà postulé à cet emploi.');
    }

    // Valider les données entrantes
    $validatedData = $request->validate([
      'full_name' => 'required|string',
      'contact_phone' => 'string|max:20',
      'contact_email' => 'required|string|email',
      'message' => 'string',
      'location' => 'string',
      'resume' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Gérer le téléchargement du fichier de CV
    if ($request->hasFile('resume')) {
      $path = $request->file('resume')->store('resumes', 'public');
      // Ajouter le path à la bdd
      $validatedData['resume_path'] = $path;
    }

    // Stocker la candidature
    $candidature = new Candidat($validatedData);
    // Ajouter job_id et user_id car ils ne sont pas dans les champs du formulaire
    $candidature->job_id = $job->id;
    $candidature->user_id = auth()->id();
    $candidature->save();

    // Send Email to owner (decommenter après que mailtrap ait validé le form de conformité)
    // Mail::to($job->user->email)->send(new JobApplied($candidature, $job));

    return redirect()->back()->with('success', 'Votre candidature a été transmise!');
  }

  /**
   * @desc Supprimer un candidat de la liste des candidatures
   * @route DELETE /candidats/{candidat}
   * @param $id
   * @return RedirectResponse
   */
  public function destroy($id): RedirectResponse
  {
    // Obtenir le candidat. Si non trouvé la méthode findOrFail renverra simplement une erreur
    $candidat = Candidat::findOrFail($id);
    $candidat->delete();
    return redirect()->route('dashboard')->with('success', 'Le candidat a été supprimé avec succès.');
  }
}
